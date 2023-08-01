<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Tunas\Models\BorangDaftarMinat;

class VerifyResitTest extends TestCase
{
    /**
     * Create rekod resit berjaya
     *
     * @return void
     */
    public function test_verify_resit_berjaya()
    {
        $petender = [
            'id' => '1',
            'iklan_perolehan_id' => '1',
            'kehadiran_lawatan_tapak_id' => '1',
            'nama_syarikat' => 'PNA',
            'no_syarikat' => 'PNA2022',
            'nama_pegawai' => 'AINON BIN ALI',
            'telno_fax' => '052787878',
            'telno_fon' => '052787878',
            'alamat_syarikat' => 'Ampang, Selangor',
            'emel_rasmi' => 'ainon@plisca.com.my',
            'resit_path' => '',
            'resit' => '',
            'status_resit' => 'sah',
            'status_petender' => 'berjaya',
        ];
        BorangDaftarMinat::insert($petender);
            $response = BorangDaftarMinat::where('id', '1')
                ->where('status_resit','sah')
				->first();
			$this->assertEquals($response->id, '1');
    }

    /**
     * Create rekod resit gagal.
     *
     * @return void
     */
    public function test_verify_resit_gagal()
    {
        $petender = [
            'id' => '2',
            'iklan_perolehan_id' => '1',
            'kehadiran_lawatan_tapak_id' => '1',
            'nama_syarikat' => 'PNA',
            'no_syarikat' => 'PNA2022',
            'nama_pegawai' => 'AINON BIN ALI',
            'telno_fax' => '052787878',
            'telno_fon' => '052787878',
            'alamat_syarikat' => 'Ampang, Selangor',
            'emel_rasmi' => 'ainon@plisca.com.my',
            'resit_path' => '',
            'resit' => '',
            'status_resit' => 'gagal',
            'status_petender' => 'berjaya',
        ];
        BorangDaftarMinat::insert($petender);
            $response = BorangDaftarMinat::where('id', '2')
                ->where('status_resit','gagal')
				->first();
			$this->assertEquals($response->id, '2');
    }

}