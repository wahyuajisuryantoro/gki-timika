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
        Schema::create('tbl_keluarga', function (Blueprint $table) {
            $table->id('id_keluarga');
            $table->string('nomor_induk_keluarga');
            $table->string('nama_kepala_keluarga');
            $table->string('alamat');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('nomor_telepon');
            $table->integer('jumlah_anggota');
            $table->enum('status_keluarga', ['aktif', 'tidak_aktif']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_keluarga');
    }
};
