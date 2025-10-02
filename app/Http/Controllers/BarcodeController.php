<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Storage;

class BarcodeController extends Controller
{
    public function index(Request $request)
    {
        $query = Barcode::query();
        $userId = auth()->id();
        if ($userId) {
            $query->where('user_id', $userId);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('id', 'like', '%' . $searchTerm . '%');
            });
        }

        $barcodes = $query->latest()->paginate(10)->withQueryString();

        return view('admin.barcodes.index', compact('barcodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'link' => 'nullable|url|max:255',
        ]);
        try {
            $barcode = new Barcode();
            $barcode->title = $request->title;
            $barcode->description = $request->description;
            $barcode->link = $request->link;
            $barcode->user_id = auth()->id();

            $qrData = $request->link ? $request->link : $request->title;
            $safeTitle = \Illuminate\Support\Str::slug($request->title . '-' . Str::random(5));
            $qrPath = "qrcodes/generate_{$safeTitle}.png";

            if (!file_exists(storage_path("app/public/qrcodes"))) {
                mkdir(storage_path("app/public/qrcodes"), 0777, true);
            }

            // ✅ Strong settings for logo
            $options = new QROptions([
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel'   => QRCode::ECC_H, // High redundancy
                'scale'      => 10,
                'imageBase64' => false,
                'addQuietzone' => true, // Important!
                'quietzoneSize' => 4,
            ]);

            $qrcode = (new QRCode($options))->render($qrData);
            $qrFile = storage_path("app/public/{$qrPath}");
            file_put_contents($qrFile, $qrcode);

            // ---- Overlay Logo ----
            $logoPath = public_path('images/logo_dark.png');
            if (file_exists($logoPath)) {
                $qrImage = imagecreatefrompng($qrFile);
                $logo = imagecreatefrompng($logoPath);

                $qrWidth = imagesx($qrImage);
                $qrHeight = imagesy($qrImage);
                $logoWidth = imagesx($logo);
                $logoHeight = imagesy($logo);

                // ✅ Logo at max 20% of QR width
                $logoQRWidth = $qrWidth * 0.2;
                $scale = $logoWidth / $logoQRWidth;
                $logoQRHeight = $logoHeight / $scale;

                $posX = ($qrWidth - $logoQRWidth) / 2;
                $posY = ($qrHeight - $logoQRHeight) / 2;

                imagecopyresampled($qrImage, $logo, $posX, $posY, 0, 0, $logoQRWidth, $logoQRHeight, $logoWidth, $logoHeight);
                imagepng($qrImage, $qrFile);

                imagedestroy($qrImage);
                imagedestroy($logo);
            }

            $barcode->qr_code = $qrPath;
            $barcode->save();
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Barcode created successfully',
                    'data' => $barcode
                ], 201);
            }

            return redirect()->route('barcodes.index')->with('success', 'Barcode created successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create barcode: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to create barcode')
                ->withInput();
        }
    }
    public function show($id)
    {
        // Show a specific barcode
        $barcode = Barcode::findOrFail($id);
        return view('admin.barcodes.show', compact('barcode'));
    }

    public function update(Request $request, $id)
    {
        try {

            $barcode = Barcode::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'link' => 'nullable|url|max:255',
            ]);

            // ---- Remove old QR if exists ----
            if ($barcode->qr_code && Storage::disk('public')->exists($barcode->qr_code)) {
                Storage::disk('public')->delete($barcode->qr_code);
            }

            // ---- Update fields ----
            $barcode->title = $request->title;
            $barcode->description = $request->description;
            $barcode->link = $request->link;
            $barcode->user_id = auth()->id();

            // ---- Generate new QR ----
            $qrData = $request->link ? $request->link : $request->title;
            $safeTitle = \Illuminate\Support\Str::slug($request->title . '-' . Str::random(5));
            $qrPath = "qrcodes/generate_{$safeTitle}.png";

            if (!file_exists(storage_path("app/public/qrcodes"))) {
                mkdir(storage_path("app/public/qrcodes"), 0777, true);
            }

            $options = new QROptions([
                'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel'     => QRCode::ECC_H,
                'scale'        => 10,
                'imageBase64'  => false,
                'addQuietzone' => true,
                'quietzoneSize' => 4,
            ]);

            $qrcode = (new QRCode($options))->render($qrData);
            $qrFile = storage_path("app/public/{$qrPath}");
            file_put_contents($qrFile, $qrcode);

            // ---- Overlay Logo ----
            $logoPath = public_path('images/logo_dark.png');
            if (file_exists($logoPath)) {
                $qrImage = imagecreatefrompng($qrFile);
                $logo = imagecreatefrompng($logoPath);

                $qrWidth = imagesx($qrImage);
                $qrHeight = imagesy($qrImage);
                $logoWidth = imagesx($logo);
                $logoHeight = imagesy($logo);

                // Scale logo to 20%
                $logoQRWidth = $qrWidth * 0.2;
                $scale = $logoWidth / $logoQRWidth;
                $logoQRHeight = $logoHeight / $scale;

                $posX = ($qrWidth - $logoQRWidth) / 2;
                $posY = ($qrHeight - $logoQRHeight) / 2;

                imagecopyresampled($qrImage, $logo, $posX, $posY, 0, 0, $logoQRWidth, $logoQRHeight, $logoWidth, $logoHeight);
                imagepng($qrImage, $qrFile);

                imagedestroy($qrImage);
                imagedestroy($logo);
            }

            // Save new QR path
            $barcode->qr_code = $qrPath;
            $barcode->save();
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Barcode updated successfully',
                    'data' => $barcode->fresh()
                ]);
            }

            return redirect()->route('barcodes.index')->with('success', 'Barcode updated successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update barcode: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to update barcode')
                ->withInput();
        }
    }
    public function destroy(Request $request, $id)
    {
        // Delete a specific barcode
        try {
            $barcode = Barcode::findOrFail($id);
            if ($barcode->qr_code && file_exists(storage_path('app/public/' . $barcode->qr_code))) {
                unlink(storage_path('app/public/' . $barcode->qr_code));
            }
            $barcode->delete();
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Barcode deleted successfully'
                ]);
            }
            return redirect()->route('barcodes.index')->with('warning', 'Barcode deleted successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete barcode: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to delete barcode');
        }
    }
}
