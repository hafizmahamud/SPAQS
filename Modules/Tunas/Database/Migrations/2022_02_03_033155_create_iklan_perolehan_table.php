<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIklanPerolehanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_iklan', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('iklan_perolehan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mohon_no_perolehan_id')->nullable();
            $table->unsignedBigInteger('matrik_iklan_id');
            $table->string('tajuk')->nullable();
            $table->datetime('tarikh_mula_jual');
            $table->datetime('tarikh_akhir_jual');
            $table->string('pejabat_pamer_jual')->nullable();
            $table->datetime('tarikh_lawatan_tapak');
            $table->string('lawatan_tapak')->nullable();
            $table->string('pejabat_lapor')->nullable();
            $table->time('waktu_lapor');
            $table->string('harga_dokumen')->nullable();
            $table->string('cara_bayaran')->nullable();
            $table->string('bayar_kepada')->nullable();
            $table->string('lokasi_tapak')->nullable();
            $table->string('peti_tender')->nullable();
            $table->datetime('tarikh_keluar_iklan');
            $table->datetime('tarikh_waktu_tutup');
            $table->unsignedBigInteger('status_iklan_id');
            $table->string('justifikasi_batal')->nullable();
            $table->string('dokumen_batal')->nullable();
            $table->integer('status_kemaskini')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('mohon_no_perolehan_id')
            ->references('id_perolehan')
            ->on('mohon_no_perolehan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('matrik_iklan_id')
            ->references('id')
            ->on('matrik_iklan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('status_iklan_id')
            ->references('id')
            ->on('status_iklan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::create('bidang_subbidang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iklan_perolehan_id');
            $table->unsignedBigInteger('bidang_id');
            $table->unsignedBigInteger('sub_bidang_id');
			$table->timestamps();

            $table->foreign('iklan_perolehan_id')
            ->references('id')
            ->on('iklan_perolehan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('bidang_id')
            ->references('id')
            ->on('bidang')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('sub_bidang_id')
            ->references('id')
            ->on('sub_bidang')
            ->onUpdate('cascade')
            ->onDelete('cascade');

        });

        Schema::create('kelas_pengkhususan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iklan_perolehan_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('pengkhususan_id');
			$table->timestamps();

            $table->foreign('iklan_perolehan_id')
            ->references('id')
            ->on('iklan_perolehan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('kelas_id')
            ->references('id')
            ->on('kelas')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('pengkhususan_id')
            ->references('id')
            ->on('pengkhususan')
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
        Schema::dropIfExists('kelas_pengkhususan');
        Schema::dropIfExists('bidang_subbidang');
        Schema::dropIfExists('iklan_perolehan');
        Schema::dropIfExists('status_iklan');
    }
}
