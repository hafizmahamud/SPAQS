<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTarikhKemaskiniPenilaianInTableIklanPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iklan_perolehan', function (Blueprint $table) {
            $table->datetime('tarikh_kemaskini_penilaian')->nullable();
            $table->bigInteger('status_kemaskini_penilaian')->nullable();
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
            $table->dropColumn('tarikh_kemaskini_penilaian');
            $table->dropColumn('status_kemaskini_penilaian');
        });
    }
}
