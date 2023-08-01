<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use App\Models\SelesaiTugas;

class SuratAkuanSelesaiTugasSeeder extends Seeder
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

        $this->truncate('surat_akuan_selesai_tugas');

        SelesaiTugas::create(
            [
                'tajuk' => 'SURAT AKUAN SELESAI TUGAS AHLI JAWATANKUASA PENILAIAN TENDER',
                'text_1' => 'dari  Bahagian Ukur Bahan dan Pengurusan Kontrak, JPS adalah sesungguhnya dan sebenarnya mengisytiharkan bahawa:',
                'text_2' => 'i. Saya telah melaksanakan tugas sebagai Ahli Jawatankuasa Penilaian Tender  :',
                'text_3' => 'tanpa mempunyai apa-apa kepentingan peribadi atau kepentingan terletak atau dipengaruhi oleh mana-mana pihak lain atau terlibat dalam apa-apa amalan rasuah atau ganjaran seperti ditafsirkan di bawah Akta Suruhanjaya Pencegahan Rasuah 2009 (Akta 694); ',
                'text_4' => 'ii. Tiada mana-mana ahli keluarga atau saudara terdekat saya mempunyai apa-apa kepentingan dalam mana-mana urusan perolehan yang dikendalikan oleh saya;',
                'text_5' => 'iii. Saya tidak akan mendedahkan apa-apa maklumat sulit berkaitan perolehan Kerajaan kepada mana-mana pihak selaras dengan Akta Rahsia Rasmi 1972 (Akta 88); dan',
                'text_6' => 'iv. Saya sesungguhnya faham bahawa jika saya disabitkan kerana telah melanggar mana-mana terma/klausa surat akuan ini, saya boleh dikenakan tindakan di bawah Peraturan – Peraturan Pegawai Awam (Kelakuan dan Tatatertib) 1993.',
                'text_7' => '',
            ]
        );
    }
}
