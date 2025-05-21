<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laporan extends Model
{
    // Nama tabel (default plural dari class)
    protected $table = 'laporans';

    // Primary key berupa string (no_registrasi)
    protected $primaryKey = 'no_registrasi';
    public $incrementing = false;
    protected $keyType = 'string';

    // Aktifkan timestamps
    public $timestamps = true;

    // Kolom yang boleh di-mass assign
    protected $fillable = [
        'no_registrasi',
        'user_id',
        'kategori_kekerasan_id',
        'tanggal_pelaporan',
        'tanggal_kejadian',
        'kategori_lokasi_kasus',
        'alamat_tkp',
        'alamat_detail_tkp',
        'kronologis_kasus',
        'status',
        'alasan_dibatalkan',
        'waktu_dilihat',
        'userid_melihat',
        'waktu_diproses',
        'waktu_dibatalkan',
        'dokumentasi',
    ];

    // Casts agar JSON & tanggal otomatis di-cast ke array / Carbon
    protected $casts = [
        'tanggal_pelaporan'    => 'datetime',
        'tanggal_kejadian'     => 'datetime',
        'waktu_dilihat'        => 'datetime',
        'waktu_diproses'       => 'datetime',
        'waktu_dibatalkan'     => 'datetime',
        'dokumentasi'          => 'array',    // JSONMap → array
    ];

    //
    // === RELATIONS ===
    //

    // Owner laporan (user)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Kategori kekerasan
    public function violenceCategory(): BelongsTo
    {
        return $this->belongsTo(
            ViolenceCategory::class,
            'kategori_kekerasan_id'
        );
    }

    // Tracking laporan (one-to-many)
    public function trackingLaporan(): HasMany
    {
        return $this->hasMany(
            TrackingLaporan::class,
            'no_registrasi',
            'no_registrasi'
        );
    }
}
