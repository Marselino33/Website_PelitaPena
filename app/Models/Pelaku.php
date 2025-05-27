<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelaku extends Model
{
    use HasFactory;

    protected $table = 'pelakus';
    protected $guarded = [];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'no_registrasi', 'no_registrasi');
    }
}
