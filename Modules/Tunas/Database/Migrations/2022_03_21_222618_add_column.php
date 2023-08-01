<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addendum', function (Blueprint $table) {
            $table->string('path')->nullable();
        });

        Schema::table('tender', function (Blueprint $table) {
            $table->string('nama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addendum', function (Blueprint $table) {
            $table->dropColumn('path');
        });

        Schema::table('tender', function (Blueprint $table) {
            $table->dropColumn('nama');
        });
    }
}
