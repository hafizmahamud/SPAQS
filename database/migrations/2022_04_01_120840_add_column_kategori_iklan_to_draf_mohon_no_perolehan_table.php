<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKategoriIklanToDrafMohonNoPerolehanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('draf_mohon_no_perolehan', function (Blueprint $table) {
            $table->bigInteger('kategori_iklan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('draf_mohon_no_perolehan', function (Blueprint $table) {
            $table->dropColumn('kategori_iklan_id');
        });
    }
}
