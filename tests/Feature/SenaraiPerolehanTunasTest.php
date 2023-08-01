<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Sisdant\Models\IklanPerolehan;


class SenaraiPerolehanTunasTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * A feature to add new candidate.
	 *
	 * @test
     *
     * @return void
     */

     public function test_get_senarai_no_perolehan_status()
     {
        $jenisIklan = [
            [
                'id' => '1',
                'user_id' => '2',
                'mohon_no_perolehan_id' => '1',
                'tarikh_mula_jual' => '2022-02-12 00:00:00',
                'tarikh_akhir_jual' => '2022-02-12 00:00:00',
                'pejabat_pamer_jual' => 'Test',
                'tarikh_lawatan_tapak' => '2022-02-12 00:00:00',
                'waktu_lapor' => '2022-02-12',
                'tarikh_keluar_iklan' => '2022-02-12 00:00:00',
                'tarikh_waktu_tutup' => '2022-02-12 00:00:00',
                'status_iklan_id' => '2',
                'cara_bayaran_id' => '2',
                'grade_id' => '2',
                'bayar_kepada_id' => '1','updated_at' => '2022-02-14 01:35:51',
                'created_at' => '2022-02-14 01:35:51',
            ],
            [
                'id' => '2',
                'user_id' => '2',
                'mohon_no_perolehan_id' => '1',
                'tarikh_mula_jual' => '2022-02-12 00:00:00',
                'tarikh_akhir_jual' => '2022-02-12 00:00:00',
                'pejabat_pamer_jual' => 'Test',
                'tarikh_lawatan_tapak' => '2022-02-12 00:00:00',
                'waktu_lapor' => '2022-02-12',
                'tarikh_keluar_iklan' => '2022-02-12 00:00:00',
                'tarikh_waktu_tutup' => '2022-02-12 00:00:00',
                'status_iklan_id' => '3',
                'cara_bayaran_id' => '2',
                'grade_id' => '2',
                'bayar_kepada_id' => '1','updated_at' => '2022-02-14 01:35:51',
                'created_at' => '2022-02-14 01:35:51',
            ],
            [
                'id' => '3',
                'user_id' => '2',
                'mohon_no_perolehan_id' => '1',
                'tarikh_mula_jual' => '2022-02-12 00:00:00',
                'tarikh_akhir_jual' => '2022-02-12 00:00:00',
                'pejabat_pamer_jual' => 'Test',
                'tarikh_lawatan_tapak' => '2022-02-12 00:00:00',
                'waktu_lapor' => '2022-02-12',
                'tarikh_keluar_iklan' => '2022-02-12 00:00:00',
                'tarikh_waktu_tutup' => '2022-02-12 00:00:00',
                'status_iklan_id' => '5',
                'cara_bayaran_id' => '2',
                'grade_id' => '2',
                'bayar_kepada_id' => '1','updated_at' => '2022-02-14 01:35:51',
                'created_at' => '2022-02-14 01:35:51',
            ],
        ];
        foreach($jenisIklan as $JenisIklan){
            IklanPerolehan::create($JenisIklan);
        }

        $response = IklanPerolehan::whereIn('status_iklan_id', [2, 3, 5])
            ->first();
        $this->assertEquals($response->id, '1');
    }

}
