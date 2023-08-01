<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Awas\Models\PenilaianPerolehan;


class SenaraiTenderHantarSuratLanjutanTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * A feature to add new candidate.
	 *
	 * @test
     *
     * @return void
     */

     public function test_get_senenarai_hantar_surat_lanjutan()
     {
        $senaraiHantar = [
            [
                'id' => '1',
                'iklan_perolehan_id' => '1',
                'tempoh_sah_laku' => '20',
                'tarikh_sah_laku' => '2022-02-05 00:00:00',
                'user_id' => '3',
                'tarikh_laporan_tender' => '2022-02-05 00:00:00',
                'status_penilaian' => '1',
                'tarikh_serah_dokumen_penilaian' => '2022-02-08 00:00:00',
                'ketua_penilai'=> '1',
                'pegawai_penilai_1'=> '5',
                'pegawai_penilai_2'=> '7',
                'penyedia' => '4',
                'no_rujukan' => '(19) P.P.S (s) 15/2011 Jld. 3',
                'tempoh_sedia_lt' => '27',
                'updated_at' => '2022-02-10 08:35:00',
                'created_at' => '2022-02-10 08:35:00',
            ],
            [
                'id' => '2',
                'iklan_perolehan_id' => '2',
                'tempoh_sah_laku' => '18',
                'tarikh_sah_laku' => '2022-01-25 00:00:00',
                'user_id' => '8',
                'tarikh_laporan_tender' => '2022-01-28 00:00:00',
                'status_penilaian' => '0',
                'tarikh_serah_dokumen_penilaian' => '2022-02-02 00:00:00',
                'ketua_penilai'=> '1',
                'pegawai_penilai_1'=> '5',
                'pegawai_penilai_2'=> '7',
                'penyedia' => '4',
                'no_rujukan' => '(25) P.P.S (s) 15/2011 Jld. 10',
                'tempoh_sedia_lt' => '22',
                'updated_at' => '2022-02-01 08:29:00',
                'created_at' => '2022-02-01 08:29:00',
            ],
            [
                'id' => '3',
                'iklan_perolehan_id' => '3',
                'tempoh_sah_laku' => '21',
                'tarikh_sah_laku' => '2022-03-03 00:00:00',
                'user_id' => '9',
                'tarikh_laporan_tender' => '2022-03-08 00:00:00',
                'status_penilaian' => '0',
                'tarikh_serah_dokumen_penilaian' => '2022-03-15 00:00:00',
                'ketua_penilai'=> '1',
                'pegawai_penilai_1'=> '5',
                'pegawai_penilai_2'=> '7',
                'penyedia' => '4',
                'no_rujukan' => '(10) P.P.S (s) 15/2011 Jld. 9',
                'tempoh_sedia_lt' => '23',
                'updated_at' => '2022-03-09 08:40:21',
                'created_at' => '2022-03-09 08:40:21',
            ],
        ];
        foreach($senaraiHantar as $sh){
            PenilaianPerolehan::create($sh);
        }

        $response = PenilaianPerolehan::where('status_penilaian', 1)->first();
        $this->assertEquals($response->id, '1');
    }

}
