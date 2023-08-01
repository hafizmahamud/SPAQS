<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDokumenKpToTablePenilaianPerolehan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_perolehan', function (Blueprint $table) {
            $table->string('surat_akuan_pelantikan_kp_path')->nullable();
            $table->string('surat_akuan_pelantikan_kp')->nullable();
            $table->string('surat_akuan_selesai_tugas_kp_path')->nullable();
            $table->string('surat_akuan_selesai_tugas_kp')->nullable();
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
            $table->dropColumn('surat_akuan_pelantikan_kp_path');
            $table->dropColumn('surat_akuan_pelantikan_kp');
            $table->dropColumn('surat_akuan_selesai_tugas_kp_path');
            $table->dropColumn('surat_akuan_selesai_tugas_kp');
        });
    }
}
