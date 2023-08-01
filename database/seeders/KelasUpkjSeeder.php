<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sisdant\Models\SubKelasUpkj;
use Modules\Sisdant\Models\KelasUpkj;
use Database\Seeders\Traits\TruncateTable;

class KelasUpkjSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create TAJUK 1
        KelasUpkj::create([
            'tajuk' => 'HEADS I',
            'keterangan' => 'CIVIL ENGINEERING WORKS',
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1',
            'keterangan' => 'GENERAL CIVIL ENGINEERING WORKS INCLUDING PILING',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(A)(i)',
            'keterangan' => 'BRIDGES - CONSTRUCTION',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(A)(ii)',
            'keterangan' => 'BRIDGES - REPAIR & MAINTENANCE',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(B)(i)',
            'keterangan' => 'WHARFS/JETTIE AND OTHER - CONSTRUCTION',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(B)(ii)',
            'keterangan' => 'WHARFS/JETTIE AND OTHER - REPAIR & MAINTENANCE',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(B)(iii)',
            'keterangan' => 'SISTEM PEMBETUNGAN',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(C)(i)',
            'keterangan' => 'FLYOVER - CONSTRUCTION',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(C)(ii)',
            'keterangan' => 'FLYOVER - REPAIR & MAINTENANCE',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3(A)(i)',
            'keterangan' => 'EROSION  PROTECTION WORKS - SEA/ RIVERWALLS',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3(A)(ii)',
            'keterangan' => 'EROSION  PROTECTION WORKS - RETAINING WALLS',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3(B)',
            'keterangan' => 'SERVICE RESERVOIRS',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3(C)',
            'keterangan' => 'DAMS/WATER RETAINING STRUCTURES',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 4(A)',
            'keterangan' => 'WATER WORKS - PIPE-LAYING WORKS',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 4(B)',
            'keterangan' => 'WATER WORKS - WATER MAINS',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 4(C)',
            'keterangan' => 'WATER WORKS - OTHER RELATED WORKS',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 5(A)',
            'keterangan' => 'GEOTECHNICAL WORKS',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 5(B)',
            'keterangan' => 'UNDERGROUND TUNNELLING/ DRILLING',
            'tajuk_id' => 1,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 6',
            'keterangan' => 'GAS PIPE LAYING',
            'tajuk_id' => 1,
        ]);

        // Create TAJUK 2
        KelasUpkj::create([
            'tajuk' => 'HEADS II',
            'keterangan' => 'BUILDING WORKS',
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1(A)',
            'keterangan' => 'NON-REINFORCED CONCRETE FRAMED STRUCTURE',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1(B)',
            'keterangan' => 'PRE-FABRICATED TIMBER BUILDINGS',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1(C)',
            'keterangan' => 'PRE-FABRICATED/ FABRICATED STEEL STRUCTURE',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(A)',
            'keterangan' => 'REINFORCED CONCRETE FRAMED BUILDINGS',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(B)',
            'keterangan' => 'PRE-FABRICATED CONCRETE BUILDINGS',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3(A)',
            'keterangan' => 'REPAINTING/ REPAIR/ MAINTENANCE OF HIGH-RISE',
            'tajuk_id' => 2,
        ]);
        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3(B)',
            'keterangan' => 'DEMOLITION',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3(C)',
            'keterangan' => 'OTHER RELATED WORKS (EXCEEDING 4-STOREYS)',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 4',
            'keterangan' => 'PLUMBING & SANITARY WORKS',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 5(A)',
            'keterangan' => 'REPAINTING/ REPAIR/ MAINTENANCE OF LOW-RISE BUILDING',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 5(B)',
            'keterangan' => 'DEMOLITION (NOT-EXCEEDING 4-STOREYS)',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 5(C)',
            'keterangan' => 'OTHER RELATED WORKS',
            'tajuk_id' => 2,
        ]);
        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 6(A)',
            'keterangan' => 'FENCING WORKS',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 6(B)',
            'keterangan' => 'OTHERS',
            'tajuk_id' => 2,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 7',
            'keterangan' => 'BUSTOP SHEDS & OTHER RELATED STRUCTURES',
            'tajuk_id' => 2,
        ]);

        // Create TAJUK 3
        KelasUpkj::create([
            'tajuk' => 'HEADS III',
            'keterangan' => 'ROAD WORKS/EARTHWORKS',
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1(A)',
            'keterangan' => 'LEVELLING & EARTHWORKS',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1(B)',
            'keterangan' => 'SITE CLEARING',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1(C)',
            'keterangan' => 'JUNGLE FELLING & TERRACING',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1(D)',
            'keterangan' => 'FARM ROAD/ GRAVEL ROAD',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1(E)',
            'keterangan' => 'OTHER RELATED WORKS, SAND-FILLING, ETC',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(A)',
            'keterangan' => 'ASPHALTIC COATINGS',
            'tajuk_id' => 3,
        ]);
        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(B)',
            'keterangan' => 'BITUMINOUS ROAD',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(C)',
            'keterangan' => 'OTHER MATERIALS ASSOCIATED WITH ROAD CONSTRUCTION',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(D)',
            'keterangan' => 'REPAIR & MAINTENANCE',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3(A)',
            'keterangan' => 'EARTH',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3(B)',
            'keterangan' => 'R.C.',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3(C)',
            'keterangan' => 'PLANKWALK',
            'tajuk_id' => 3,
        ]);
        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 4(A)',
            'keterangan' => 'CONSTRUCTION, REPAIR & MAINTENANCE OF ROAD-RAILING',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 4(B)',
            'keterangan' => 'ROAD LINING & ASSOCIATED WORKS',
            'tajuk_id' => 3,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 4(C)',
            'keterangan' => 'CONSTRUCTION REPAIR & MAINTENANCE OF ROAD KERBS/DIVIDERS',
            'tajuk_id' => 3,
        ]);

        // Create TAJUK 4
        KelasUpkj::create([
            'tajuk' => 'HEADS IV',
            'keterangan' => 'DRAINAGE & IRRIGATION WORKS',
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1(A)',
            'keterangan' => 'RIVER CLEARING / WIDENING',
            'tajuk_id' => 4,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 1(B)',
            'keterangan' => 'DRAINAGE CLEARING / WIDENING',
            'tajuk_id' => 4,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(A)',
            'keterangan' => 'DRAINAGE/ IRRIGATION',
            'tajuk_id' => 4,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2(B)',
            'keterangan' => 'HYDRAULIC STRUCTURES',
            'tajuk_id' => 4,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3',
            'keterangan' => 'SEWERAGE WORKS',
            'tajuk_id' => 4,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 4(A)',
            'keterangan' => 'CONSTRUCTION OF CONCRETE DRAINS /CULVERTS',
            'tajuk_id' => 4,
        ]);
        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 4(B)',
            'keterangan' => 'MAINTENANCE OF DRAINS/ CULVERTS',
            'tajuk_id' => 4,
        ]);

        // Create TAJUK 5
        KelasUpkj::create([
            'tajuk' => 'HEADS VI',
            'keterangan' => 'REFORESTATION (FORESTRY) & LANDSCAPING WORKS',
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD A',
            'keterangan' => 'ESTABLISHMENT/ MAINTENANCE OF NURSERY (SEEDLINGS)',
            'tajuk_id' => 5,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 2',
            'keterangan' => 'PLANTING, REPLANTING & MAINTENANCE',
            'tajuk_id' => 5,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 3',
            'keterangan' => 'SIVILCULTURAL TREATMENT',
            'tajuk_id' => 5,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 4',
            'keterangan' => 'MAINTENANCE OF FOREST RESERVE & FOREST BOUNDARIES',
            'tajuk_id' => 5,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 5(A)(i)',
            'keterangan' => 'LANDSCAPING WORKS - CONSTRUCTION',
            'tajuk_id' => 5,
        ]);
        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 5(A)(ii)',
            'keterangan' => 'LANDSCAPING WORKS - MAINTENANCE',
            'tajuk_id' => 5,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 5(B)',
            'keterangan' => 'GRASS-CUTTING',
            'tajuk_id' => 5,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 5(C)',
            'keterangan' => 'PRUNING & MANAGEMENT OF ORNAMENTAL TREES / PLANTS',
            'tajuk_id' => 5,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 5(D)',
            'keterangan' => 'TURFING',
            'tajuk_id' => 5,
        ]);

        SubKelasUpkj::create([
            'tajuk_kecil' => 'SUB-HEAD 6',
            'keterangan' => 'PLAYGROUND',
            'tajuk_id' => 5,
        ]);

    }
}
