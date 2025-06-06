<?php

namespace App\Exports;

use App\Models\Korban;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KorbanExport implements FromQuery, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $q = Korban::query();

        if (!empty($this->filters['no_registrasi'])) {
            $q->whereIn('no_registrasi', $this->filters['no_registrasi']);
        }

        return $q->orderBy('no_registrasi')->orderBy('created_at');
    }

    public function headings(): array
    {
        return [
            'No Registrasi',
            'NIK Korban',
            'Nama Korban',
            'Usia',
            'Alamat',
            'Alamat Detail',
            'Jenis Kelamin',
            'Agama',
            'No Telepon',
            'Pendidikan',
            'Pekerjaan',
            'Status Perkawinan',
            'Kebangsaan',
            'Hubungan dengan Korban',
            'Keterangan Lainnya',
            'Dokumentasi Pelaku (URL)',
            'Created At',
        ];
    }
}
