<?php

namespace Database\Seeders;

use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'activity_log',
            'failed_jobs',
        ]);

        $this->call(AuthSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(NegeriSeeder::class);
        $this->call(PejabatSeeder::class);
        $this->call(JenisIklanSeeder::class);
        $this->call(BidangSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(CaraBayarSeeder::class);
        $this->call(BayarKepadaSeeder::class);
        $this->call(StatusIklanPerolehanSeeder::class);
        $this->call(SenaraiAlamatSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(KelasPukonsaSeeder::class);
        $this->call(KelasUpkjSeeder::class);
        $this->call(LantikanPenilaiSeeder::class);
        $this->call(HeaderSuratSeeder::class);
        $this->call(TandatanganSeeder::class);
        $this->call(SuratAkuanPelantikanSeeder::class);
        $this->call(SuratAkuanSelesaiTugasSeeder::class);
        $this->call(SuratHantarDokumenSeeder::class);
        $this->call(SuratLanjutSahLakuSeeder::class);
        $this->call(SuratEdaranKeputusanSeeder::class);
        $this->call(MemoEdarKeputusanSeeder::class);
        $this->call(KategoriIklanSeeder::class);



        Model::reguard();
    }
}
