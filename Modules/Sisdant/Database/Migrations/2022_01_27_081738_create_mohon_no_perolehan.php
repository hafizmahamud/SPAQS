<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMohonNoPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('mohon_no_perolehan', function (Blueprint $table) {
            $table->bigIncrements('id_perolehan');
            $table->unsignedBigInteger('matrik_iklan_id');
            $table->string('tahun_perolehan', 5);
            $table->string('tajuk_perolehan')->nullable();
            $table->date('tarikh_jangka_iklan');
            $table->unsignedBigInteger('user_id');
            $table->integer('section_id');
            $table->string('no_perolehan', 50)->nullable();
            $table->string('dokumen_muatnaik')->nullable();
            $table->string('status', 10);
            $table->string('justifikasi_batal')->nullable();
            $table->string('dokumen_batal')->nullable();
			$table->timestamps();

            $table->foreign('matrik_iklan_id')
            ->references('id')
            ->on('matrik_iklan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::create('draf_mohon_no_perolehan', function (Blueprint $table) {
            $table->bigIncrements('id_perolehan');
            $table->unsignedBigInteger('matrik_iklan_id');
            $table->string('tahun_perolehan', 5);
            $table->string('tajuk_perolehan')->nullable();
            $table->date('tarikh_jangka_iklan');
            $table->unsignedBigInteger('user_id');
            $table->integer('section_id');
            $table->string('no_perolehan', 50)->nullable();
            $table->string('dokumen_muatnaik')->nullable();
            $table->string('status', 10);
            $table->string('justifikasi_batal')->nullable();
            $table->string('dokumen_batal')->nullable();
			$table->timestamps();

            $table->foreign('matrik_iklan_id')
            ->references('id')
            ->on('matrik_iklan')
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
        Schema::dropIfExists('draf_mohon_no_perolehan');
        Schema::dropIfExists('mohon_no_perolehan');
    }
}
