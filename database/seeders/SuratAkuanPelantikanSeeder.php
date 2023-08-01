<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelantikan;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;

class SuratAkuanPelantikanSeeder extends Seeder
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

        $this->truncate('surat_akuan_pelantikan');

        Pelantikan::create(
            [
                'tajuk' => 'SURAT AKUAN PELANTIKAN AHLI JAWATANKUASA PENILAIAN TENDER',
                'text_1' => 'adalah dengan sesungguhnya dan sebenarnya mengisytiharkan bahawa:',
                'text_2' => 'i. Saya tidak akan melibatkan diri saya dalam mana-mana amalan rasuah dengan mana-mana pihak yang terlibat sama ada secara langsung atau tidak langsung dalam tender  ',
                'text_3' => 'ii. Saya tidak akan bersubahat atau dipengaruhi oleh mana-mana pihak sehingga boleh menjejaskan ketelusan dan keadilan semasa proses perolehan,',
                'text_4' => 'iii. Sekiranya ada sebarang percubaan rasuah daripada mana-mana pihak, saya akan membuat aduan dengan segera ke pejabat Suruhanjaya Pencegahan Rasuah Malaysia (SPRM) atau balai polis yang berhampiran. Saya sedar bahawa kegagalan saya berbuat demikian adalah satu kesalahan di bawah Akta Suruhanjaya Pencegahan Rasuah 2009 (Akta 64); ',
                'text_5' => 'iv. Saya tidak akan mendedahkan apa-apa maklumat sulit berkaitan perolehan Kerajaan kepada mana-mana pihak selaras dengan Akta Rahsia Rasmi 1972 (Akta 88).',
                'text_6' => 'v. Saya dengan ini mengisytiharkan bahawa tiada mana-mana anggota atau ahli keluarga terdekat yang mempunyai apa-apa kepentingan dalam mana-mana urusan perolehan yang dikendalikan oleh saya;',
                'text_7' => 'vi. Saya sesungguhnya faham bahawa jika saya disabitkan kerana telah melanggar mana-mana terma dalam  surat akuan ini, saya boleh dikenakan tindakan di bawah Peraturan – Peraturan Pegawai Awam (Kelakuan dan Tatatertib) 1993.',
                'text_8' => '',
            ]
        );
    }
}
