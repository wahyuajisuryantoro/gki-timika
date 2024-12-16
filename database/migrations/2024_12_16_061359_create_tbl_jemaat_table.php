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
        Schema::create('tbl_jemaat', function (Blueprint $table) {
            $table->id('id_jemaat');
            $table->foreignId('id_keluarga')->constrained('tbl_keluarga')->onDelete('cascade');
            $table->string('nomor_induk_jemaat')->unique();
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('status_pernikahan', ['belum_menikah', 'menikah', 'cerai', 'duda', 'janda']);
            $table->string('alamat_rumah');
            $table->string('nomor_telepon')->nullable();
            $table->string('email')->nullable();
            $table->date('tanggal_baptis')->nullable();
            $table->date('tanggal_sidi')->nullable();
            $table->enum('status_keanggotaan', ['aktif', 'tidak_aktif', 'meninggal', 'pindah']);
            $table->string('pekerjaan')->nullable();
            $table->text('catatan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_jemaat');
    }
};
