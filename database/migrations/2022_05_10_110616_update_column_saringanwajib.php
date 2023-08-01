<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnSaringanwajib extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->unsignedBigInteger('grade_id')->nullable();
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
            $table->dropColumn('grade_id')->nullable();
        });
    }
}
