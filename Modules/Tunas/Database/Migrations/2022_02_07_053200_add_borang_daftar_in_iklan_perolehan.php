<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBorangDaftarInIklanPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iklan_perolehan', function (Blueprint $table) {
            $table->string('borang_daftar')->nullable()->after('tarikh_akhir_jual');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iklan_perolehan', function (Blueprint $table) {
            $table->dropColumn('borang_daftar');
        });
    }
}
