<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllSheetsExport implements WithMultipleSheets
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function sheets(): array
    {
        return [
            'Laporan' => new LaporanExport($this->filters),
            'Korban'  => new KorbanExport($this->filters),
            'Pelaku'  => new PelakuExport($this->filters),
        ];
    }
}
