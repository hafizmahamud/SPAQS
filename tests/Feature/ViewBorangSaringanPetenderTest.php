<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Tunas\Models\BorangDaftarMinat;

class ViewBorangSaringanPetenderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Create senarai petender.
     *
     * @return void
     */
    public function test_create_senarai_petender()
    {
        $senPetender = [
            [
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
                'no_mof' => 'MOF2022',
                'tarikh_tamat_mof' => '2022-12-21 00:00:00',
                'kod_sub_bidang_mof' => '["12","13"]',
                'status_petender' => 'dalam proses',
            ],
            [
                'id' => '2',
                'iklan_perolehan_id' => '1',
                'kehadiran_lawatan_tapak_id' => '1',
                'nama_syarikat' => 'Plisca (M) Sdn Bhd',
                'no_syarikat' => 'PLISCA2022',
                'nama_pegawai' => 'AHMAD BIN ALI',
                'telno_fax' => '052787878',
                'telno_fon' => '052787878',
                'alamat_syarikat' => 'Ampang, Selangor',
                'emel_rasmi' => 'ahmad@plisca.com.my',
                'no_mof' => 'MOF2022',
                'tarikh_tamat_mof' => '2022-12-21 00:00:00',
                'kod_sub_bidang_mof' => '["12","13"]',
                'status_petender' => 'gagal',
            ]
        ];
        foreach($senPetender as $senaraiPetender){
            BorangDaftarMinat::create($senaraiPetender);
        }
        $response = BorangDaftarMinat::where('id', '1')
        ->first();
			$this->assertEquals($response->id, '1');

    }

    /**
     * Get list of senarai petender.
     *
     * @return void
     */
    public function test_get_senarai_petender()
    {
        $this->test_create_senarai_petender();

        $this->assertDatabaseCount('borang_daftar_minat', 2);
    }

    /**
     * View detail senarai petender.
     *
     * @return void
     */
    public function test_get_senarai_petender_status_dalam_proses()
    {
        $this->test_create_senarai_petender();

        $response = BorangDaftarMinat::where('status_petender', 'dalam proses')
            ->first();
        $this->assertEquals($response->id, '1');
    }

    /**
     * Update status_petender.
     *
     * @return void
     */
    public function test_update_status_petender()
    {
        $this->test_create_senarai_petender();

        $response = BorangDaftarMinat::where('id', '1')
            ->update(['status_petender' => 'berjaya']);
        $response = BorangDaftarMinat::where('status_petender', 'berjaya')->first();
        $this->assertEquals($response->id, '1');
    }
}
