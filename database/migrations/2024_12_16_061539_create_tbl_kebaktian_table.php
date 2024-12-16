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
            $table->foreignId('id_admin')->constrained('admin');
            $table->foreignId('id_anggota_organisasi')->constrained('tbl_organisasi_anggota');
            $table->enum('jenis_kebaktian', ['umum', 'pemuda', 'anak', 'kategorial']);
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
