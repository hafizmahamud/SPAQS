<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrafDokumenKontrakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draf_dokumen_kontrak', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->unsignedBigInteger('iklan_perolehan_id');
                $table->timestamp('tarikh_sah_laku');
                $table->timestamp('tarikh_sst');
                $table->string('nama_petender')->nullable();
                $table->string('harga')->nullable();
                $table->string('tempoh')->nullable();
                $table->timestamp('tarikh_sign_sst');
                $table->timestamp('tarikh_sign_dokumen_kontrak');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('pejabat_id');
                $table->timestamps();

            
    
            $table->foreign('iklan_perolehan_id')
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
        Schema::dropIfExists('draf_dokumen_kontrak');
    }
}
