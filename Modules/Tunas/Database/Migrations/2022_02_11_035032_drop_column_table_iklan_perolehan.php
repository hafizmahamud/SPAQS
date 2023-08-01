<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnTableIklanPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iklan_perolehan', function (Blueprint $table) {
            $table->dropColumn(['matrik_iklan_id', 'tajuk']);
            $table->unsignedBigInteger('mohon_no_perolehan_id')->nullable(false)->change();
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
            $table->unsignedBigInteger('matrik_iklan_id')->nullable()->after('mohon_no_perolehan_id');
            $table->string('tajuk')->nullable()->after('matrik_iklan_id');
        });
    }
}
