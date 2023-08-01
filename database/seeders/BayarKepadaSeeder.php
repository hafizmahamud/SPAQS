<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Modules\Sisdant\Models\BayarKepada;

class BayarKepadaSeeder extends Seeder
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

        $this->truncate('bayar_kepada');

        BayarKepada::create(
            [
                'nama' => 'KETUA PENGARAH JPS MALAYSIA',
            ]
        );

        BayarKepada::create(
            [
                'nama' => 'JPS SABAH',
            ]
        );

        BayarKepada::create(
            [
                'nama' => 'JPS SARAWAK',
            ]
        );

        BayarKepada::create(
            [
                'nama' => 'N/A',
            ]
        );
    }
}
