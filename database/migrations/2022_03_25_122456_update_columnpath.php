<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnpath extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('header_surat', function (Blueprint $table) {
            $table->string('path_jata_negara')->nullable();
            $table->string('path_img_memo')->nullable();
        });

        Schema::table('tandatangan', function (Blueprint $table) {
            $table->string('path_tandatangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('header_surat', function (Blueprint $table) {
            $table->dropColumn('path_jata_negara');
            $table->dropColumn('path_img_memo');
        });

        Schema::table('tandatangan', function (Blueprint $table) {
            $table->dropColumn('path_tandatangan');
        });
    }
}
