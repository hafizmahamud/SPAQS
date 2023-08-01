<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSyarikatIdColumnAtJadualHargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadual_harga', function (Blueprint $table) {
            //drop column
            $table->dropColumn(['syarikat_id']);
        });

        Schema::table('jadual_harga', function (Blueprint $table) {
            $table->unsignedBigInteger('syarikat_id');

            $table->foreign('syarikat_id')
            ->references('id')
            ->on('borang_daftar_minat')
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
        Schema::table('jadual_harga', function (Blueprint $table) {
            //drop column
            $table->dropColumn('syarikat_id');
        });

    }
}
