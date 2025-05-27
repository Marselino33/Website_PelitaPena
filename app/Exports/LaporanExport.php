<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromQuery, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $q = Laporan::query();

        if (!empty($this->filters['no_registrasi'])) {
            $q->whereIn('no_registrasi', $this->filters['no_registrasi']);
        }
        if (!empty($this->filters['status'])) {
            $q->where('status', $this->filters['status']);
        }
        if (!empty($this->filters['q'])) {
            $search = $this->filters['q'];
            $q->where(function($sub) use ($search) {
                $sub->where('no_registrasi', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%");
            });
        }

        return $q->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'No Registrasi',
            'Nama Pelapor',
            'Judul Laporan',
            'Tanggal Laporan',
            'Jam Pelaporan',
            'Status',
        ];
    }
}
