<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Path to your Laravel project (app/, routes/, resources/, etc.)
        $projectPath = base_path();

        $lastModifiedTime = 0;
        $lastModifiedFile = null;

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($projectPath)
        );

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $mtime = $file->getMTime(); // last modified timestamp
                if ($mtime > $lastModifiedTime) {
                    $lastModifiedTime = $mtime;
                    $lastModifiedFile = $file->getPathname();
                }
            }
        }

        return view('dashboard', [
            'lastModifiedFile' => $lastModifiedFile,
            'lastModifiedTime' => $lastModifiedTime ? \Carbon\Carbon::createFromTimestamp($lastModifiedTime) : null,
        ]);
    }
}
