<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use App\Models\Negeri;
use App\Models\Pejabat;



class LaporanDaftarPerolehanTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * A feature to add new candidate.
	 *
	 * @test
     *
     * @return void
     */

     public function test_get_data_mohon_no_perolehan()
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
                'status'=> 'batal',
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
        $statusquery = ['sah','batal'];
        $response = PermohonanNomborPerolehan::wherein('status',$statusquery)->first();
        $this->assertEquals($response->id_perolehan, '1');
    }

    public function test_get_data_negeri()
    {
       $negeri = [
           [
               'id' => '1',
               'negeri' => 'JPS JOHOR',
               'singkatan' => 'JHR',
           ],
           [
               'id' => '2',
               'negeri' => 'JPS PERAK',
               'singkatan' => 'PRK',
           ],
       ];
       foreach($negeri as $senaraiNegeri){
           Negeri::create($senaraiNegeri);
       }
       $response = Negeri::where('id', '1')->first();
       $this->assertEquals($response->id, '1');
   }

   public function test_get_data_bahagian()
   {
      $bahagian = [
          [
              'id' => '1',
              'bahagian' => 'BANGUNAN DAN INFRASTRUKTUR',
              'singkatan' => 'BBI',
              'negeri_id' => '16',

          ],
          [
            'id' => '2',
            'bahagian' => 'KHIDMAT PENGURUSAN',
            'singkatan' => 'BKP',
            'negeri_id' => '16',
          ],
      ];
      foreach($bahagian as $senaraiBahagian){
          Pejabat::create($senaraiBahagian);
      }
      $response = Pejabat::where('id', '1')->first();
      $this->assertEquals($response->id, '1');
  }

}
