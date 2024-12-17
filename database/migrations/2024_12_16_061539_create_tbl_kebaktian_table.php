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
        Schema::create('tbl_kebaktian', function (Blueprint $table) {
            $table->id('id_kebaktian');
            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')->references('id_admin')->on('tbl_admin')->onDelete('cascade');
            $table->unsignedBigInteger('id_anggota');
            $table->foreign('id_anggota')->references('id')->on('tbl_organisasi_anggota')->onDelete('cascade');
            $table->enum('jenis_kebaktian', ['minggu', 'khusus', 'keluarga']);
            $table->string('nama_kebaktian');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('lokasi');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kebaktian');
    }
};
