<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\HeaderSurat;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;

class HeaderSuratSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->disableForeignKeys();

        $this->truncate('header_surat');

        HeaderSurat::create(
            [
                'jabatan' => 'JABATAN PENGAIRAN DAN SALIRAN, MALAYSIA (Department of Irrigation and Drainage, Malaysia)',
                'kementerian' => 'KEMENTERIAN ALAM SEKITAR DAN AIR (Ministry of Environment and Water)',
                'alamat' => 'JALAN SULTAN SALAHUDDIN, 50626 KUALA LUMPUR, MALAYSIA',
                'laman_web' => 'http://www.water.gov.my',
                'no_tel' => '+60 3 2616 1500',
                'no_fax' => '+60 3 2697 2411, 2585, 2412',
                'email' => 'pro@water.gov.my',
                'path_jata_negara' => '/spaqs/assets/img/logo/jata.png',
                'path_img_memo' => '/spaqs/assets/img/logo/memo.png'
            ]
            );
    }
}
