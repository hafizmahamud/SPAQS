<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\SenaraiAlamat;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;

class SenaraiAlamatSeeder extends Seeder
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

        $this->truncate('senarai_alamat');

        SenaraiAlamat::create(
            [
                'jenis_alamat' => 'IBU PEJABAT',
                'alamat' => 'UNIT TENDER, ARAS BAWAH, JABATAN PENGAIRAN DAN SALIRAN MALAYSIA, JALAN SULTAN SALAHUDDIN, 50626 KUALA LUMPUR',
            ]
        );

        SenaraiAlamat::create(
            [
                'jenis_alamat' => 'ALAMAT TENDER',
                'alamat' => 'PETI TENDER, ARAS BAWAH, JABATAN PENGAIRAN DAN SALIRAN MALAYSIA, JALAN SULTAN SALAHUDDIN, 50626 KUALA LUMPUR',
            ]
        );
    }
}
