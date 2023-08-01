<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\LantikanPenilai;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;

class LantikanPenilaiSeeder extends Seeder
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

        $this->truncate('memo_lantikan_penilai');

        LantikanPenilai::create(
            [
                'text_1' => 'Perkara di atas dan surat Perlantikan Jawatankuasa Penilaian Tender Perolehan Kerja daripada Ketua Pengarah JPS Malaysia bil (16) dlm. PPS 10/4/2 BUB Jld. 11 bertarikh 4 April 2018 adalah dirujuk.',
                'text_2' => '2. Dengan ini tuan/puan adalah dilantik sebagai Ahli Jawatankuasa Penilaian Tender untuk menilai tender dan menyediakan Cadangan Perakuan Tender bagi projek di atas dalam tempoh',
                'text_3' => 'bermula daripada tarikh penerimaan dokumen-dokumen tender ini pada ',
                'text_4' => '',
                'moto_1' => '"WAWASAN KEMAKMURAN BERSAMA 2030"
"BERKHIDMAT UNTUK NEGARA"',
                'sym' => 'Saya yang menjalankan amanah,',
            ]
        );
    }
}
