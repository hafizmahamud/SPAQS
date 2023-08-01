<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('penilaian_perolehan_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('jenis_penilai');
            $table->timestamps();
        

        $table->foreign('penilaian_perolehan_id')
        ->references('id')
        ->on('iklan_perolehan')
        ->onUpdate('cascade')
        ->onDelete('cascade');

        $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onUpdate('cascade')
        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilai');
    }
}
