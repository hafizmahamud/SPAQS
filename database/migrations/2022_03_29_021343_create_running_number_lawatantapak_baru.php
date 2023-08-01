<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunningNumberLawatantapakbaru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('running_number_lawatantapak');
        Schema::create('running_number_lawatantapak', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('running_number');
            $table->integer('iklan_perolehan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('running_number_lawatantapak');
        Schema::create('running_number_lawatantapak', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('running_number');
            $table->integer('iklan_perolehan_id');
            $table->timestamps();
        });
    }
}
