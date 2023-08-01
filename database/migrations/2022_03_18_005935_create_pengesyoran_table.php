<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengesyoranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengesyoran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('penilaian_perolehan_id');
            $table->unsignedBigInteger('syarikat');
            $table->integer('no_pengesyoran');
            $table->timestamps();
        

        $table->foreign('penilaian_perolehan_id')
        ->references('id')
        ->on('penilaian_perolehan')
        ->onUpdate('cascade')
        ->onDelete('cascade');

        $table->foreign('syarikat')
        ->references('id')
        ->on('borang_daftar_minat')
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
        Schema::dropIfExists('pengesyoran');
    }
}
