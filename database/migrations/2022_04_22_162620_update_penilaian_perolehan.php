<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePenilaianPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_perolehan', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'ketua_penilai',
                    'pegawai_penilai_1',
                    'pegawai_penilai_2',
                ]
            );
        });

        Schema::table('penilaian_perolehan', function (Blueprint $table) {
            $table->unsignedBigInteger('ketua_penilai')->after('tarikh_serah_dokumen_penilaian');
            $table->unsignedBigInteger('pegawai_penilai_1')->after('ketua_penilai');
            $table->unsignedBigInteger('pegawai_penilai_2')->after('ketua_penilai');

            $table->foreign('ketua_penilai')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pegawai_penilai_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pegawai_penilai_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_perolehan', function (Blueprint $table) {
            $table->dropColumn('ketua_penilai');
            $table->dropColumn('pegawai_penilai_1');
            $table->dropColumn('pegawai_penilai_2');
        });

        Schema::table('penilaian_perolehan', function (Blueprint $table) {
            $table->BigInteger('ketua_penilai');
            $table->BigInteger('pegawai_penilai_1');
            $table->BigInteger('pegawai_penilai_2');
    
        });
    }
}
