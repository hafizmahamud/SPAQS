<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Negeri;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableForeignKeys;

class NegeriSeeder extends Seeder
{
    use TruncateTable;
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('negeri');

        Negeri::create(
            [
                'negeri' => 'JPS JOHOR',
                'singkatan' => 'JHR',
                'alamat' => 'Jabatan Pengairan Dan Saliran Negeri Johor,
Aras 3, Bangunan Dato’ Mohamad Ibrahim Munsyi,
Pusat Pentadbiran Kota Iskandar,
79626 Iskandar Puteri,
Johor Darul Takzim.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS KEDAH',
                'singkatan' => 'KDH',
                'alamat' => 'Jabatan Pengairan Dan Saliran Negeri Kedah,
Tingkat 7, Bangunan Sultan Abdul Halim,
Jalan Sultan Badlishah,
05000 Alor Setar,
Kedah.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS KELANTAN',
                'singkatan' => 'KEL',
                'alamat' => 'Jabatan Pengairan Dan Saliran Negeri Kelantan,
Jalan Sultan Yahya Petra,
15200 Kota Bharu,
Kelantan.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS MELAKA',
                'singkatan' => 'MEL',
                'alamat' => 'Jabatan Pengairan Dan Saliran Negeri Melaka,
Bandar MITC, Hang Tuah Jaya,
Aras 3, Wisma Negeri,
75450 Melaka.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS NEGERI SEMBILAN',
                'singkatan' => 'NEG',
                'alamat' => 'Jabatan Pengairan dan Saliran Negeri Sembilan,
Tingkat 2, Blok C, Wisma Negeri
70503 Seremban,
Negeri Sembilan.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS PAHANG',
                'singkatan' => 'PHG',
                'alamat' => 'Jabatan Pengairan Dan Saliran Negeri Pahang,
Tingkat 8, Kompleks Tun Razak (KOMTUR),
Bandar Indera Mahkota,
25626 Kuantan,
Pahang.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS PERAK',
                'singkatan' => 'PRK',
                'alamat' => 'Jabatan Pengairan Dan Saliran Negeri Perak,
Tingkat 4 & 5, Bangunan Seri Perak Darul Ridzuan,
Jalan Panglima Bukit Gantang Wahab,
30000 Ipoh,
Perak.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS PERLIS',
                'singkatan' => 'PER',
                'alamat' => 'Jabatan Pengairan Dan Saliran Negeri Perlis,
Kompleks JPS Perlis,
Jalan Pengkalan Asam,
01000 Kangar,
Perlis.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS PULAU PINANG',
                'singkatan' => 'PP',
                'alamat' => 'Jabatan Pengairan Dan Saliran Pulau Pinang,
Paras 55, Menara KOMTAR,
Jalan Penang Georgetown,
10000 Pulau Pinang.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS SABAH',
                'singkatan' => 'SBH',
                'alamat' => 'Jabatan Pengairan dan Saliran Negeri Sabah
Aras 5, Wisma Pertanian
Jalan Tasik Luyang Off Jalan Maktab Gaya Locked Bag 2052,
88767 Kota Kinabalu,
Sabah.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS SARAWAK',
                'singkatan' => 'SRK',
                'alamat' => 'Jabatan Pengairan Dan Saliran Negeri Sarawak,
Tingkat 9 & 10 Wisma Saberkas,
Jalan Tun Abang Haji Openg,
93150 Kuching,
Sarawak.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS SELANGOR',
                'singkatan' => 'SLG',
                'alamat' => 'Jabatan Pengairan Dan Saliran Negeri Selangor,
Tingkat 5, Bangunan Sultan Salahuddin Abdul Aziz Shah,
40626 Shah Alam,
Selangor Darul Ehsan.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS TERENGGANU',
                'singkatan' => 'TRG',
                'alamat' => 'Jabatan Pengairan Dan Saliran Negeri Terengganu,
Tingkat 6, Wisma Negeri,
20626 Kuala Terengganu,
Terengganu Darul Iman.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS WILAYAH PERSEKUTUAN KUALA LUMPUR',
                'singkatan' => 'WPKL',
                'alamat' => 'Jabatan Pengairan Dan Saliran Wilayah Persekutuan Kuala Lumpur,
Jalan Sultan Salahuddin,
50626 Kuala Lumpur.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS WILAYAH PERSEKUTUAN LABUAN',
                'singkatan' => 'WPLB',
                'alamat' => 'Jabatan Pengairan Dan Saliran Wilayah Persekutuan Labuan,
Kompleks Jabatan Pengairan Dan Saliran,
Peti Surat 81458 Jalan Rancha - Rancha,
87024 Wilayah Persekutuan Labuan.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'IBU PEJABAT JPS MALAYSIA',
                'singkatan' => 'IP',
                'alamat' => 'Ibu Pejabat Jabatan Pengairan Dan Saliran,
Jalan Sultan Salahuddin,
50626 Kuala Lumpur.',
            ]
        );

        Negeri::create(
            [
                'negeri' => 'JPS WILAYAH PERSEKUTUAN PUTRAJAYA',
                'singkatan' => 'WPPJ',
                'alamat' => 'Jabatan Pengairan Dan Saliran Wilayah Persekutuan Putrajaya,
Kementerian Air, Tanah Dan Sumber Asli,
Aras 10, Wisma Sumber Asli
No.25, Persiaran Perdana,
Presint 4
62574 Putrajaya.',
            ]
        );

        $this->enableForeignKeys();
    }
}
