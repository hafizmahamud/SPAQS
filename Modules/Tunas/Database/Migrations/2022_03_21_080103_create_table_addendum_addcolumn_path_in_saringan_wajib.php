<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAddendumAddcolumnPathInSaringanWajib extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addendum', function (Blueprint $table) {
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

        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->string('cover_dokumen_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addendum');
        Schema::table('borang_daftar_minat', function (Blueprint $table) {
            $table->dropColumn('cover_dokumen_path');
        });
    }
}
