<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sisdant\Models\KategoriIklan;
use Database\Seeders\Traits\TruncateTable;

class KategoriIklanSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     *
     */
    public function run()
    {
        $this->truncate('kategori_iklan');
        KategoriIklan::create([
            'nama' => "ePerolehan",
        ]);
        KategoriIklan::create([
            'nama' => "Portal JPS",
        ]);
    }
}
