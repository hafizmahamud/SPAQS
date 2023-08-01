<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Awas\Models\PenilaianPerolehan;


class KeputusanTest extends TestCase
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

    public function test_update_keputusan()
    {
        $this->test_create_lantikan_penilaian();
        $dataPenilaian = [
            'tarikh_laporan_tender' =>  '2022-01-20',
                'tarikh_mesy_lembaga' =>  '2022-01-20',
                'bil_mesy' =>  '2022/01',
                'tarikh_result' =>  '2022-01-20',
                'tarikh_terima_result' =>  '2022-01-20',
                'tarikh_edar_result' =>  '2022-01-20',
                'nama_syarikat' =>  'PLISCA (M) SDN BHD',
                'harga' =>  '20 000.00',
                'tempoh' =>  '12 BULAN',
                'catatan' =>  'CATATAN',
                'status_penilaian' => "syor_tamat",
        ];
        PenilaianPerolehan::where('iklan_perolehan_id', 1)->update($dataPenilaian);
        $response = PenilaianPerolehan::where('iklan_perolehan_id', '1')
            ->first();
        $this->assertEquals($response->iklan_perolehan_id, '1');
    }

}
