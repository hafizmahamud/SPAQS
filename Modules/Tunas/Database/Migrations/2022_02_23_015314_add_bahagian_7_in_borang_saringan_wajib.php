<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBahagian7InBorangSaringanWajib extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('templat_borang_daftar', function (Blueprint $table) {
            $table->boolean('bahagian_7');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('templat_borang_daftar', function (Blueprint $table) {
            $table->dropColumn('bahagian_7');

        });
    }
}
