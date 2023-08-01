<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoCidbToBorangDaftarMinatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->string('gred_kontraktor_cidb')->nullable();
            $table->string('gred_kontraktor_spkk')->nullable();
            $table->string('gred_kontraktor_pukonsa')->nullable();
            $table->string('gred_kontraktor_upkj')->nullable();
            $table->string('gred_kontraktor_sij_bumiputera')->nullable();
            $table->string('no_sijil_sij_bumiputera')->nullable();
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
            $table->dropColumn('gred_kontraktor_cidb');
            $table->dropColumn('gred_kontraktor_spkk');
            $table->dropColumn('gred_kontraktor_pukonsa');
            $table->dropColumn('gred_kontraktor_upkj');
            $table->dropColumn('gred_kontraktor_sij_bumiputera');
            $table->dropColumn('no_sijil_sij_bumiputera');
        });
    }
}
