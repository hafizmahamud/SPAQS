<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCoverDokumenInBorangSaringanWajib extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->string('cover_dokumen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->dropColumn('cover_dokumen');
        });
    }
}
