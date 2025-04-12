<table>
    <thead>
        <tr>
            <th>No</th>
            <th>OPD</th>
            <th>Nama Paket</th>
            <th>Kode RUP</th>
            <th>Jenis</th>
            <th>Metode</th>
            <th>Pagu</th>
            <th>Terumumkan</th>
            {{-- tambahkan kolom lain sesuai kebutuhan --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->nama_satker }}</td>
                <td>{{ $item->nama_paket }}</td>
                <td>{{ $item->kd_rup }}</td>
                <td>{{ $item->jenis_pengadaan }}</td>
                <td>{{ $item->metode_pengadaan }}</td>
                <td>{{ 'Rp.' . number_format($item->pagu, 0, ',', '.') . ',-' }}</td>
                <td>{{ date('d F Y', strtotime($item->tgl_pengumuman_paket)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
