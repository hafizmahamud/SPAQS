<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratakuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_akuan_pelantikan', function (Blueprint $table) {
            $table->id();
            $table->text('tajuk')->nullable();
            $table->text('text_1')->nullable();
            $table->text('text_2')->nullable();
            $table->text('text_3')->nullable();
            $table->text('text_4')->nullable();
            $table->text('text_5')->nullable();
            $table->text('text_6')->nullable();
            $table->text('text_7')->nullable();
            $table->text('text_8')->nullable();
            $table->timestamps();
        });

        Schema::create('surat_akuan_selesai_tugas', function (Blueprint $table) {
            $table->id();
            $table->text('tajuk')->nullable();
            $table->text('text_1')->nullable();
            $table->text('text_2')->nullable();
            $table->text('text_3')->nullable();
            $table->text('text_4')->nullable();
            $table->text('text_5')->nullable();
            $table->text('text_6')->nullable();
            $table->text('text_7')->nullable();
            $table->timestamps();
        });

        Schema::create('surat_hantar_dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('rujukan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('up')->nullable();
			$table->text('title')->nullable();
            $table->string('tajuk')->nullable();
            $table->text('text_1')->nullable();
            $table->text('text_2')->nullable();
            $table->text('text_3')->nullable();
            $table->text('moto')->nullable();
            $table->string('sym')->nullable();
            $table->timestamps();
        });

        Schema::create('surat_lanjut_sahlaku', function (Blueprint $table) {
            $table->id();
            $table->string('rujukan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('up')->nullable();
			$table->string('title')->nullable();
            $table->string('tajuk')->nullable();
            $table->text('text_1')->nullable();
            $table->text('text_2')->nullable();
            $table->text('moto')->nullable();
            $table->string('sym')->nullable();
            $table->string('nama')->nullable();
            $table->string('jawatan')->nullable();
            $table->string('kementerian')->nullable();
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
        Schema::dropIfExists('surat_akuan_pelantikan');
        Schema::dropIfExists('surat_akuan_selesai_tugas');
        Schema::dropIfExists('surat_hantar_dokumen');
        Schema::dropIfExists('surat_lanjut_sahlaku');

    }
}
