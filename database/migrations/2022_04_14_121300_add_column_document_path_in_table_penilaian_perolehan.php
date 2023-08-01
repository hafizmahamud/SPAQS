<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDocumentPathInTablePenilaianPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_perolehan', function (Blueprint $table) {
            $table->string('memo_pelantikan_path')->nullable();
            $table->string('memo_pelantikan')->nullable();
            $table->string('borang_tindakan_path')->nullable();
            $table->string('borang_tindakan')->nullable();
            $table->string('surat_akuan_pelantikan_p1_path')->nullable();
            $table->string('surat_akuan_pelantikan_p1')->nullable();
            $table->string('surat_akuan_pelantikan_p2_path')->nullable();
            $table->string('surat_akuan_pelantikan_p2')->nullable();
            $table->string('surat_akuan_selesai_tugas_p1_path')->nullable();
            $table->string('surat_akuan_selesai_tugas_p1')->nullable();
            $table->string('surat_akuan_selesai_tugas_p2_path')->nullable();
            $table->string('surat_akuan_selesai_tugas_p2')->nullable();
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
            $table->dropColumn('memo_pelantikan_path');
            $table->dropColumn('memo_pelantikan');
            $table->dropColumn('borang_tindakan_path');
            $table->dropColumn('borang_tindakan');
            $table->dropColumn('surat_akuan_pelantikan_p1_path');
            $table->dropColumn('surat_akuan_pelantikan_p1');
            $table->dropColumn('surat_akuan_pelantikan_p2_path');
            $table->dropColumn('surat_akuan_pelantikan_p2');
            $table->dropColumn('surat_akuan_selesai_tugas_p1_path');
            $table->dropColumn('surat_akuan_selesai_tugas_p1');
            $table->dropColumn('surat_akuan_selesai_tugas_p2_path');
            $table->dropColumn('surat_akuan_selesai_tugas_p2');
        });
    }
}
