<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBayaranKepadaColumnType extends Migration
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
            $table->dropColumn(['cara_bayaran', 'bayar_kepada']);
        });

        Schema::table('iklan_perolehan', function (Blueprint $table) {
            //add new column
            $table->unsignedBigInteger('cara_bayaran_id');
            $table->unsignedBigInteger('bayar_kepada_id');

            $table->foreign('cara_bayaran_id')
            ->references('id')
            ->on('cara_bayar')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('bayar_kepada_id')
            ->references('id')
            ->on('bayar_kepada')
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
        Schema::table('iklan_perolehan', function (Blueprint $table) {

            $table->dropColumn('cara_bayaran_id');
            $table->dropColumn('bayar_kepada_id');
        });
    }
}
