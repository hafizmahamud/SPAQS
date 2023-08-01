<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\MemoEdarKeputusan;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;

class MemoEdarKeputusanSeeder extends Seeder
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

        $this->truncate('memo_edar_keputusan');

        MemoEdarKeputusan::create(
            [
                'rujukan' => 'PPS(s) 13/2008 Jld ',
                'perkara' => 'KEPUTUSAN LEMBAGA PEROLEHAN KASA ',
                'kementerian' => 'Kementerian Alam Sekitar dan Air ',
                'kementerian1' => 'KASA',
                'text_1' => '4.	Dimohon juga wakil Bahagian mengambil semula baki kertas pertimbangan yang telah diputuskan oleh Lembaga Perolehan KASA. Pihak Urusetia Lembaga Perolehan KASA hanya akan menyimpan satu (1) salinan untuk rekod di KASA.',
                'title' => 'Tuan/Puan ',
                'text_3' => '',
                'moto' => '“WAWASAN KEMAKMURAN BERSAMA 2030”
“BERKHIDMAT UNTUK NEGARA”
                ',
                'sym' => 'Saya yang menjalankan amanah,',
            ]
        );
    }
}
