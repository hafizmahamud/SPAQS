<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnButiranMemoInTablePenilaianPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_perolehan', function (Blueprint $table) {
            $table->string('no_rujukan')->nullable()->after('penyedia');
            $table->bigInteger('tempoh_sedia_lt')->nullable()->after('no_rujukan');
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
            $table->dropColumn('no_rujukan');
            $table->dropColumn('tempoh_sedia_lt');
        });
    }
}
