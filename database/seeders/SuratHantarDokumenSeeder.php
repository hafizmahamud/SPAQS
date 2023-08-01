<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use App\Models\HantarDokumen;

class SuratHantarDokumenSeeder extends Seeder
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

        $this->truncate('surat_hantar_dokumen');

        HantarDokumen::create(
            [
                'rujukan' => 'dlm PPS(s) 4/92 Jld.',
                'alamat' => 'Ketua Setiausaha,
Kementerian Alam Sekitar Dan Air,
Aras 6, Blok F11,
Kompleks Parcel F,
Lebuh Perdana Timur, Presint 1,
Pusat Pentadbiran Kerajaan Persekutuan,
62000 Putrajaya.
                ',
                'up' => '(u/p : Setiausaha Bahagian Kewangan dan Pembangunan)',
                'title' => "YBhg Datuk/ Dato'/ Tuan/ Puan,",
                'tajuk' => 'Kertas Perakuan Kepada Lembaga Perolehan Kementerian Alam Sekitar Dan Air',
                'text_1' => '2.	Bersama-sama ini dimajukan satu (1) naskah Asal dan',
                'text_2' => 'naskah salinan Kertas Perakuan untuk projek Jabatan Pengairan dan Saliran kepada Lembaga Perolehan KASA seperti dalam Lampiran A. ',
                'text_3' => '',
                'moto' => '“WAWASAN KEMAKMURAN BERSAMA 2030”
“BERKHIDMAT UNTUK NEGARA”
                ',
                'sym' => 'Saya yang menjalankan amanah,',
            ]
        );
    }
}
