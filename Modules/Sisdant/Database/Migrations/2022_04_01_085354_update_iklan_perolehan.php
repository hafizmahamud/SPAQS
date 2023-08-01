<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIklanPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iklan_perolehan', function (Blueprint $table) {
            //drop column
            $table->dropColumn(
                [
                    'tarikh_mula_jual',
                    'tarikh_akhir_jual',
                    'tarikh_lawatan_tapak',
                    'waktu_lapor',
                    'tarikh_keluar_iklan',
                    'tarikh_waktu_tutup',
                    'grade_id'
                ]
            );
        });

        Schema::table('iklan_perolehan', function (Blueprint $table) {
            $table->datetime('tarikh_mula_jual')->nullable();
            $table->datetime('tarikh_akhir_jual')->nullable();
            $table->datetime('tarikh_lawatan_tapak')->nullable();
            $table->time('waktu_lapor')->nullable();
            $table->datetime('tarikh_keluar_iklan')->nullable();
            $table->datetime('tarikh_waktu_tutup')->nullable();
            $table->unsignedBigInteger('grade_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iklan_perolehan', function (Blueprint $table) {
            $table->dropColumn('tarikh_mula_jual');
            $table->dropColumn('tarikh_akhir_jual');
            $table->dropColumn('tarikh_lawatan_tapak');
            $table->dropColumn('waktu_lapor');
            $table->dropColumn('tarikh_keluar_iklan');
            $table->dropColumn('tarikh_waktu_tutup');
            $table->dropColumn('grade_id');
        });

        Schema::table('iklan_perolehan', function (Blueprint $table) {
            $table->datetime('tarikh_mula_jual');
            $table->datetime('tarikh_akhir_jual');
            $table->datetime('tarikh_lawatan_tapak');
            $table->time('waktu_lapor');
            $table->datetime('tarikh_keluar_iklan');
            $table->datetime('tarikh_waktu_tutup');
            $table->unsignedBigInteger('grade_id');
        });
    }
}
