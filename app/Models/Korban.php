<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Korban extends Model
{
        use HasFactory;

    protected $table = 'korbans';
    protected $guarded = [];

    // public function laporan()
    // {
    //     return $this->belongsTo(Laporan::class, 'no_registrasi', 'no_registrasi');
    // }
    // protected $table = 'korbans';

    protected $fillable = [
        'no_registrasi',
        'nik_korban',
        'nama',
        'usia',
        'alamat_korban',
        'alamat_detail',
        'jenis_kelamin',
        'agama',
        'no_telepon',
        'pendidikan',
        'pekerjaan',
        'status_perkawinan',
        'kebangsaan',
        'hubungan_dengan_korban',
        'keterangan_lainnya',
        'dokumentasi_pelaku',
    ];

    /**
     * Relasi ke Laporan (asumsi Anda punya model Laporan dengan pk `no_registrasi`).
     */
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'no_registrasi', 'no_registrasi');
    }
}
