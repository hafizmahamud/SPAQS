<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Tunas\Models\TemplatBorangDaftar;


class IklanTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * A feature to add new candidate.
	 *
	 * @test
     *
     * @return void
     */

    public function test_create_templat_borang_daftar()
    {
        $dataCandidate1 = [
            'iklan_perolehan_id' => 2,
            'bahagian_1' => true,
            'bahagian_2' => true,
            'bahagian_3' => false,
            'bahagian_4' => false,
            'bahagian_5' => true,
            'bahagian_6' => true,
            'bahagian_7' => true,
        ];
        TemplatBorangDaftar::insert($dataCandidate1);
            $response = TemplatBorangDaftar::where('id', '1')
                ->where('iklan_perolehan_id','2')
				->first();
			$this->assertEquals($response->id, '1');
    }

}
