<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sirup_penyedia', function (Blueprint $table) {
            $table->id();

            $table->year('tahun_anggaran');
            $table->string('kd_klpd')->nullable();
            $table->string('nama_klpd')->nullable();
            $table->string('jenis_klpd')->nullable();
            $table->bigInteger('kd_satker')->nullable();
            $table->string('kd_satker_str')->nullable();
            $table->string('nama_satker')->nullable();
            $table->string('kd_rup')->unique();
            $table->string('nama_paket');
            $table->unsignedBigInteger('pagu');
            $table->string('kd_metode_pengadaan')->nullable();
            $table->string('metode_pengadaan')->nullable();
            $table->string('kd_jenis_pengadaan')->nullable();
            $table->string('jenis_pengadaan')->nullable();
            $table->string('status_pradipa')->nullable();
            $table->string('status_pdn')->nullable();
            $table->string('status_ukm')->nullable();
            $table->string('alasan_non_ukm')->nullable();
            $table->string('status_konsolidasi')->nullable();
            $table->string('tipe_paket')->nullable();
            $table->string('kd_rup_swakelola')->nullable();
            $table->string('kd_rup_lokal')->nullable();
            $table->string('volume_pekerjaan')->nullable();
            $table->text('urarian_pekerjaan')->nullable();
            $table->text('spesifikasi_pekerjaan')->nullable();

            $table->date('tgl_awal_pemilihan')->nullable();
            $table->date('tgl_akhir_pemilihan')->nullable();
            $table->date('tgl_awal_kontrak')->nullable();
            $table->date('tgl_akhir_kontrak')->nullable();
            $table->date('tgl_awal_pemanfaatan')->nullable();
            $table->date('tgl_akhir_pemanfaatan')->nullable();
            $table->date('tgl_buat_paket')->nullable();
            $table->timestamp('tgl_pengumuman_paket')->nullable();

            $table->string('nip_ppk')->nullable();
            $table->string('nama_ppk')->nullable();
            $table->string('username_ppk')->nullable();

            $table->boolean('status_aktif_rup')->default(true);
            $table->boolean('status_delete_rup')->default(false);
            $table->string('status_umumkan_rup')->nullable();
            $table->boolean('status_dikecualikan')->default(false);
            $table->string('alasan_dikecualikan')->nullable();

            $table->integer('tahun_pertama')->nullable();
            $table->string('kd_rup_tahun_pertama')->nullable();
            $table->string('nomor_kontrak')->nullable();

            $table->boolean('spp_aspek_ekonomi')->default(false);
            $table->boolean('spp_aspek_sosial')->default(false);
            $table->boolean('spp_aspek_lingkungan')->default(false);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sirup_penyedia');
    }
};
