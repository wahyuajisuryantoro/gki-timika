<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tbl_pendaftaran', function (Blueprint $table) {
            $table->string('kartu_keluarga_pasangan')->nullable()->after('ktp_pasangan');
            $table->string('surat_baptis_pasangan')->nullable()->after('kartu_keluarga_pasangan');
            $table->string('surat_sidi_pasangan')->nullable()->after('surat_baptis_pasangan');
            $table->string('pas_foto_pasangan')->nullable()->after('surat_sidi_pasangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_pendaftaran', function (Blueprint $table) {
             $table->dropColumn([
                'kartu_keluarga_pasangan',
                'surat_baptis_pasangan',
                'surat_sidi_pasangan',
                'pas_foto_pasangan',
            ]);
        });
    }
};
