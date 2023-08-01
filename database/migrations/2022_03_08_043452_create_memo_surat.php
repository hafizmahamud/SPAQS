<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tandatangan', function (Blueprint $table) {
            $table->id();
            $table->string('tandatangan')->nullable();
            $table->string('nama')->nullable();
            $table->string('jawatan')->nullable();
            $table->timestamps();
        });

        Schema::create('header_surat', function (Blueprint $table) {
            $table->id();
            $table->string('jata_negara')->nullable();
            $table->string('img_memo')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('kementerian')->nullable();
            $table->string('alamat')->nullable();
            $table->string('laman_web')->nullable();
            $table->string('no_tel')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('memo_lantikan_penilai', function (Blueprint $table) {
            $table->id();
            $table->text('text_1')->nullable();
            $table->text('text_2')->nullable();
            $table->text('text_3')->nullable();
            $table->text('text_4')->nullable();
            $table->text('moto_1')->nullable();
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
        Schema::dropIfExists('tandatangan');
        Schema::dropIfExists('header_surat');
        Schema::dropIfExists('memo_lantikan_penilai');
    }
}
