<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSuratMemoKeputusanToTablePenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_perolehan', function (Blueprint $table) {
            $table->string('storage_memo_keputusan')->nullable();
            $table->string('nama_memo_keputusan')->nullable();
            $table->string('storage_surat_keputusan')->nullable();
            $table->string('nama_surat_keputusan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_perolehan', function (Blueprint $table) {
            $table->dropColumn('storage_memo_keputusan');
            $table->dropColumn('nama_memo_keputusan');
            $table->dropColumn('storage_surat_keputusan');
            $table->dropColumn('nama_surat_keputusan');
        });
    }
}
