<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use App\Models\SuratEdarKeputusan;

class SuratEdaranKeputusanSeeder extends Seeder
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

        $this->truncate('surat_edar_keputusan');

        SuratEdarKeputusan::create(
            [
                'rujukan' => 'dlm PPS(s) 13/2008 Jld ',
                'alamat' => 'Pengarah
Jabatan Pengairan Dan Saliran Negeri Sabah,
Aras 5, Wisma Pertanian Jalan Tasik Luyang
Off Jalan Maktab Gaya Locked Bag 2052,
88767 Kota Kinabalu,
Sabah.
                ',
                'title' => 'Tuan',
                'kementerian' => 'KASA',
                'text_1' => '2.	Bersama-sama ini disertakan keputusan Mesyuarat Lembaga Perolehan Kementerian Alam Sekitar dan Air Bil.',
                'text_2' => 'bagi kertas perolehan:-',
                'text_3' => '',
                'moto' => '“WAWASAN KEMAKMURAN BERSAMA 2030”
“BERKHIDMAT UNTUK NEGARA”
                ',
                'sym' => 'Saya yang menjalankan amanah,',
            ]
        );
    }
}
