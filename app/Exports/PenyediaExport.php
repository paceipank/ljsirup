<?php

namespace App\Exports;

use App\Models\SirupPenyedia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenyediaExport implements FromCollection, WithHeadings, WithMapping
{
    private $no = 1;
    public function collection()
    {
        $query = SirupPenyedia::query();
        if (request()->filled('tahun')) {
            $query->where('tahun_anggaran', request()->tahun);
        }

        if (request()->filled('opd')) {
            $query->where('nama_satker', 'like', '%' . request()->opd . '%');
        }

        if (request()->filled('search')) {
            $query->where(function ($q) {
                $q->where('nama_paket', 'like', '%' . request()->search . '%')
                    ->orWhere('kd_rup', 'like', '%' . request()->search . '%');
            });
        }

        return $query->get();
    }

    public function map($row): array
    {
        return [
            $this->no++,
            $row->nama_satker,
            $row->nama_paket,
            $row->kd_rup,
            $row->jenis_pengadaan,
            $row->metode_pengadaan,
            'Rp. ' . number_format($row->pagu, 0, ',', '.') . ',-',
            date('d F Y', strtotime($row->tgl_pengumuman_paket))
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'OPD',
            'Nama Paket',
            'ID RUP',
            'Jenis',
            'Metode',
            'Pagu',
            'Terumumkan',
        ];
    }
}
