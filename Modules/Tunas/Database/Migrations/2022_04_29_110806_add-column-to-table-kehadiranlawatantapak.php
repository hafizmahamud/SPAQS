<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToTableKehadiranlawatantapak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kehadiran_lawatan_tapak', function (Blueprint $table) {
            $table->string('alamat2')->nullable();
            $table->string('alamat3')->nullable();
            $table->string('poskod')->nullable();
            $table->string('bandar')->nullable();
            $table->string('negeri')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kehadiran_lawatan_tapak', function (Blueprint $table) {
            $table->dropColumn('negeri');
            $table->dropColumn('bandar');
            $table->dropColumn('poskod');
            $table->dropColumn('alamat3');
            $table->dropColumn('alamat2');
        });
    }
}
