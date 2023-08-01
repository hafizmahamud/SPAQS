<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateBorangDaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templat_borang_daftar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iklan_perolehan_id');
            $table->boolean('bahagian_1');
            $table->boolean('bahagian_2');
            $table->boolean('bahagian_3');
            $table->boolean('bahagian_4');
            $table->boolean('bahagian_5');
            $table->boolean('bahagian_6');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templat_borang_daftar');
    }
}
