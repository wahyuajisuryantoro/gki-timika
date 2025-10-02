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
            $table->text('alamat_pendaftar')->nullable()->after('ktp');
            $table->text('alamat_pasangan')->nullable()->after('alamat_pendaftar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_pendaftaran', function (Blueprint $table) {
            $table->dropColumn(['alamat_pendaftar', 'alamat_pasangan']);
        });
    }
};
