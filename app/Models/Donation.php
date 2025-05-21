<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'qr_image',
    ];

    // Aktifkan timestamps untuk mencatat created_at dan updated_at
    public $timestamps = true;
}
