<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadualHargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehadiran_lawatan_tapak', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('iklan_perolehan_id');
            $table->string('name_syarikat');
            $table->string('no_syarikat');
            $table->string('nama_pegawai_ditauliah');
            $table->string('jawatan');
            $table->string('emel');
            $table->string('notel');
            $table->string('nofax');
            $table->string('alamat');
            $table->datetime('tarikh_masa');
            $table->string('no_siri')->nullable();
            $table->timestamps();

            $table->foreign('iklan_perolehan_id')
            ->references('id')
            ->on('iklan_perolehan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::create('jadual_harga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iklan_perolehan_id');
            $table->unsignedBigInteger('syarikat_id');
            $table->integer('rujukan');
            $table->string('harga');
            $table->string('tempoh');
            $table->string('bulan_minggu');
            $table->string('catatan')->nullable();
            $table->timestamps();

            $table->foreign('iklan_perolehan_id')
            ->references('id')
            ->on('iklan_perolehan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('syarikat_id')
            ->references('id')
            ->on('kehadiran_lawatan_tapak')
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
        Schema::dropIfExists('jadual_harga');
        Schema::dropIfExists('kehadiran_lawatan_tapak');
    }
}
