<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Tunas\Models\BorangDaftarMinat;

class UploadResitBayaranTest extends TestCase
{
    /**
     * Create rekod petender yang berjaya.
     *
     * @return void
     */
    public function test_create_rekod_petender_berjaya()
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
            'status_resit' => '',
            'status_petender' => 'berjaya',
        ];
        BorangDaftarMinat::insert($petender);
            $response = BorangDaftarMinat::where('id', '1')
                ->where('status_petender','berjaya')
				->first();
			$this->assertEquals($response->id, '1');
    }

    /**
     * upload resit bayaran.
     *
     * @return void
     */
    public function test_upload_resit_bayaran()
    {
        $this->test_create_rekod_petender_berjaya();

        $response = BorangDaftarMinat::where('id', '1')
            ->update([
                'resit_path' => 'public/resit_bayaran/JPS/IP/SH/BKP/01/2022/resit_bayaran.pdf',
                'resit' => 'resit_bayaran.pdf',
                'status_resit' => 'baru',
        ]);
        $response = BorangDaftarMinat::where('status_resit', 'baru')->first();
        $this->assertEquals($response->id, '1');
    }

    /**
     * upload semula resit bayaran.
     *
     * @return void
     */
    public function test_reupload_resit_bayaran()
    {
        $this->test_upload_resit_bayaran();

        $response = BorangDaftarMinat::where('id', '1')
            ->update([
                'resit_path' => 'public/resit_bayaran/JPS/IP/SH/BKP/01/2022/resit_bayaran_latest.pdf',
                'resit' => 'resit_bayaran_latest.pdf',
                'status_resit' => 'baru',
        ]);
        $response = BorangDaftarMinat::where('status_resit', 'baru')->first();
        $this->assertEquals($response->id, '1');
    }
}
