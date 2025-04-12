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
        Schema::create('sirup_swakelola', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_anggaran')->nullable();
            $table->string('kd_klpd', 10)->nullable();
            $table->string('nama_klpd')->nullable();
            $table->string('jenis_klpd', 20)->nullable();
            $table->string('kd_satker', 20)->nullable();
            $table->string('kd_satker_str')->nullable();
            $table->string('nama_satker')->nullable();
            $table->string('kd_rup', 20)->unique()->nullable();
            $table->string('nama_paket')->nullable();
            $table->bigInteger('pagu')->nullable();
            $table->string('tipe_swakelola', 5)->nullable();
            $table->string('volume_pekerjaan')->nullable();
            $table->text('uraian_pekerjaan')->nullable();
            $table->string('kd_klpd_penyelenggara')->nullable();
            $table->string('nama_klpd_penyelenggara')->nullable();
            $table->string('nama_satker_penyelenggara')->nullable();
            $table->date('tgl_awal_pelaksanaan_kontrak')->nullable();
            $table->date('tgl_akhir_pelaksanaan_kontrak')->nullable();
            $table->date('tgl_buat_paket')->nullable();
            $table->dateTime('tgl_pengumuman_paket')->nullable();
            $table->string('nip_ppk', 20)->nullable();
            $table->string('nama_ppk')->nullable();
            $table->string('username_ppk')->nullable();
            $table->string('kd_rup_lokal')->nullable();
            $table->boolean('status_aktif_rup')->nullable();
            $table->boolean('status_delete_rup')->nullable();
            $table->string('status_umumkan_rup')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sirup_swakelola');
    }
};
