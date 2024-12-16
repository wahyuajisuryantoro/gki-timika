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
        Schema::create('tbl_informasi', function (Blueprint $table) {
            $table->id('id_informasi');
            $table->text('konten');
            $table->enum('kategori', ['pengumuman', 'berita', 'artikel']);
            $table->date('tanggal_diterbitkan');
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->string('gambar')->nullable();
            $table->string('penulis');
            $table->enum('status', ['draft', 'published', 'archived']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_informasi');
    }
};
