<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunningNoPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('running_no_perolehan', function (Blueprint $table) {
            $table->id();
            $table->integer('negeri_id');
            $table->integer('bahagian_id')->nullable();
            $table->unsignedBigInteger('jenis_iklan_id')->nullable();
            $table->unsignedBigInteger('kategori_perolehan_id')->nullable();
            $table->string('code')->nullable();
            $table->integer('running_no');
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
        Schema::dropIfExists('running_no_perolehan');
    }
}
