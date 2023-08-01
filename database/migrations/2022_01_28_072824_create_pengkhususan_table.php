<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengkhususanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengkhususan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kod')->nullable();
            $table->string('pengkhususan')->nullable();
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();
        });

        Schema::table('pengkhususan', function (Blueprint $table) {
            $table->foreign('kelas_id')->references('id')->on('kelas')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengkhususan');
    }
}
