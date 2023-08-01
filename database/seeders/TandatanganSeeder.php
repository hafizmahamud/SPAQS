<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tandatangan;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;

class TandatanganSeeder extends Seeder
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

        $this->truncate('tandatangan');

        Tandatangan::create(
            [
                'nama' => 'Sr RUAIDAH BINTI IDRIS',
                'jawatan' => 'Pengarah',
                'path_tandatangan' => '/spaqs/assets/img/logo/signature.png'
            ]
        );
    }
}
