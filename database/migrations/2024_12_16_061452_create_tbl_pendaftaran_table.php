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
        Schema::create('tbl_pendaftaran', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->string('nomor_induk_jemaat');
            $table->foreign('nomor_induk_jemaat')->references('nomor_induk_jemaat')->on('tbl_jemaat')
            ->onDelete('cascade');
            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')->references('id_admin')->on('tbl_admin')->onDelete('cascade');
            $table->enum('jenis_pendaftaran', ['baptis', 'sidi', 'nikah']);
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('saksi1')->nullable();
            $table->string('saksi2')->nullable();
            $table->timestamp('tanggal_pendaftaran');
            $table->date('tanggal_pelaksanaan');
            $table->enum('status_pendaftaran', ['pending', 'approved', 'rejected']);
            $table->text('catatan')->nullable();
            $table->string('surat_baptis')->nullable();
            $table->string('surat_sidi')->nullable();
            $table->string('kartu_keluarga');
            $table->string('ktp')->nullable();
            $table->string('pas_foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pendaftaran');
    }
};
