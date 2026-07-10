<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class LaporanPemesananExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;

    // Menerima data hasil filter dari Controller
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
            'ID Pesanan',
            'Nama Pelanggan',
            'Paket Layanan',
            'Tanggal Pesan',
            'Status',
            'Total Harga (Rp)'
        ];
    }

    public function map($row): array
    {
        return [
            '#' . str_pad($row->id, 4, '0', STR_PAD_LEFT),
            $row->user->name ?? '-',
            $row->paket->nama_paket ?? '-',
            Carbon::parse($row->tanggal_pesan)->format('d M Y'),
            strtoupper($row->status_pemesanan),
            $row->total_harga
        ];
    }
}
