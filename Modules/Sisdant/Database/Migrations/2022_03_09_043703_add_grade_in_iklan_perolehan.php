<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGradeInIklanPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iklan_perolehan', function (Blueprint $table) {
            $table->unsignedBigInteger('grade_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iklan_perolehan', function (Blueprint $table) {
            $table->dropColumn('grade_id');

        });
    }
}
