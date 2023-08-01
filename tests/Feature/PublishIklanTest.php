<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Sisdant\Models\IklanPerolehan;

class PublishIklanTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * A feature to add new candidate.
	 *
	 * @test
     *
     * @return void
     */

    public function test_publish_iklan()
    {
        $data = [
            'id' => '1',
            'user_id' => '2',
            'mohon_no_perolehan_id' => '1',
            'tarikh_mula_jual' => '2022-02-15',
            'tarikh_akhir_jual' => '2022-02-28',
            'pejabat_pamer_jual' => '1',
            'tarikh_lawatan_tapak' => '2022-02-15',
            'lawatan_tapak' => 'wajib',
            'pejabat_lapor' => '1',
            'waktu_lapor' => '11:30',
            'harga_dokumen' => '1452.00',
            'cara_bayaran_id' => '2',
            'bayar_kepada_id' => '1',
            'grade_id' => '2',
            'lokasi_tapak' => 'KUALA LUMPUR',
            'tarikh_keluar_iklan' => '2022-02-12',
            'tarikh_waktu_tutup' => '2022-02-12',
            'status_iklan_id' => 2,
            'peti_tender' => '1',
        ];
        IklanPerolehan::insert($data);
        $response = IklanPerolehan::where('id', '1')
                ->where('user_id','2')
				->first();
        $this->assertEquals($response->id, '1');
    }

    public function test_simpan_iklan()
    {
        $data = [
            'id' => '1',
            'user_id' => '2',
            'mohon_no_perolehan_id' => '1',
            'tarikh_mula_jual' => '2022-02-15',
            'tarikh_akhir_jual' => '2022-02-28',
            'pejabat_pamer_jual' => '1',
            'tarikh_lawatan_tapak' => '2022-02-15',
            'lawatan_tapak' => 'wajib',
            'pejabat_lapor' => '1',
            'waktu_lapor' => '11:30',
            'harga_dokumen' => '1452.00',
            'cara_bayaran_id' => '2',
            'bayar_kepada_id' => '1',
            'grade_id' => '2',
            'lokasi_tapak' => 'KUALA LUMPUR',
            'tarikh_keluar_iklan' => '2022-02-12',
            'tarikh_waktu_tutup' => '2022-02-12',
            'status_iklan_id' => 2,
            'peti_tender' => '1',
        ];
        IklanPerolehan::insert($data);
        $response = IklanPerolehan::where('id', '1')
                ->where('user_id','2')
				->first();
        $this->assertEquals($response->id, '1');
    }

}
