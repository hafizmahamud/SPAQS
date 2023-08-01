<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Awas\Models\PenilaianPerolehan;
use Modules\Awas\Models\DrafPenilaianPerolehan;


class LantikanPenilaiTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * A feature to add new candidate.
	 *
	 * @test
     *
     * @return void
     */

     public function test_create_lantikan_penilaian()
     {
        $dataPenilaian = [
            'iklan_perolehan_id' => '1',
            'tempoh_sah_laku' => '15',
            'tarikh_sah_laku' => '2022-01-30',
            'tarikh_lantik_penilai' => '2022-01-20',
            'user_id' => '1',
            'tarikh_laporan_tender' => '2022-01-30',
            'tarikh_serah_dokumen_penilaian' => '2022-02-14',
            'ketua_penilai' => '2',
            'pegawai_penilai_1' => '3',
            'pegawai_penilai_2' => '4',
            'penyedia' => '5',
        ];
        PenilaianPerolehan::insert($dataPenilaian);
            $response = PenilaianPerolehan::where('iklan_perolehan_id', '1')
				->first();
			$this->assertEquals($response->iklan_perolehan_id, '1');
    }

    public function test_create_lantikan_penilaian_draf()
     {
        $dataPenilaian = [
            'iklan_perolehan_id' => '2',
            'tempoh_sah_laku' => '20',
            'tarikh_sah_laku' => '2022-02-02',
            'tarikh_lantik_penilai' => '2022-01-30',
            'user_id' => '1',
            'tarikh_laporan_tender' => '2022-02-02',
            'tarikh_serah_dokumen_penilaian' => '2022-02-22',
            'ketua_penilai' => '2',
            'pegawai_penilai_1' => '3',
            'pegawai_penilai_2' => '4',
            'penyedia' => '5',
        ];
        DrafPenilaianPerolehan::insert($dataPenilaian);
            $response = DrafPenilaianPerolehan::where('iklan_perolehan_id', '2')
				->first();
			$this->assertEquals($response->iklan_perolehan_id, '2');
    }


   

    public function test_update_lantikan_penilaian_draf()
    {
        $this->test_create_lantikan_penilaian_draf();
        $dataPenilaian = [
            'tempoh_sah_laku' => '24',
            'tarikh_serah_dokumen_penilaian' => '2022-02-26',
        ];
        DrafPenilaianPerolehan::where('iklan_perolehan_id', 2)->update($dataPenilaian);
        $response = DrafPenilaianPerolehan::where('iklan_perolehan_id', '2')
            ->first();
        $this->assertEquals($response->iklan_perolehan_id, '2');
    }

}
