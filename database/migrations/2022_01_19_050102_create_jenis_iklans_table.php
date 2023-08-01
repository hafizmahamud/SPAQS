<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisIklansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_iklan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
			$table->timestamps();
        });

        Schema::create('kategori_perolehan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
			$table->timestamps();
        });

        Schema::create('jenis_tender', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
			$table->timestamps();
        });

        Schema::create('matrik_iklan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_iklan_id')->nullable();
            $table->unsignedBigInteger('kategori_perolehan_id')->nullable();
            $table->unsignedBigInteger('jenis_tender_id')->nullable();
			$table->boolean('upload_iklan');
			$table->timestamps();

            $table->foreign('jenis_iklan_id')
            ->references('id')
            ->on('jenis_iklan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('kategori_perolehan_id')
            ->references('id')
            ->on('kategori_perolehan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('jenis_tender_id')
            ->references('id')
            ->on('jenis_tender')
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
        Schema::dropIfExists('matrik_iklan');
        Schema::dropIfExists('kategori_perolehan');
        Schema::dropIfExists('jenis_tender');
        Schema::dropIfExists('jenis_iklan');

    }
}
