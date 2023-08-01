<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use App\Models\LanjutSahLaku;

class SuratLanjutSahLakuSeeder extends Seeder
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

        $this->truncate('surat_lanjut_sahlaku');

        LanjutSahLaku::create(
            [
                'rujukan' => 'dlm PPS (s) 4/2020',
                'alamat' => 'Ketua Setiausaha,
Kementerian Alam Sekitar Dan Air,
Aras 6, Blok F10,
Kompleks Parcel F,
Lebuh Perdana Timur, Presint 1,
Pusat Pentadbiran Kerajaan Persekutuan,
62000 Putrajaya.
                ',
                'up' => '(u/p : Setiausaha Bahagian Pentadbiran dan Kewangan)',
                'title' => 'Tuan,',
                'tajuk' => 'Permohonan Kelulusan Pelanjutan Tempoh Sah Laku Tender Kepada Pengerusi Lembaga Perolehan Kementerian Alam Sekitar Dan Air ',
                'text_1' => '2.	Merujuk kepada PK 2.1 perenggan 8 (v) (d) pelanjutan tempoh sah laku tender hendaklah dibuat   sebelum  tarikh  tempoh  sah  laku  asal  tamat dengan  kelulusan Pengerusi Lembaga Perolehan Agensi. Oleh itu, bersama-sama ini dikepilkan Lampiran A bagi tujuan perkara di atas untuk pertimbangan dan kelulusan YBhg. Dato’ Seri. ',
                'text_2' => '',
                'moto' => '“BERKHIDMAT UNTUK NEGARA”',
                'sym' => 'Saya yang menjalankan amanah, ',
                'nama' => '(DATO’ SERI Ir. Dr. ZAINI UJANG)',
                'jawatan' => 'KETUA SETIAUSAHA',
                'kementerian' => 'KEMENTERIAN ALAM SEKITAR DAN AIR',
            ]
        );
    }
}
