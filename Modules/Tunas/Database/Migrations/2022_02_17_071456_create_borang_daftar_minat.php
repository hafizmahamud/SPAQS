<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorangDaftarMinat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borang_daftar_minat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iklan_perolehan_id');
            $table->unsignedBigInteger('kehadiran_lawatan_tapak_id');

            $table->string('nama_syarikat');
            $table->string('no_syarikat');
            $table->string('nama_pegawai');
            $table->string('telno_fax');
            $table->string('telno_fon');
            $table->string('alamat_syarikat');
            $table->string('emel_rasmi');

            $table->string('no_mof')->nullable();
            $table->datetime('tarikh_tamat_mof')->nullable();
            $table->json('kod_sub_bidang_mof')->nullable();
            $table->string('doc_sijil_mof_path')->nullable();
            $table->string('doc_sijil_mof_nama')->nullable();

            $table->string('no_cidb')->nullable();
            $table->datetime('tarikh_tamat_cidb')->nullable();
            $table->json('kelas_pengkhususan_cidb')->nullable();
            $table->string('doc_sijil_cidb_path')->nullable();
            $table->string('doc_sijil_cidb_nama')->nullable();

            $table->string('doc_sijil_kebenaran_khas_path')->nullable();
            $table->string('doc_sijil_kebenaran_khas_nama')->nullable();

            $table->string('no_sijil_spkk')->nullable();
            $table->datetime('tarikh_tamat_spkk')->nullable();
            $table->string('doc_sijil_spkk_path')->nullable();
            $table->string('doc_sijil_spkk_nama')->nullable();

            $table->string('no_sijil_pukonsa')->nullable();
            $table->datetime('tarikh_tamat_pukonsa')->nullable();
            $table->string('doc_sijil_pukonsa_path')->nullable();
            $table->string('doc_sijil_pukonsa_nama')->nullable();

            $table->string('no_sijil_upkj')->nullable();
            $table->datetime('tarikh_tamat_upkj')->nullable();
            $table->string('doc_sijil_upkj_path')->nullable();
            $table->string('doc_sijil_upkj_nama')->nullable();

            $table->datetime('tarikh_tamat_sij_bumiputera')->nullable();
            $table->string('doc_sijil_sij_bumiputera_path')->nullable();
            $table->string('doc_sijil_sij_bumiputera_nama')->nullable();

            $table->string('status_petender')->nullable();
            $table->string('no_siri')->nullable();
            $table->string('status_emel')->nullable();

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
        Schema::dropIfExists('borang_daftar_minat');
    }
}
