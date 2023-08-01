<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYearInNoPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('running_no_perolehan', function (Blueprint $table) {
            $table->string('year')->nullable()->after('kategori_perolehan_id');
        });

        Schema::table('mohon_no_perolehan', function (Blueprint $table) {
            $table->integer('section_id')->nullable()->change();
        });

        Schema::table('draf_mohon_no_perolehan', function (Blueprint $table) {
            $table->integer('section_id')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('running_no_perolehan', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('mohon_no_perolehan', function (Blueprint $table) {
            $table->integer('section_id')->unsigned()->nullable(false)->change();
        });

        Schema::table('draf_mohon_no_perolehan', function (Blueprint $table) {
            $table->integer('section_id')->unsigned()->nullable(false)->change();
        });
    }
}
