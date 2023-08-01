<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubBidangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_bidang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kod')->nullable();
            $table->string('sub_bidang')->nullable();
            $table->unsignedBigInteger('bidang_id');
            $table->timestamps();
        });

        Schema::table('sub_bidang', function (Blueprint $table) {
            $table->foreign('bidang_id')->references('id')->on('bidang')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_bidang');
    }
}
