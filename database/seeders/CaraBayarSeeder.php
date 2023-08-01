<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Modules\Sisdant\Models\CaraBayar;

class CaraBayarSeeder extends Seeder
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

        $this->truncate('cara_bayar');

        CaraBayar::create(
            [
                'nama' => 'TANPA BAYARAN',
            ]
        );

        CaraBayar::create(
            [
                'nama' => 'WANG POS / KIRIMAN POS / DERAF BANK',
            ]
        );

        CaraBayar::create(
            [
                'nama' => 'ATAS TALIAN(ONLINE)',
            ]
        );

        CaraBayar::create(
            [
                'nama' => 'TUNAI',
            ]
        );

        CaraBayar::create(
            [
                'nama' => 'N/A',
            ]
        );
    }
}
