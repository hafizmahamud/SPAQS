<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Sisdant\Models\PermohonanNomborPerolehanDraf;


class PermohonanTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * A feature to add new candidate.
	 *
	 * @test
     *
     * @return void
     */

     public function test_create_permohonan_no_perolehan()
     {
        $dataCandidate = [
            'id_perolehan' => '1',
            'matrik_iklan_id' => '2',
            'tahun_perolehan' => '2021',
            'tajuk_perolehan' => '2',
            'tarikh_jangka_iklan'=> '2021-10-10',
            'dokumen_muatnaik'=> '/test.pdf',
            'user_id'=> '2',
            'status'=> 'belum sah',
            'section_id' => '2'
        ];
        PermohonanNomborPerolehan::insert($dataCandidate);
            $response = PermohonanNomborPerolehan::where('id_perolehan', '1')
                ->where('user_id','2')
				->first();
			$this->assertEquals($response->id_perolehan, '1');
    }

    public function test_delete_permohonan_no_perolehan()
    {
        $this->test_create_permohonan_no_perolehan();
        PermohonanNomborPerolehan::where('id_perolehan', 1)->delete();

    }

    public function test_create_permohonan_no_perolehan_draf()
     {
        $dataCandidate = [
            'id_perolehan' => '2',
            'matrik_iklan_id' => '2',
            'tahun_perolehan' => '2021',
            'tajuk_perolehan' => '2',
            'tarikh_jangka_iklan'=> '2021-10-10',
            'dokumen_muatnaik'=> '/test.pdf',
            'user_id'=> '2',
            'status'=> 'belum sah',
            'section_id' => '2'
        ];
        PermohonanNomborPerolehanDraf::insert($dataCandidate);
            $response = PermohonanNomborPerolehanDraf::where('id_perolehan', '2')
                ->where('user_id','2')
				->first();
			$this->assertEquals($response->id_perolehan, '2');
    }

    public function test_delete_permohonan_no_perolehan_draf()
    {
        $this->test_create_permohonan_no_perolehan_draf();
        PermohonanNomborPerolehanDraf::where('id_perolehan', 2)->delete();

    }

    public function test_update_permohonan_no_perolehan_draf()
    {
        $this->test_create_permohonan_no_perolehan_draf();
        $dataCandidate = [
            'matrik_iklan_id' => '5',
            'tahun_perolehan' => '2022'
        ];
        PermohonanNomborPerolehanDraf::where('id_perolehan', 2)->update($dataCandidate);
        $response = PermohonanNomborPerolehanDraf::where('id_perolehan', '2')
            ->where('user_id','2')
            ->first();
        $this->assertEquals($response->id_perolehan, '2');
    }

    public function test_sah_permohonan_no_perolehan()
    {
        $this->test_create_permohonan_no_perolehan();
        $dataCandidate = [
            'status' => 'sah',
            'no_perolehan' => 'JPS/IP/SH/1'
        ];
        PermohonanNomborPerolehan::where('id_perolehan', 1)->update($dataCandidate);
        $response = PermohonanNomborPerolehan::where('id_perolehan', '1')
            ->where('user_id','2')
            ->first();
        $this->assertEquals($response->id_perolehan, '1');
    }

    public function test_batal_permohonan_no_perolehan()
    {
        $this->test_create_permohonan_no_perolehan();
        $dataCandidate = [
            'status' => 'batal',
            'justifikasi_batal' => 'batal',
            'dokumen_batal' => '/dokumen.pdf'
        ];
        PermohonanNomborPerolehan::where('id_perolehan', 1)->update($dataCandidate);
        $response = PermohonanNomborPerolehan::where('id_perolehan', '1')
            ->where('user_id','2')
            ->first();
        $this->assertEquals($response->id_perolehan, '1');
    }

}
