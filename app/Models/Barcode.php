<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    /** @use HasFactory<\Database\Factories\BarcodeFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qr_code',
        'title',
        'description',
        'link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
