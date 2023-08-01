<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\StatusIklan;
use Database\Seeders\Traits\TruncateTable;
use Modules\Tunas\Models\BorangDaftarMinat;
use Modules\Awas\Models\PenilaianPerolehan;
use Modules\Awas\Models\Pengesyoran;

class StatusIklanPerolehanSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Model::unguard();
        $this->truncate('status_iklan');

        $statusIklan = [
            ['id' => 1, 'status' => 'DERAF BAHARU'],
            ['id' => 2, 'status' => 'BAHARU'],
            ['id' => 3, 'status' => 'DERAF'],
            ['id' => 4, 'status' => 'IKLAN'],
            ['id' => 5, 'status' => 'TUTUP'],
            ['id' => 6, 'status' => 'BATAL'],
            ['id' => 7, 'status' => 'ePerolehan'],
        ];
        foreach($statusIklan as $StatusIklan){
            StatusIklan::create($StatusIklan);
        }


    }
}
