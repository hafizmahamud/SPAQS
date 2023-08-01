<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnPenilaianPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_perolehan', function (Blueprint $table) {
            $table->BigInteger('ketua_penilai')->nullable()->change();
            $table->BigInteger('pegawai_penilai_1')->nullable()->change();
            $table->BigInteger('pegawai_penilai_2')->nullable()->change();

        });

        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'gred_kontraktor_pukonsa',
                    'gred_kontraktor_upkj',
                ]
            );
        });

        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->json('gred_kontraktor_pukonsa')->nullable();
            $table->json('gred_kontraktor_upkj')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->BigInteger('ketua_penilai');
            $table->BigInteger('pegawai_penilai_1');
            $table->BigInteger('pegawai_penilai_2');
        });

        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->dropColumn('gred_kontraktor_pukonsa');
            $table->dropColumn('gred_kontraktor_upkj');
        });

        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->string('gred_kontraktor_pukonsa')->nullable();
            $table->string('gred_kontraktor_upkj')->nullable();
        });
    }
}
