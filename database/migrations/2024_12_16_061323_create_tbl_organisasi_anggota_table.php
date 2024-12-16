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
        Schema::create('tbl_organisasi_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('tbl_organisasi_kategori')->onDelete('cascade');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto')->nullable();
            $table->integer('urutan');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_organisasi_anggota');
    }
};
