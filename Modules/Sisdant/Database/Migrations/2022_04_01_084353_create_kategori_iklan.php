<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriIklan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_iklan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('mohon_no_perolehan', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_iklan_id')->nullable();
            $table->foreign('kategori_iklan_id')
            ->references('id')
            ->on('kategori_iklan')
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
        Schema::table('mohon_no_perolehan', function (Blueprint $table) {
            $table->dropColumn('kategori_iklan_id');
        });
        Schema::dropIfExists('kategori_iklan');
    }
}
