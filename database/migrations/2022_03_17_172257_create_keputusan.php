<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeputusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_edar_keputusan', function (Blueprint $table) {
            $table->id();
            $table->string('rujukan')->nullable();
            $table->text('alamat')->nullable();
			$table->string('title')->nullable();
            $table->string('kementerian')->nullable();
            $table->text('text_1')->nullable();
            $table->text('text_2')->nullable();
            $table->text('moto')->nullable();
            $table->string('sym')->nullable();
            $table->timestamps();
        });

        Schema::create('memo_edar_keputusan', function (Blueprint $table) {
            $table->id();
            $table->string('rujukan')->nullable();
            $table->string('perkara')->nullable();
            $table->string('kementerian')->nullable();
            $table->text('kementerian1')->nullable();
            $table->text('text_1')->nullable();
            $table->text('title')->nullable();
            $table->text('text_3')->nullable();
            $table->text('moto')->nullable();
            $table->string('sym')->nullable();
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
        Schema::dropIfExists('surat_edar_keputusan');
        Schema::dropIfExists('memo_edar_keputusan');
    }
}
