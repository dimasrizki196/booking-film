<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles; // Untuk styling (bold header)
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Untuk lebar kolom otomatis
use Maatwebsite\Excel\Concerns\WithColumnFormatting; // Untuk format angka
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

class LaporanPemesananExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithColumnFormatting
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'ID PESANAN',
            'NAMA PELANGGAN',
            'PAKET LAYANAN',
            'TANGGAL PESAN',
            'STATUS',
            'TOTAL HARGA'
        ];
    }

    public function map($row): array
    {
        return [
            '#' . str_pad($row->id, 4, '0', STR_PAD_LEFT),
            $row->user->name ?? 'N/A',
            $row->paket->nama_paket ?? 'N/A',
            Carbon::parse($row->tanggal_pesan)->format('d-m-Y'),
            strtoupper($row->status_pemesanan),
            (float) $row->total_harga, // Casting ke float agar bisa diformat di Excel
        ];
    }

    // 1. Membuat Header Bold dan memberikan background warna
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E2E8F0'] // Warna abu-abu muda untuk header
                ],
            ],
        ];
    }

    // 2. Memberikan format Rupiah pada kolom Total Harga (kolom ke-6)
    public function columnFormats(): array
    {
        return [
            'F' => '"Rp "#,##0_-', // Format Rupiah yang elegan di Excel
        ];
    }
}
