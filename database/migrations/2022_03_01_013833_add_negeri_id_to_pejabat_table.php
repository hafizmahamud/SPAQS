<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNegeriIdToPejabatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pejabat', function (Blueprint $table) {
            $table->unsignedBigInteger('negeri_id')->after('singkatan');

            $table->foreign('negeri_id')->references('id')->on('negeri')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pejabat', function (Blueprint $table) {
            $table->dropColumn('negeri_id');
        });
    }
}
