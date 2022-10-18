<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('promotion_id', 20);
            $table->text('sk_cpns');
            $table->text('sk_pns');
            $table->text('sk_pangkat_terakhir');
            $table->text('kartu_pegawai');
            $table->text('ijazah_lama')->nullable();
            $table->text('ijazah_baru');
            $table->text('transkrip_lama')->nullable();
            $table->text('transkrip_baru');
            $table->text('skp_lama');
            $table->text('skp_baru');
            $table->text('sttpl')->nullable();
            $table->text('sk_mutasi')->nullable();
            $table->text('sk_pengalihan')->nullable();
            $table->text('sk_fungsional')->nullable();
            $table->text('pak_asli')->nullable();
            $table->text('pak_lama')->nullable();
            $table->text('sk_penyesuaian_fungsional')->nullable();
            $table->text('sk_kenaikan_fungsional')->nullable();
            $table->text('sertifikat_pim')->nullable();
            $table->text('surat_pelantikan')->nullable();
            $table->text('surat_lowong')->nullable();
            $table->text('surat_tugas')->nullable();
            $table->text('sk_pelantikan')->nullable();
            $table->text('sk_jabatan')->nullable();
            $table->text('sk_belajar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
