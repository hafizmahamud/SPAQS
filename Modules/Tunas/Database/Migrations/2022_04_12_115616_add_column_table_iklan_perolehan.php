<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTableIklanPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iklan_perolehan', function (Blueprint $table) {
            $table->unsignedBigInteger('dibatalkan_oleh')->nullable();
            $table->datetime('tarikh_batal')->nullable();

            $table->foreign('dibatalkan_oleh')
            ->references('id')
            ->on('users')
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
            $table->dropColumn('tarikh_batal');
            $table->dropColumn('dibatalkan_oleh');
        });
    }
}
