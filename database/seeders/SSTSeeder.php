<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\TemplatSST;

class SSTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        TemplatSST::create(
            [
                'id' => 1,
                'name' => 'Templat Dokumen SST',
                'path' => '/spaqs/assets/img/panduan/Templat Dokumen SST.docx'
            ]
        );
    }
}
