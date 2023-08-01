<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Awas\Models\DokumenSST;
use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Awas\Models\PenilaianPerolehan;

class DokumenSSTTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * A feature to add new candidate.
	 *
	 * @test
     *
     * @return void
     */

    public function test_create_dokumen_sst()
    {
        IklanPerolehan::create([
            'id' => '1',
            'user_id' => 3,
            'mohon_no_perolehan_id' => '1',
            'matrik_iklan_id' => 2,
            'tajuk' => 'TENDER JPS',
            'tarikh_mula_jual' => '2022-04-01',
            'tarikh_akhir_jual' => '2022-04-01',
            'pejabat_pamer_jual' => 'PEJABAT AMPANG',
            'tarikh_lawatan_tapak' => '2022-04-01',
            'lawatan_tapak' => 'PEJABAT AMPANG',
            'pejabat_lapor' => 'PEJABAT AMPANG',
            'waktu_lapor' => '2022-02-07 01:57:15',
            'harga_dokumen' => 'RM 5 JUTA',
            'lokasi_tapak' => 'AMPANG',
            'peti_tender' => '',
            'tarikh_keluar_iklan' => '2022-04-01',
            'tarikh_waktu_tutup' => '2022-04-10',
            'status_iklan_id' => 4,
            'jadual_harga_status' => 'DRAF',
            'cara_bayaran_id' => '1',
            'bayar_kepada_id' => '1',
            'grade_id' => '2',
        ]);

        PenilaianPerolehan::create([
            'id' => '1',
            'tarikh_laporan_tender' => '2022-04-10',
            'tarikh_mesy_lembaga' => '2022-04-10',
            'bil_mesy' => '1',
            'tarikh_result' => '2022-04-10',
            'tarikh_terima_result' => '2022-04-10',
            'tarikh_edar_result' => '2022-04-10',
            'nama_syarikat' => 'Syarikat A',
            'harga' => '3, 030.30',
            'tempoh' => '3 Bulan',
            'catatan' => 'Ada',
            'iklan_perolehan_id' => '1',
            'status_penilaian' => "syor_tamat",
            'user_id' => '3',
            'tempoh_sah_laku' => '90 hari',
            'tarikh_sah_laku' => '2022-04-10',
            'tarikh_serah_dokumen_penilaian' => '2022-04-10',
            'ketua_penilai' => '3',
            'pegawai_penilai_1' => '3',
            'pegawai_penilai_2' => '3',
            'penyedia' =>'3',
            'no_rujukan' => '(1) P.P.S (s) 15/2011 Jld. 1',
            'tempoh_sedia_lt' => '3 bulan',
        ]);

        DokumenSST::create([
            'penilaian_perolehan_id' => '1',
            'fail' => 'storage/sst/3/Contoh eplkk.pdf',
            'nama_fail' => 'Contoh eplkk.pdf',
        ]);

        $response = DokumenSST::where('id', '1')
            ->where('penilaian_perolehan_id','1')
            ->first();
        $this->assertEquals($response->id, '1');
    }

}
