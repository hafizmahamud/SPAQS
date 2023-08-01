<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Tunas\Models\Addendum;
use Modules\Sisdant\Models\IklanPerolehan;

class AddendumFileTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * A feature to add new candidate.
	 *
	 * @test
     *
     * @return void
     */

    public function test_create_addendum()
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

        Addendum::create([
            'id' => '1',
            'iklan_perolehan_id'=> '1',
            'dokumen'=> '/path',
            'status'=> '1',
            'path'=> 'dokumen baharu'
        ]);

        $response = Addendum::where('id', '1')
            ->where('iklan_perolehan_id','1')
            ->first();
        $this->assertEquals($response->id, '1');
    }

}
