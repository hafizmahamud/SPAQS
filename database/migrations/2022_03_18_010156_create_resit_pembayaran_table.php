<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResitPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resit_pembayaran', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('iklan_perolehan_id');
                $table->string('resit_pembayaran')->nullable();
                $table->timestamps();
            
    
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
        Schema::dropIfExists('resit_pembayaran');
    }
}
