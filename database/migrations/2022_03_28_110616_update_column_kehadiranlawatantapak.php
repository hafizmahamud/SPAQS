<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnKehadiranlawatantapak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('running_number_lawatantapak', function (Blueprint $table) {
            $table->drop('kehadiran_lawatan_tapak_id');
            $table->integer('iklan_perolehan_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('running_number_lawatantapak', function (Blueprint $table) {
            $table->drop('iklan_perolehan_id');
            $table->integer('kehadiran_lawatan_tapak_id');
        });
    }
}
