<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SirupPenyedia extends Model
{
    use HasFactory;
    protected $table = "sirup_penyedia";

    protected $fillable = [
        'tahun_anggaran',
        'kd_klpd',
        'nama_klpd',
        'jenis_klpd',
        'kd_satker',
        'kd_satker_str',
        'nama_satker',
        'kd_rup',
        'nama_paket',
        'pagu',
        'kd_metode_pengadaan',
        'metode_pengadaan',
        'kd_jenis_pengadaan',
        'jenis_pengadaan',
        'status_pradipa',
        'status_pdn',
        'status_ukm',
        'alasan_non_ukm',
        'status_konsolidasi',
        'tipe_paket',
        'kd_rup_swakelola',
        'kd_rup_lokal',
        'volume_pekerjaan',
        'urarian_pekerjaan',
        'spesifikasi_pekerjaan',
        'tgl_awal_pemilihan',
        'tgl_akhir_pemilihan',
        'tgl_awal_kontrak',
        'tgl_akhir_kontrak',
        'tgl_awal_pemanfaatan',
        'tgl_akhir_pemanfaatan',
        'tgl_buat_paket',
        'tgl_pengumuman_paket',
        'nip_ppk',
        'nama_ppk',
        'username_ppk',
        'status_aktif_rup',
        'status_delete_rup',
        'status_umumkan_rup',
        'status_dikecualikan',
        'alasan_dikecualikan',
        'tahun_pertama',
        'kd_rup_tahun_pertama',
        'nomor_kontrak',
        'spp_aspek_ekonomi',
        'spp_aspek_sosial',
        'spp_aspek_lingkungan',
    ];

    protected $casts = [
        'status_aktif_rup' => 'boolean',
        'status_delete_rup' => 'boolean',
        'status_dikecualikan' => 'boolean',
        'spp_aspek_ekonomi' => 'boolean',
        'spp_aspek_sosial' => 'boolean',
        'spp_aspek_lingkungan' => 'boolean',
        'tgl_awal_pemilihan' => 'date',
        'tgl_akhir_pemilihan' => 'date',
        'tgl_awal_kontrak' => 'date',
        'tgl_akhir_kontrak' => 'date',
        'tgl_awal_pemanfaatan' => 'date',
        'tgl_akhir_pemanfaatan' => 'date',
        'tgl_buat_paket' => 'date',
        'tgl_pengumuman_paket' => 'datetime',
    ];
}
