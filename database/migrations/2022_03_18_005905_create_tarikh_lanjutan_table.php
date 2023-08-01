<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarikhLanjutanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarikh_lanjutan', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->unsignedBigInteger('penilaian_perolehan_id');
                $table->timestamp('tarikh');
                $table->timestamps();
            
    
            $table->foreign('penilaian_perolehan_id')
            ->references('id')
            ->on('penilaian_perolehan')
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
        Schema::dropIfExists('tarikh_lanjutan');
    }
}
