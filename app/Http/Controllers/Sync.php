<?php

namespace App\Http\Controllers;

use App\Models\Satker;
use App\Models\SirupPenyedia;
use App\Models\SirupSwakelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Sync extends Controller
{
    public function syncpenyedia(Request $request)
    {
        $kd_klpd = "D349";
        $tahun = $request->tahun ?? now()->year;
        $url = env('API_SIRUP_PENYEDIA') . $tahun . ':' . $kd_klpd;
        $response = Http::get($url);
        $data = $response->json();

        $batchSize = 100;

        DB::transaction(function () use ($data, $batchSize) {
            foreach (array_chunk($data, $batchSize) as $batch) {
                foreach ($batch as $item) {
                    $uniqueKeys = [
                        'kd_rup' => $item['kd_rup'],
                    ];

                    SirupPenyedia::updateOrCreate($uniqueKeys, [
                        'tahun_anggaran' => $item['tahun_anggaran'],
                        'kd_klpd' => $item['kd_klpd'],
                        'nama_klpd' => $item['nama_klpd'],
                        'jenis_klpd' => $item['jenis_klpd'],
                        'kd_satker' => $item['kd_satker'],
                        'kd_satker_str' => $item['kd_satker_str'],
                        'nama_satker' => $item['nama_satker'],
                        'nama_paket' => $item['nama_paket'],
                        'pagu' => $item['pagu'],
                        'kd_metode_pengadaan' => $item['kd_metode_pengadaan'],
                        'metode_pengadaan' => $item['metode_pengadaan'],
                        'kd_jenis_pengadaan' => $item['kd_jenis_pengadaan'],
                        'jenis_pengadaan' => $item['jenis_pengadaan'],
                        'status_pradipa' => $item['status_pradipa'],
                        'status_pdn' => $item['status_pdn'],
                        'status_ukm' => $item['status_ukm'],
                        'alasan_non_ukm' => $item['alasan_non_ukm'],
                        'status_konsolidasi' => $item['status_konsolidasi'],
                        'tipe_paket' => $item['tipe_paket'],
                        'kd_rup_swakelola' => $item['kd_rup_swakelola'],
                        'kd_rup_lokal' => $item['kd_rup_lokal'],
                        'volume_pekerjaan' => $item['volume_pekerjaan'],
                        'urarian_pekerjaan' => $item['urarian_pekerjaan'],
                        'spesifikasi_pekerjaan' => $item['spesifikasi_pekerjaan'],
                        'tgl_awal_pemilihan' => $item['tgl_awal_pemilihan'],
                        'tgl_akhir_pemilihan' => $item['tgl_akhir_pemilihan'],
                        'tgl_awal_kontrak' => $item['tgl_awal_kontrak'],
                        'tgl_akhir_kontrak' => $item['tgl_akhir_kontrak'],
                        'tgl_awal_pemanfaatan' => $item['tgl_awal_pemanfaatan'],
                        'tgl_akhir_pemanfaatan' => $item['tgl_akhir_pemanfaatan'],
                        'tgl_buat_paket' => $item['tgl_buat_paket'],
                        'tgl_pengumuman_paket' => $item['tgl_pengumuman_paket'],
                        'nip_ppk' => $item['nip_ppk'],
                        'nama_ppk' => $item['nama_ppk'],
                        'username_ppk' => $item['username_ppk'],
                        'status_aktif_rup' => $item['status_aktif_rup'],
                        'status_delete_rup' => $item['status_delete_rup'],
                        'status_umumkan_rup' => $item['status_umumkan_rup'],
                        'status_dikecualikan' => $item['status_dikecualikan'],
                        'alasan_dikecualikan' => $item['alasan_dikecualikan'],
                        'tahun_pertama' => $item['tahun_pertama'],
                        'kd_rup_tahun_pertama' => $item['kd_rup_tahun_pertama'],
                        'nomor_kontrak' => $item['nomor_kontrak'],
                        'spp_aspek_ekonomi' => $item['spp_aspek_ekonomi'],
                        'spp_aspek_sosial' => $item['spp_aspek_sosial'],
                        'spp_aspek_lingkungan' => $item['spp_aspek_lingkungan'],
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'Sinkronisasi Penyedia berhasil!');
    }

    public function syncswakelola(Request $request)
    {
        $kd_klpd = "D349";
        $tahun = $request->tahun ?? now()->year;
        $url = env('API_SIRUP_SWAKELOLA') . $tahun . ':' . $kd_klpd;
        $response = Http::get($url);
        $data = $response->json();

        $batchSize = 100;

        DB::transaction(function () use ($data, $batchSize) {
            foreach (array_chunk($data, $batchSize) as $batch) {
                foreach ($batch as $item) {
                    $uniqueKeys = [
                        'kd_rup' => $item['kd_rup'],
                    ];

                    SirupSwakelola::updateOrCreate($uniqueKeys, [
                        'tahun_anggaran' => $item['tahun_anggaran'],
                        'kd_klpd' => $item['kd_klpd'],
                        'nama_klpd' => $item['nama_klpd'],
                        'jenis_klpd' => $item['jenis_klpd'],
                        'kd_satker' => $item['kd_satker'],
                        'kd_satker_str' => $item['kd_satker_str'],
                        'nama_satker' => $item['nama_satker'],
                        'nama_paket' => $item['nama_paket'],
                        'pagu' => $item['pagu'],
                        'tipe_swakelola' => $item['tipe_swakelola'],
                        'volume_pekerjaan' => $item['volume_pekerjaan'],
                        'uraian_pekerjaan' => $item['uraian_pekerjaan'],
                        'kd_klpd_penyelenggara' => $item['kd_klpd_penyelenggara'],
                        'nama_klpd_penyelenggara' => $item['nama_klpd_penyelenggara'],
                        'nama_satker_penyelenggara' => $item['nama_satker_penyelenggara'],
                        'tgl_awal_pelaksanaan_kontrak' => $item['tgl_awal_pelaksanaan_kontrak'],
                        'tgl_akhir_pelaksanaan_kontrak' => $item['tgl_akhir_pelaksanaan_kontrak'],
                        'tgl_buat_paket' => $item['tgl_buat_paket'],
                        'tgl_pengumuman_paket' => $item['tgl_pengumuman_paket'],
                        'nip_ppk' => $item['nip_ppk'],
                        'nama_ppk' => $item['nama_ppk'],
                        'username_ppk' => $item['username_ppk'],
                        'kd_rup_lokal' => $item['kd_rup_lokal'],
                        'status_aktif_rup' => $item['status_aktif_rup'],
                        'status_delete_rup' => $item['status_delete_rup'],
                        'status_umumkan_rup' => $item['status_umumkan_rup'],
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'Sinkronisasi Swakelola berhasil!');
    }

    public function syncsatker(Request $request)
    {
        $kd_klpd = "D349";
        $tahun = $request->tahun ?? now()->year;
        $url = env('API_SIRUP_MASTER_SATKER') . $kd_klpd . ':' . $tahun;
        $response = Http::get($url);
        $data = $response->json();

        $batchSize = 100;

        DB::transaction(function () use ($data, $batchSize) {
            foreach (array_chunk($data, $batchSize) as $batch) {
                foreach ($batch as $item) {
                    $uniqueKeys = [
                        'kd_satker' => $item['kd_satker'],
                    ];

                    Satker::updateOrCreate($uniqueKeys, [
                        'kd_satker_str' => $item['kd_satker_str'],
                        'nama_satker' => $item['nama_satker'],
                        'alamat' => $item['alamat'] ?? null,
                        'telepon' => $item['telepon'] ?? null,
                        'fax' => $item['fax'] ?? null,
                        'kodepos' => $item['kodepos'] ?? null,
                        'status_satker' => $item['status_satker'],
                        'ket_satker' => $item['ket_satker'],
                        'jenis_satker' => $item['jenis_satker'],
                        'kd_klpd' => $item['kd_klpd'],
                        'nama_klpd' => $item['nama_klpd'],
                        'jenis_klpd' => $item['jenis_klpd'],
                        'kode_eselon' => $item['kode_eselon'] ?? null,
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'Sinkronisasi Satker Berhasil!');
    }
}
