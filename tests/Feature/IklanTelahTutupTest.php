<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;

class IklanTelahTutupTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_iklan_perolehan()
    {

        PermohonanNomborPerolehan::create([
            'id' => '5',
            'matrik_iklan_id' => 1,
            'tahun_perolehan' => 2022,
            'tajuk_perolehan' => 'PERANCANGAN MONOREL SERI KEMBANGAN , SELANGOR',
            'tarikh_jangka_iklan' => '2022-05-01',
            'user_id' => 3,
            'section_id' => 2,
            'negeri_id' => 1,
            'no_perolehan' => 'JPS(SH/IP/SG/01/2022)',
            'status' => 'BUKA',
        ]);

        IklanPerolehan::create([
            'id' => '5',
            'user_id' => 3,
            'mohon_no_perolehan_id' => '5',
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
            'grade_id' => '2',
            'bayar_kepada_id' => '1',
        ]);


        $response = IklanPerolehan::where('id', '5')
                ->first();
        $this->assertEquals($response->id, '5');
    }
}
