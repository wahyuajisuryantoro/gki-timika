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
        Schema::table('tbl_pendaftaran', function (Blueprint $table) {
           $table->string('nomor_induk_jemaat_pasangan')->nullable()->after('saksi2');
            $table->string('nama_pasangan')->nullable()->after('nomor_induk_jemaat_pasangan');
            $table->string('nama_ayah_pasangan')->nullable()->after('nama_pasangan');
            $table->string('nama_ibu_pasangan')->nullable()->after('nama_ayah_pasangan');
            $table->string('ktp_pasangan')->nullable()->after('pas_foto');
            
            // Add foreign key for partner if they are jemaat
            $table->foreign('nomor_induk_jemaat_pasangan')
                  ->references('nomor_induk_jemaat')
                  ->on('tbl_jemaat')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('tbl_pendaftaran', function (Blueprint $table) {
            $table->dropForeign(['nomor_induk_jemaat_pasangan']);
            $table->dropColumn([
                'nomor_induk_jemaat_pasangan',
                'nama_pasangan',
                'nama_ayah_pasangan', 
                'nama_ibu_pasangan',
                'ktp_pasangan'
            ]);
        });
    }
};
