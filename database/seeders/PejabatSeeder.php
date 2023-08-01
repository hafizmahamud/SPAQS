<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pejabat;

class PejabatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Pejabat::create(
            [
                'bahagian' => 'BANGUNAN DAN INFRASTRUKTUR',
                'singkatan' => 'BBI',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'KHIDMAT PENGURUSAN',
                'singkatan' => 'BKP',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'KORPORAT',
                'singkatan' => 'BKOR',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'PEMBANGUNAN MODAL INSAN',
                'singkatan' => 'BPMI',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'PENGURUSAN BANJIR',
                'singkatan' => 'BPB',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'PENGURUSAN MAKLUMAT',
                'singkatan' => 'BPM',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'PENGURUSAN SUMBER AIR DAN HIDROLOGI',
                'singkatan' => 'BSH',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'PUSAT RAMALAN & AMARAN BANJIR NEGARA',
                'singkatan' => 'PRAB',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'PROJEK KHAS',
                'singkatan' => 'BPK',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'REKABENTUK DAN EMPANGAN',
                'singkatan' => 'BRE',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'SALIRAN MESRA ALAM',
                'singkatan' => 'BSMA',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'UKUR BAHAN DAN PENGURUSAN KONTRAK',
                'singkatan' => 'BUB',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'HTC KL',
                'singkatan' => 'HTC',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'PENGURUSAN ZON PANTAI',
                'singkatan' => 'PT',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'PENGURUSAN LEMBANGAN SUNGAI',
                'singkatan' => 'SG',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'PENGURUSAN FASILITI DAN GIS',
                'singkatan' => 'FGIS',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'PERKHIDMATAN MEKANIKAL DAN ELEKTRIKAL KUALA LUMPUR',
                'singkatan' => 'BPME',
                'negeri_id' => 16,
            ]
        );

        Pejabat::create(
            [
                'bahagian' => 'IPMI ZON TENGAH',
                'singkatan' => 'IPMI',
                'negeri_id' => 16,
            ]
        );

    }
}
