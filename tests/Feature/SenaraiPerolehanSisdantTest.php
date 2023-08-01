<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;


class SenaraiPerolehanSisdantTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * A feature to add new candidate.
	 *
	 * @test
     *
     * @return void
     */

     public function test_get_senarai_no_perolehan_status_sah()
     {
        $jenisIklan = [
            [
                'id_perolehan' => '1',
                'matrik_iklan_id' => '2',
                'tahun_perolehan' => '2021',
                'tajuk_perolehan' => '2',
                'tarikh_jangka_iklan'=> '2021-10-10',
                'dokumen_muatnaik'=> '/test.pdf',
                'user_id'=> '2',
                'status'=> 'belum sah',
                'section_id' => '2'
            ],
            [
                'id_perolehan' => '2',
                'matrik_iklan_id' => '2',
                'tahun_perolehan' => '2021',
                'tajuk_perolehan' => '2',
                'tarikh_jangka_iklan'=> '2021-10-10',
                'dokumen_muatnaik'=> '/test.pdf',
                'user_id'=> '2',
                'status'=> 'sah',
                'section_id' => '2'
            ],
        ];
        foreach($jenisIklan as $JenisIklan){
            PermohonanNomborPerolehan::create($JenisIklan);
        }

        $response = PermohonanNomborPerolehan::where('status', 'sah')
            ->first();
        $this->assertEquals($response->id_perolehan, '2');
    }

}
