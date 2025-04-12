namespace App\Exports;

use App\Models\SirupPenyedia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenyediaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Filter data jika perlu
        return SirupPenyedia::all();
    }

    public function map($row): array
    {
        return [
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
