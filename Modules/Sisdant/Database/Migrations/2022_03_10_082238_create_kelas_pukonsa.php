<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasPukonsa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_pukonsa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tajuk')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('subkelas_pukonsa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tajuk_kecil')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('tajuk_id');
            $table->timestamps();
        });

        Schema::table('subkelas_pukonsa', function (Blueprint $table) {
            $table->foreign('tajuk_id')->references('id')->on('kelas_pukonsa')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('kelas_upkj', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tajuk')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('subkelas_upkj', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tajuk_kecil')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('tajuk_id');
            $table->timestamps();
        });

        Schema::table('subkelas_upkj', function (Blueprint $table) {
            $table->foreign('tajuk_id')->references('id')->on('kelas_upkj')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('iklan_kelaspukonsa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iklan_perolehan_id');
            $table->unsignedBigInteger('tajuk_id');
            $table->unsignedBigInteger('tajukkecil_id');
			$table->timestamps();

            $table->foreign('iklan_perolehan_id')
            ->references('id')
            ->on('iklan_perolehan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('tajuk_id')
            ->references('id')
            ->on('kelas_pukonsa')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('tajukkecil_id')
            ->references('id')
            ->on('subkelas_pukonsa')
            ->onUpdate('cascade')
            ->onDelete('cascade');

        });

        Schema::create('iklan_kelasupkj', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iklan_perolehan_id');
            $table->unsignedBigInteger('tajuk_id');
            $table->unsignedBigInteger('tajukkecil_id');
			$table->timestamps();

            $table->foreign('iklan_perolehan_id')
            ->references('id')
            ->on('iklan_perolehan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('tajuk_id')
            ->references('id')
            ->on('kelas_upkj')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('tajukkecil_id')
            ->references('id')
            ->on('subkelas_upkj')
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
        Schema::dropIfExists('iklan_kelaspukonsa');
        Schema::dropIfExists('iklan_kelasupkj');
        Schema::dropIfExists('subkelas_pukonsa');
        Schema::dropIfExists('subkelas_upkj');
        Schema::dropIfExists('kelas_pukonsa');
        Schema::dropIfExists('kelas_upkj');

    }
}
