<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrafPenilaianPerolehanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draf_penilaian_perolehan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('iklan_perolehan_id');
            //$table->bigInteger('mohon_no_perolehan_id')->nullable();
            $table->string('tempoh_sah_laku')->nullable();
            $table->timestamp('tarikh_sah_laku')->nullable();
            $table->timestamp('tarikh_lantik_penilai')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('tarikh_laporan_tender')->nullable();
            $table->timestamp('tarikh_mesy_lembaga')->nullable();
            $table->string('bil_mesy')->nullable();
            $table->timestamp('tarikh_result')->nullable();
            $table->timestamp('tarikh_terima_result')->nullable();
            $table->timestamp('tarikh_edar_result')->nullable();
            $table->integer('keputusan_akhir')->nullable();
            $table->string('harga')->nullable();
            $table->string('tempoh')->nullable();
            $table->string('catatan')->nullable();
            $table->boolean('status_penilaian')->nullable();
            $table->integer('no_pengesyoran')->nullable();
            $table->datetime('tarikh_serah_dokumen_penilaian')->nullable();
            $table->bigInteger('ketua_penilai')->nullable();
            $table->bigInteger('pegawai_penilai_1')->nullable();
            $table->bigInteger('pegawai_penilai_2')->nullable();
            $table->bigInteger('penyedia')->nullable();
            $table->timestamps();
        

        // $table->foreign('iklan_perolehan_id')
        // ->references('id')
        // ->on('iklan_perolehan')
        // ->onUpdate('cascade')
        // ->onDelete('cascade');

        // $table->foreign('user_id')
        // ->references('id')
        // ->on('iklan_perolehan')
        // ->onUpdate('cascade')
        // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('draf_penilaian_perolehan');
    }
}
