<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNegeriInTablePermohonan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mohon_no_perolehan', function (Blueprint $table) {
            $table->integer('negeri_id')->nullable()->after('section_id');
            $table->string('nama_dokumen')->nullable()->after('dokumen_muatnaik');
        });

        Schema::table('draf_mohon_no_perolehan', function (Blueprint $table) {
            $table->integer('negeri_id')->nullable()->after('section_id');
            $table->string('nama_dokumen')->nullable()->after('dokumen_muatnaik');
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
            $table->dropColumn('negeri_id');
            $table->dropColumn('nama_dokumen');
        });

        Schema::table('draf_mohon_no_perolehan', function (Blueprint $table) {
            $table->dropColumn('negeri_id');
            $table->dropColumn('nama_dokumen');
        });
    }
}
