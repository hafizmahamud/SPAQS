<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Tunas\Models\BorangDaftarMinat;


class SaringanWajibTest extends TestCase
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
            'iklan_perolehan_id'=> '1',
            'kehadiran_lawatan_tapak_id'=> '1',
            'nama_syarikat'=> 'syarikat ABC',
            'nama_pegawai'=> 'aina zuhairah',
            'telno_fax'=> '0102766277',
            'telno_fon'=> '0102766277',
            'alamat_syarikat'=> 'ukay perdana',
            'emel_rasmi'=> 'aina@plisca.com.my',
            'no_syarikat'=> 'abc123',
            'no_mof'=> '123',
            'tarikh_tamat_mof'=> '2020-01-01',
            'kod_sub_bidang_mof'=> '[1,2,3]',
            'doc_sijil_mof_path'=> '/path',
            'doc_sijil_mof_nama'=> 'example.pdf',
            'no_cidb'=> '123',
            'tarikh_tamat_cidb'=> '2020-01-01',
            'kelas_pengkhususan_cidb' => '[1,2,3]',
            'doc_sijil_cidb_path' => '/path' ,
            'doc_sijil_cidb_nama' => 'example.pdf',
            'doc_sijil_kebenaran_khas_path' => '/path' ,
            'doc_sijil_kebenaran_khas_nama' => 'example.pdf',
            'no_sijil_spkk'=> '123',
            'tarikh_tamat_spkk'=> '2020-01-01',
            'doc_sijil_spkk_path'=> '/path',
            'doc_sijil_spkk_nama' =>'example.pdf',
            'no_sijil_pukonsa'=> '123',
            'tarikh_tamat_pukonsa'=> '2020-01-01',
            'doc_sijil_pukonsa_path'=> '/path',
            'doc_sijil_pukonsa_nama'=> 'example.pdf',
            'no_sijil_upkj'=> '123',
            'tarikh_tamat_upkj'=> '2020-01-01',
            'doc_sijil_upkj_path' =>'/path',
            'doc_sijil_upkj_nama' =>'example.pdf',
            'tarikh_tamat_sij_bumiputera'=> '2020-01-01',
            'doc_sijil_sij_bumiputera_path' => '/path',
            'doc_sijil_sij_bumiputera_nama' => 'example.pdf',
            'status_petender' => "dalam proses" ,
            'no_siri' => '123',
            'no_sijil_sij_bumiputera' => "ABC123",
            'grade_id' => '2'
        ];
        BorangDaftarMinat::insert($dataCandidate1);
            $response = BorangDaftarMinat::where('id', '1')
                ->where('iklan_perolehan_id','1')
				->first();
			$this->assertEquals($response->id, '1');
    }

}
