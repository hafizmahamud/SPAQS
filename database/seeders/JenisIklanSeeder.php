<?php

namespace Database\Seeders;

use Modules\Sisdant\Models\JenisIklan;
use Modules\Sisdant\Models\KategoriPerolehan;
use Modules\Sisdant\Models\JenisTender;
use Modules\Sisdant\Models\MatrikIklan;
// use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class JenisIklanSeeder.
 */
class JenisIklanSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     *
     */
    public function run()
    {
        $this->truncate('jenis_iklan');
        $this->truncate('kategori_perolehan');
        $this->truncate('jenis_tender');
        $this->truncate('matrik_iklan');

        $jenisIklan = [
            ['id' => 1, 'nama' => 'SEBUT HARGA'],
            ['id' => 2, 'nama' => 'TENDER']
        ];
        foreach($jenisIklan as $JenisIklan){
            JenisIklan::create($JenisIklan);
        }

        $katPerolehan = [
            ['id' => 1, 'nama' => 'KERJA'],
            ['id' => 2, 'nama' => 'BEKALAN'],
            ['id' => 3, 'nama' => 'PERKHIDMATAN'],
            ['id' => 4, 'nama' => 'BEKALAN & PERKHIDMATAN'],
            ['id' => 5, 'nama' => 'PERKHIDMATAN PERUNDING'],
            ['id' => 6, 'nama' => 'PERKHIDMATAN BUKAN PERUNDING'],
        ];
        foreach($katPerolehan as $kategoriPerolehan){
            KategoriPerolehan::create($kategoriPerolehan);
        }

        $jenisTender = [
            ['id' => 1, 'nama' => 'SEBUT HARGA TERBUKA'],
            ['id' => 2, 'nama' => 'RUNDINGAN TERUS'],
            ['id' => 3, 'nama' => 'TENDER TERBUKA'],
            ['id' => 4, 'nama' => 'TENDER TERBUKA BUMIPUTERA'],
            ['id' => 5, 'nama' => 'PRA KELAYAKAN'],
            ['id' => 6, 'nama' => 'LAIN-LAIN'],
            ['id' => 7, 'nama' => 'TENDER PRA KELAYAKAN'],
            ['id' => 8, 'nama' => 'LTBKS'],
        ];
        foreach($jenisTender as $jenTender){
            JenisTender::create($jenTender);
        }

        $matrikIklan = [
            [
                'id' => 1,
                'jenis_iklan_id' => 1,
                'kategori_perolehan_id' => 1,
                'jenis_tender_id' => 1,
                'upload_iklan' => 1,
            ],
            [
                'id' => 2,
                'jenis_iklan_id' => 1,
                'kategori_perolehan_id' => 2,
                'jenis_tender_id' => 1,
                'upload_iklan' => 1,
            ],
            [
                'id' => 3,
                'jenis_iklan_id' => 1,
                'kategori_perolehan_id' => 2,
                'jenis_tender_id' => 2,
                'upload_iklan' => 0,
            ],
            [
                'id' => 4,
                'jenis_iklan_id' => 1,
                'kategori_perolehan_id' => 3,
                'jenis_tender_id' => 1,
                'upload_iklan' => 1,
            ],
            [
                'id' => 5,
                'jenis_iklan_id' => 1,
                'kategori_perolehan_id' => 3,
                'jenis_tender_id' => 2,
                'upload_iklan' => 0,
            ],
            [
                'id' => 6,
                'jenis_iklan_id' => 1,
                'kategori_perolehan_id' => 4,
                'jenis_tender_id' => 1,
                'upload_iklan' => 1,
            ],
            [
                'id' => 7,
                'jenis_iklan_id' => 1,
                'kategori_perolehan_id' => 4,
                'jenis_tender_id' => 2,
                'upload_iklan' => 1,
            ],
            [
                'id' => 8,
                'jenis_iklan_id' => 1,
                'kategori_perolehan_id' => 5,
                'upload_iklan' => 1,
            ],
            [
                'id' => 9,
                'jenis_iklan_id' => 1,
                'kategori_perolehan_id' => 6,
                'upload_iklan' => 1,
            ],
            [
                'id' => 10,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 1,
                'jenis_tender_id' => 3,
                'upload_iklan' => 1,
            ],
            [
                'id' => 11,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 1,
                'jenis_tender_id' => 4,
                'upload_iklan' => 1,
            ],
            [
                'id' => 12,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 1,
                'jenis_tender_id' => 5,
                'upload_iklan' => 1,
            ],
            [
                'id' => 13,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 1,
                'jenis_tender_id' => 2,
                'upload_iklan' => 1,
            ],
            [
                'id' => 14,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 1,
                'jenis_tender_id' => 6,
                'upload_iklan' => 1,
            ],
            [
                'id' => 15,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 2,
                'jenis_tender_id' => 3,
                'upload_iklan' => 1,
            ],
            [
                'id' => 16,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 2,
                'jenis_tender_id' => 2,
                'upload_iklan' => 0,
            ],
            [
                'id' => 17,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 3,
                'jenis_tender_id' => 3,
                'upload_iklan' => 1,
            ],
            [
                'id' => 18,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 3,
                'jenis_tender_id' => 2,
                'upload_iklan' => 0,
            ],
            [
                'id' => 19,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 4,
                'jenis_tender_id' => 3,
                'upload_iklan' => 1,
            ],
            [
                'id' => 20,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 4,
                'jenis_tender_id' => 2,
                'upload_iklan' => 0,
            ],
            [
                'id' => 21,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 5,
                'jenis_tender_id' => 3,
                'upload_iklan' => 1,
            ],
            [
                'id' => 22,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 5,
                'jenis_tender_id' => 7,
                'upload_iklan' => 1,
            ],
            [
                'id' => 23,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 5,
                'jenis_tender_id' => 8,
                'upload_iklan' => 0,
            ],
            [
                'id' => 24,
                'jenis_iklan_id' => 2,
                'kategori_perolehan_id' => 6,
                'upload_iklan' => 0,
            ],
        ];
        foreach($matrikIklan as $mapIklan){
            MatrikIklan::create($mapIklan);
        }
    }
}
