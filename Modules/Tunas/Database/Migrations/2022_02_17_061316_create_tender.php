<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('iklan_perolehan_id');
            $table->string('dokumen', 255);
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('iklan_perolehan_id')
            ->references('id')
            ->on('iklan_perolehan')
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
        Schema::dropIfExists('tender');
    }
}
