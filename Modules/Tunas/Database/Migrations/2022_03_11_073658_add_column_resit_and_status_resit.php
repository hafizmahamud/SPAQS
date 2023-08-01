<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnResitAndStatusResit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->string('resit_path')->nullable();
            $table->string('resit')->nullable();
            $table->string('status_resit')->nullable();
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
            $table->dropColumn('status_resit');
            $table->dropColumn('resit');
            $table->dropColumn('resit_path');

        });
    }
}
