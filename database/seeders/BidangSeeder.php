<?php

namespace Database\Seeders;

use App\Domains\Auth\Models\Permission;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Modules\Sisdant\Models\Bidang;
use Modules\Sisdant\Models\SubBidang;
use Database\Seeders\Traits\TruncateTable;

/**
 * Class PermissionRoleTableSeeder.
 */
class BidangSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->truncate('bidang');

        // Create Kod Bidang Penerbitan
        Bidang::create([
            'id' => 1,
            'kod' => '0101',
            'bidang' => 'PENERBITAN',
        ]);

        // Create Sub Bidang Penerbitan
        SubBidang::create([
            'kod' => '010101',
            'sub_bidang' => 'BAHAN BACAAN TERBITAN LUAR NEGARA',
            'bidang_id' => 1,
        ]);
        SubBidang::create([
            'kod' => '010102',
            'sub_bidang' => 'BAHAN BACAAN',
            'bidang_id' => 1,
        ]);
        SubBidang::create([
            'kod' => '010103',
            'sub_bidang' => 'PENERBITAN ELEKTRONIK ATAS TALIAN',
            'bidang_id' => 1,
        ]);
        SubBidang::create([
            'kod' => '010104',
            'sub_bidang' => 'BAHAN PENERBITAN ELEKTRONIK DAN MUZIK/LAGU (SIAP CETAK)',
            'bidang_id' => 1,
        ]);

        // Create Kod Bidang Kertas
        Bidang::create([
            'id' => 2,
            'kod' => '0102',
            'bidang' => 'KERTAS',
        ]);

        // Create Sub Bidang Kertas
        SubBidang::create([
            'kod' => '010201',
            'sub_bidang' => 'KERTAS',
            'bidang_id' => 2,
        ]);
        SubBidang::create([
            'kod' => '010299',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 2,
        ]);

        // Create Kod Bidang Peralatan Penerbitan/Percetakan
        Bidang::create([
            'id' => 3,
            'kod' => '0103',
            'bidang' => 'PERALATAN PENERBITAN/PERCETAKAN',
        ]);

        // Create Sub Bidang Peralatan Penerbitan/Percetakan
        SubBidang::create([
            'kod' => '010301',
            'sub_bidang' => 'PERALATAN PERCETAKAN SERTA AKSESORI',
            'bidang_id' => 3,
        ]);
        SubBidang::create([
            'kod' => '010302',
            'sub_bidang' => 'PERALATAN SISTEM BUNYI, PEMBESAR SUARA DAN PROJEKTOR',
            'bidang_id' => 3,
        ]);
        SubBidang::create([
            'kod' => '010303',
            'sub_bidang' => 'PERALATAN/PERKAKASAN PENYUNTINGAN/PERSEMBAHAN',
            'bidang_id' => 3,
        ]);
        SubBidang::create([
            'kod' => '010304',
            'sub_bidang' => 'MEDIUM PENYIMPANAN',
            'bidang_id' => 3,
        ]);
        SubBidang::create([
            'kod' => '010399',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 3,
        ]);

        // Create Kod Bidang Papan tanda dan aksesori
        Bidang::create([
            'id' => 4,
            'kod' => '0104',
            'bidang' => 'PAPAN TANDA DAN AKSESSORI',
        ]);

        // Create Sub Bidang Papan tanda dan aksesori
        SubBidang::create([
            'kod' => '010401',
            'sub_bidang' => 'PAPAN TANDA DAN AKSESSORI',
            'bidang_id' => 4,
        ]);
        SubBidang::create([
            'kod' => '010499',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 4,
        ]);

        // Create Kod Bidang Fotografi dan filem
        Bidang::create([
            'id' => 5,
            'kod' => '0105',
            'bidang' => 'FOTOGRAFI DAN FILEM',
        ]);

        // Create Sub Bidang Fotografi dan filem
        SubBidang::create([
            'kod' => '010501',
            'sub_bidang' => 'KAMERA DAN AKSESORI',
            'bidang_id' => 5,
        ]);
        SubBidang::create([
            'kod' => '010502',
            'sub_bidang' => 'PERALATAN PEMPROSESAN FOTOGRAFI, MIKROFILEM',
            'bidang_id' => 5,
        ]);
        SubBidang::create([
            'kod' => '010503',
            'sub_bidang' => 'FILEM DAN MIKROFILEM',
            'bidang_id' => 5,
        ]);
        SubBidang::create([
            'kod' => '010504',
            'sub_bidang' => 'FILEM SIAP UNTUK TAYANGAN (LESEN B FINAS - PENGEDAR)',
            'bidang_id' => 5,
        ]);
        SubBidang::create([
            'kod' => '010599',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 5,
        ]);

        // Create Kod Bidang Peralatan pendidikan dan latihan
        Bidang::create([
            'id' => 6,
            'kod' => '0106',
            'bidang' => 'PERALATAN PENDIDIKAN DAN LATIHAN',
        ]);

        // Create Sub Bidang Papan tanda dan aksesori
        SubBidang::create([
            'kod' => '010601',
            'sub_bidang' => 'KIT PENDIDIKAN',
            'bidang_id' => 6,
        ]);
        SubBidang::create([
            'kod' => '010602',
            'sub_bidang' => 'BAHAN PENDIDIKAN',
            'bidang_id' => 6,
        ]);
        SubBidang::create([
            'kod' => '010699',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 6,
        ]);

        // Create Kod Bidang PERABOT, KELENGKAPAN DAN AKSESORI
        Bidang::create([
            'id' => 7,
            'kod' => '0201',
            'bidang' => 'PERABOT, KELENGKAPAN DAN AKSESORI',
        ]);

        // Create Sub Bidang PERABOT, KELENGKAPAN DAN AKSESORI
        SubBidang::create([
            'kod' => '020101',
            'sub_bidang' => 'PERABOT, PERABOT MAKMAL DAN KELENGKAPAN BERASASKAN KAYU/ ROTAN /FABRIK /LOGAM /PLASTIK (WORKSTATIONS)',
            'bidang_id' => 7,
        ]);
        SubBidang::create([
            'kod' => '020102',
            'sub_bidang' => 'BARANGAN HIASAN DALAMAN DAN AKSESORI',
            'bidang_id' => 7,
        ]);
        SubBidang::create([
            'kod' => '020103',
            'sub_bidang' => 'PERMAIDANI/ AMBAR',
            'bidang_id' => 7,
        ]);
        SubBidang::create([
            'kod' => '020199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 7,
        ]);

        // Create Kod Bidang MESIN-MESIN PEJABAT  DAN AKSESORI
        Bidang::create([
            'id' => 8,
            'kod' => '0202',
            'bidang' => 'MESIN-MESIN PEJABAT  DAN AKSESORI',
        ]);

        // Create Sub Bidang MESIN-MESIN PEJABAT  DAN AKSESORI
        SubBidang::create([
            'kod' => '020201',
            'sub_bidang' => 'MESIN-MESIN PEJABAT DAN AKSESORI',
            'bidang_id' => 8,
        ]);
        SubBidang::create([
            'kod' => '020199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 8,
        ]);

        // Create Kod Bidang PERKAKAS ELEKTRIK DAN ELEKTRONIK
        Bidang::create([
            'id' => 9,
            'kod' => '0203',
            'bidang' => 'PERKAKAS ELEKTRIK DAN ELEKTRONIK',
        ]);

        // Create Sub Bidang PERKAKAS ELEKTRIK DAN ELEKTRONIK
        SubBidang::create([
            'kod' => '020301',
            'sub_bidang' => 'PERKAKAS ELEKTRIK DAN AKSESORI',
            'bidang_id' => 9,
        ]);
        SubBidang::create([
            'kod' => '020302',
            'sub_bidang' => 'PERKAKAS ELEKTRONIK DAN AKSESORI',
            'bidang_id' => 9,
        ]);
        SubBidang::create([
            'kod' => '020399',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 9,
        ]);

        // Create Kod Bidang PERALATAN DAN PERKAKAS DOMESTIK
        Bidang::create([
            'id' => 10,
            'kod' => '0204',
            'bidang' => 'PERALATAN DAN PERKAKAS DOMESTIK',
        ]);

        // Create Sub Bidang PERALATAN DAN PERKAKAS DOMESTIK
        SubBidang::create([
            'kod' => '020401',
            'sub_bidang' => 'PERALATAN DAN PERKAKAS DOMESTIK (TERMASUK BARANG- BARANG YANG TIDAK LEKAT DI BADAN)',
            'bidang_id' => 10,
        ]);
        SubBidang::create([
            'kod' => '020402',
            'sub_bidang' => 'PERKAKASAN DAN BAHAN KEBERSIHAN DIRI DAN MANDIAN, KELENGKAPAN BILIK AIR DAN AKSESORI',
            'bidang_id' => 10,
        ]);
        SubBidang::create([
            'kod' => '020403',
            'sub_bidang' => 'BAHAN PENCUCI DAN PEMBERSIHAN',
            'bidang_id' => 10,
        ]);
        SubBidang::create([
            'kod' => '020404',
            'sub_bidang' => 'BAHAN DAN PERALATAN SOLEKAN DAN ANDAMAN',
            'bidang_id' => 10,
        ]);
        SubBidang::create([
            'kod' => '020499',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 10,
        ]);

         // Create Kod Bidang BAHAN PEMBUNGKUSAN/BEKAS
         Bidang::create([
            'id' => 11,
            'kod' => '0205',
            'bidang' => 'BAHAN PEMBUNGKUSAN/BEKAS',
        ]);

        // Create Sub Bidang BAHAN PEMBUNGKUSAN/BEKAS
        SubBidang::create([
            'kod' => '020501',
            'sub_bidang' => 'BAHAN PEMBUNGKUSAN/ BEKAS/ KOTAK/ PALET',
            'bidang_id' => 11,
        ]);
        SubBidang::create([
            'kod' => '020599',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 11,
        ]);

        // Create Kod Bidang BEKALAN PEJABAT DAN ALATULIS
        Bidang::create([
            'id' => 12,
            'kod' => '0206',
            'bidang' => 'BEKALAN PEJABAT DAN ALATULIS',
        ]);

        // Create Sub Bidang BEKALAN PEJABAT DAN ALATULIS
        SubBidang::create([
            'kod' => '020601',
            'sub_bidang' => 'ALATULIS(TIDAK TERMASUK BORANG DAN SEMUA JENIS KERTAS)',
            'bidang_id' => 12,
        ]);
        SubBidang::create([
            'kod' => '020602',
            'sub_bidang' => 'BAHAN SURIH, DRAFTING DAN ALAT LUKIS',
            'bidang_id' => 12,
        ]);
        SubBidang::create([
            'kod' => '020603',
            'sub_bidang' => 'ORGANISER, DAIRI, KALENDAR, BUKU ALAMAT, RESIT, MEMO',
            'bidang_id' => 12,
        ]);
        SubBidang::create([
            'kod' => '020604',
            'sub_bidang' => 'TAG/ LABEL/ TANDA DAN STIKER',
            'bidang_id' => 12,
        ]);
        SubBidang::create([
            'kod' => '020699',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 12,
        ]);

         // Create Kod Bidang TEKSTIL
         Bidang::create([
            'id' => 13,
            'kod' => '0207',
            'bidang' => 'TEKSTIL',
        ]);

        // Create Sub Bidang TEKSTIL
        SubBidang::create([
            'kod' => '020701',
            'sub_bidang' => 'TEKSTIL',
            'bidang_id' => 13,
        ]);
        SubBidang::create([
            'kod' => '020799',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 13,
        ]);

        // Create Kod Bidang PAKAIAN DAN KELENGKAPAN
        Bidang::create([
            'id' => 14,
            'kod' => '0208',
            'bidang' => 'PAKAIAN DAN KELENGKAPAN',
        ]);

        // Create Sub Bidang BEKALAN PEJABAT DAN ALATULIS
        SubBidang::create([
            'kod' => '020801',
            'sub_bidang' => 'PAKAIAN',
            'bidang_id' => 14,
        ]);
        SubBidang::create([
            'kod' => '020802',
            'sub_bidang' => 'KELENGKAPAN PAKAIAN',
            'bidang_id' => 14,
        ]);
        SubBidang::create([
            'kod' => '020803',
            'sub_bidang' => 'BAGASI DAN BEG DARI KULIT/ PVC/ KANVAS/ KAIN/ NYLON/ PLASTIK/ LOGAM/ DLL',
            'bidang_id' => 14,
        ]);
        SubBidang::create([
            'kod' => '020804',
            'sub_bidang' => 'PAKAIAN KESELAMATAN, KELENGKAPAN DAN AKSESORI',
            'bidang_id' => 14,
        ]);
        SubBidang::create([
            'kod' => '020899',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 14,
        ]);

        // Create Kod Bidang BAHAN TARPAULIN DAN KANVAS
        Bidang::create([
            'id' => 15,
            'kod' => '0209',
            'bidang' => 'BAHAN TARPAULIN DAN KANVAS',
        ]);

        // Create Sub Bidang BAHAN TARPAULIN DAN KANVAS
        SubBidang::create([
            'kod' => '020901',
            'sub_bidang' => 'BAHAN TARPAULIN DAN KANVAS',
            'bidang_id' => 15,
        ]);
        SubBidang::create([
            'kod' => '020999',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 15,
        ]);

        // Create Kod Bidang AKSESORI DAN BEKALAN JAHITAN
        Bidang::create([
            'id' => 16,
            'kod' => '0210',
            'bidang' => 'AKSESORI DAN BEKALAN JAHITAN',
        ]);

        // Create Sub Bidang AKSESORI DAN BEKALAN JAHITAN
        SubBidang::create([
            'kod' => '021001',
            'sub_bidang' => 'BUTANG DAN BEKALAN JAHITAN (KITS)',
            'bidang_id' => 16,
        ]);
        SubBidang::create([
            'kod' => '021099',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 16,
        ]);

        // Create Kod Bidang PAKAIAN SUKAN DAN AKSESORI
        Bidang::create([
            'id' => 17,
            'kod' => '0301',
            'bidang' => 'PAKAIAN SUKAN DAN AKSESORI',
        ]);

        // Create Sub Bidang PAKAIAN SUKAN DAN AKSESORI
        SubBidang::create([
            'kod' => '030101',
            'sub_bidang' => 'PAKAIAN SUKAN DAN AKSESORI',
            'bidang_id' => 17,
        ]);
        SubBidang::create([
            'kod' => '030199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 17,
        ]);

        // Create Kod Bidang CENDERAMATA DAN HADIAH
        Bidang::create([
            'id' => 18,
            'kod' => '0302',
            'bidang' => 'CENDERAMATA DAN HADIAH',
        ]);

        // Create Sub Bidang CENDERAMATA DAN HADIAH
        SubBidang::create([
            'kod' => '030201',
            'sub_bidang' => 'CENDERAMATA DAN HADIAH',
            'bidang_id' => 18,
        ]);
        SubBidang::create([
            'kod' => '030299',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 18,
        ]);

        // Create Kod Bidang ALAT MUZIK
        Bidang::create([
            'id' => 19,
            'kod' => '0303',
            'bidang' => 'ALAT MUZIK',
        ]);

        // Create Sub Bidang ALAT MUZIK
        SubBidang::create([
            'kod' => '030301',
            'sub_bidang' => 'ALAT MUZIK DAN AKSESORI',
            'bidang_id' => 19,
        ]);
        SubBidang::create([
            'kod' => '030399',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 19,
        ]);

        // Create Kod Bidang PERALATAN DAN AKSESORI PERKHEMAHAN DAN AKTIVITI LUAR

        Bidang::create([
            'id' => 20,
            'kod' => '0304',
            'bidang' => 'PERALATAN DAN AKSESORI PERKHEMAHAN DAN AKTIVITI LUAR',
        ]);

        // Create Sub Bidang ALAT MUZIK
        SubBidang::create([
            'kod' => '030401',
            'sub_bidang' => 'PERALATAN PERKHEMAHAN DAN AKTIVITI LUAR',
            'bidang_id' => 20,
        ]);
        SubBidang::create([
            'kod' => '030402',
            'sub_bidang' => 'PERALATAN MEMANCING',
            'bidang_id' => 20,
        ]);
        SubBidang::create([
            'kod' => '030403',
            'sub_bidang' => 'PERALATAN MEMBURU',
            'bidang_id' => 20,
        ]);
        SubBidang::create([
            'kod' => '030499',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 20,
        ]);

         // Create Kod Bidang PERALATAN SUKAN PADANG, GELANGGANG, REKREASI, TAMAN PERMAINAN, KECERGASAN  DAN SUKAN
         Bidang::create([
            'id' => 21,
            'kod' => '0305',
            'bidang' => 'PERALATAN SUKAN PADANG, GELANGGANG, REKREASI, TAMAN PERMAINAN, KECERGASAN  DAN SUKAN',
        ]);

        // Create Sub Bidang PERALATAN SUKAN PADANG, GELANGGANG, REKREASI, TAMAN PERMAINAN, KECERGASAN  DAN SUKAN
        SubBidang::create([
            'kod' => '030501',
            'sub_bidang' => 'PERALATAN SUKAN',
            'bidang_id' => 21,
        ]);
        SubBidang::create([
            'kod' => '030599',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 21,
        ]);

        // Create Kod Bidang MAKANAN, MINUMAN DAN BAHAN MENTAH KERING/BASAH
        Bidang::create([
            'id' => 22,
            'kod' => '0401',
            'bidang' => 'MAKANAN, MINUMAN DAN BAHAN MENTAH KERING/BASAH',
        ]);

        // Create Sub Bidang MAKANAN, MINUMAN DAN BAHAN MENTAH KERING/BASAH
        SubBidang::create([
            'kod' => '040101',
            'sub_bidang' => 'MAKANAN DAN BAHAN MENTAH KERING/BASAH',
            'bidang_id' => 22,
        ]);
        SubBidang::create([
            'kod' => '040102',
            'sub_bidang' => 'MAKANAN DAN MINUMAN (TIN,BOTOL DAN BUNGKUS)',
            'bidang_id' => 22,
        ]);
        SubBidang::create([
            'kod' => '040103',
            'sub_bidang' => 'MAKANAN BERMASAK (ISLAM)',
            'bidang_id' => 22,
        ]);
        SubBidang::create([
            'kod' => '040104',
            'sub_bidang' => 'MAKANAN BERMASAK (BUKAN ISLAM)',
            'bidang_id' => 22,
        ]);
        SubBidang::create([
            'kod' => '040199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 22,
        ]);

        // Create Kod Bidang PERALATAN HOSPITAL, BAHAN DAN KELENGKAPAN PERUBATAN
        Bidang::create([
            'id' => 23,
            'kod' => '0501',
            'bidang' => 'PERALATAN HOSPITAL, BAHAN DAN KELENGKAPAN PERUBATAN',
        ]);

        // Create Sub Bidang PERALATAN HOSPITAL, BAHAN DAN KELENGKAPAN PERUBATAN
        SubBidang::create([
            'kod' => '050101',
            'sub_bidang' => 'PERALATAN DAN KELENGKAPAN HOSPITAL',
            'bidang_id' => 23,
        ]);
        SubBidang::create([
            'kod' => '050102',
            'sub_bidang' => 'PERALATAN DAN KELENGKAPAN PERUBATAN',
            'bidang_id' => 23,
        ]);
        SubBidang::create([
            'kod' => '050103',
            'sub_bidang' => 'PERALATAN UNTUK ORANG KURANG UPAYA DAN PEMULIHAN',
            'bidang_id' => 23,
        ]);
        SubBidang::create([
            'kod' => '050199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 23,
        ]);

        // Create Kod Bidang UBAT DAN BAHAN UBATAN
        Bidang::create([
            'id' => 24,
            'kod' => '0502',
            'bidang' => 'UBAT DAN BAHAN UBATAN',
        ]);

        // Create Sub Bidang UBAT DAN BAHAN UBATAN
        SubBidang::create([
            'kod' => '050201',
            'sub_bidang' => 'DADAH BERJADUAL (PERLU LESEN FARMASI (BORANG 3) DARI PIHAK BERKUASA KAWALAN DADAH, KKM)',
            'bidang_id' => 24,
        ]);
        SubBidang::create([
            'kod' => '050202',
            'sub_bidang' => 'RACUN BERJADUAL (PERLU LESEN FARMASI (TYPE A LICENCE) DARI JABATAN KESIHATAN NEGERI)',
            'bidang_id' => 24,
        ]);
        SubBidang::create([
            'kod' => '050203',
            'sub_bidang' => 'UBAT TIDAK BERJADUAL',
            'bidang_id' => 24,
        ]);
        SubBidang::create([
            'kod' => '050204',
            'sub_bidang' => 'MAKANAN/MINUMAN TAMBAHAN (FOOD SUPPLIMENT)',
            'bidang_id' => 24,
        ]);
        SubBidang::create([
            'kod' => '050299',
            'sub_bidang' => 'PEMBUAT (PERLU LESEN PENGILANG (BORANG 2) DARI KKM)',
            'bidang_id' => 24,
        ]);

        // Create Kod Bidang PEKAKAS, TEKSTIL DAN PAKAIAN PERUBATAN PAKAI BUANG/GUNA SEMULA
        Bidang::create([
            'id' => 25,
            'kod' => '0503',
            'bidang' => 'PEKAKAS, TEKSTIL DAN PAKAIAN PERUBATAN PAKAI BUANG/GUNA SEMULA',
        ]);

        // Create Sub Bidang PEKAKAS, TEKSTIL DAN PAKAIAN PERUBATAN PAKAI BUANG/GUNA SEMULA
        SubBidang::create([
            'kod' => '050301',
            'sub_bidang' => 'PEKEKAS PERUBATAN PAKAI BUANG',
            'bidang_id' => 25,
        ]);
        SubBidang::create([
            'kod' => '050302',
            'sub_bidang' => 'PAKAIAN/ TEKSTIL PAKAI BUANG KAKITANGAN/ PESAKIT',
            'bidang_id' => 25,
        ]);
        SubBidang::create([
            'kod' => '050303',
            'sub_bidang' => 'PAKAIAN/ TEKSTIL GUNA SEMULA KAKITANGAN/ PESAKIT',
            'bidang_id' => 25,
        ]);
        SubBidang::create([
            'kod' => '050399',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 25,
        ]);

        // Create Kod Bidang KIMIA
        Bidang::create([
            'id' => 26,
            'kod' => '0601',
            'bidang' => 'KIMIA',
        ]);

        // Create Sub Bidang KIMIA
        SubBidang::create([
            'kod' => '060101',
            'sub_bidang' => 'KIMIA MAKMAL',
            'bidang_id' => 26,
        ]);
        SubBidang::create([
            'kod' => '060102',
            'sub_bidang' => 'KIMIA INDUSTRI',
            'bidang_id' => 26,
        ]);
        SubBidang::create([
            'kod' => '060103',
            'sub_bidang' => 'KIMIA MEMPROSES AIR',
            'bidang_id' => 26,
        ]);
        SubBidang::create([
            'kod' => '060104',
            'sub_bidang' => 'KIMIA MEMPROSES FILEM/ FOTOGRAFI',
            'bidang_id' => 26,
        ]);
        SubBidang::create([
            'kod' => '060199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 26,
        ]);

        // Create Kod Bidang BAHAN BIOKIMIA DAN GAS
        Bidang::create([
            'id' => 27,
            'kod' => '0602',
            'bidang' => 'BAHAN BIOKIMIA DAN GAS',
        ]);

        // Create Sub Bidang BAHAN BIOKIMIA DAN GAS
        SubBidang::create([
            'kod' => '060201',
            'sub_bidang' => 'BAHAN PELEDAK (BELERANG, PELARUT HIDROKABON DAN BEROKSIGEN/ GUNPOWDER)',
            'bidang_id' => 27,
        ]);
        SubBidang::create([
            'kod' => '060202',
            'sub_bidang' => 'BUNGA API DAN MERCUN',
            'bidang_id' => 27,
        ]);
        SubBidang::create([
            'kod' => '060203',
            'sub_bidang' => 'PENCUCUH/ALAT PENGHASIL NYALAAN',
            'bidang_id' => 27,
        ]);
        SubBidang::create([
            'kod' => '060204',
            'sub_bidang' => 'GAS (INDUSTRI DAN DOMESTIK)',
            'bidang_id' => 27,
        ]);
        SubBidang::create([
            'kod' => '060205',
            'sub_bidang' => 'PEWARNA/PENCELUP/LILIN',
            'bidang_id' => 27,
        ]);
        SubBidang::create([
            'kod' => '060299',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 27,
        ]);

        // Create Kod Bidang BAHAN BAKAR DAN PELINCIR
        Bidang::create([
            'id' => 28,
            'kod' => '0603',
            'bidang' => 'BAHAN BAKAR DAN PELINCIR',
        ]);

        // Create Sub Bidang BAHAN BAKAR DAN PELINCIR
        SubBidang::create([
            'kod' => '060301',
            'sub_bidang' => 'BAHAN BAKAR',
            'bidang_id' => 28,
        ]);
        SubBidang::create([
            'kod' => '060302',
            'sub_bidang' => 'BAHAN PELINCIR',
            'bidang_id' => 28,
        ]);
        SubBidang::create([
            'kod' => '060303',
            'sub_bidang' => 'BAHAN API NUKLEAR',
            'bidang_id' => 28,
        ]);
        SubBidang::create([
            'kod' => '060399',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 28,
        ]);

        // Create Kod Bidang CAT, ANTI KAKIS DAN BAHAN TAMBAH
        Bidang::create([
            'id' => 29,
            'kod' => '0604',
            'bidang' => 'CAT, ANTI KAKIS DAN BAHAN TAMBAH',
        ]);

        // Create Sub Bidang CAT, ANTI KAKIS DAN BAHAN TAMBAH
        SubBidang::create([
            'kod' => '060401',
            'sub_bidang' => 'CAT',
            'bidang_id' => 29,
        ]);
        SubBidang::create([
            'kod' => '060402',
            'sub_bidang' => 'ANTI KAKIS/BAHAN TAMBAH',
            'bidang_id' => 29,
        ]);
        SubBidang::create([
            'kod' => '060499',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 29,
        ]);

        // Create Kod Bidang PERALATAN MAKMAL
        Bidang::create([
            'id' => 30,
            'kod' => '0605',
            'bidang' => 'PERALATAN MAKMAL',
        ]);

        // Create Sub Bidang PERALATAN MAKMAL
        SubBidang::create([
            'kod' => '060501',
            'sub_bidang' => 'PERALATAN MAKMAL SERTA AKSESORI',
            'bidang_id' => 30,
        ]);
        SubBidang::create([
            'kod' => '060502',
            'sub_bidang' => 'PERALATAN MAKMAL PENGUKURAN, PENCERAPAN DAN SUKAT',
            'bidang_id' => 30,
        ]);
        SubBidang::create([
            'kod' => '060599',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 30,
        ]);

        // Create Kod Bidang BAJA DAN RACUN
        Bidang::create([
            'id' => 31,
            'kod' => '0701',
            'bidang' => 'BAJA DAN RACUN',
        ]);

        // Create Sub Bidang BAJA DAN RACUN
        SubBidang::create([
            'kod' => '070101',
            'sub_bidang' => 'BAJA DAN NUTRIEN TUMBUHAN (ORGANIK/BUKAN ORGANIK)',
            'bidang_id' => 31,
        ]);
        SubBidang::create([
            'kod' => '070102',
            'sub_bidang' => 'RACUN SERANGGA/PEROSAK, RUMPAI/TUMBUHAN',
            'bidang_id' => 31,
        ]);
        SubBidang::create([
            'kod' => '070199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 31,
        ]);

        // Create Kod Bidang TANAMAN, TERNAKAN, BAKA TANAMAN/TERNAKAN  DAN SAMPEL (BAHAN YANG TELAH DI AWETKAN)
        Bidang::create([
            'id' => 32,
            'kod' => '0702',
            'bidang' => 'TANAMAN, TERNAKAN, BAKA TANAMAN/TERNAKAN  DAN SAMPEL (BAHAN YANG TELAH DI AWETKAN)',
        ]);

        // Create Sub Bidang TANAMAN, TERNAKAN, BAKA TANAMAN/TERNAKAN  DAN SAMPEL (BAHAN YANG TELAH DI AWETKAN)
        SubBidang::create([
            'kod' => '070201',
            'sub_bidang' => 'TANAMAN/BAKA/BENIH SEMAIAN',
            'bidang_id' => 32,
        ]);
        SubBidang::create([
            'kod' => '070202',
            'sub_bidang' => 'HAIWAN TERNAKAN, BUKAN TERNAKAN DAN AKUATIK',
            'bidang_id' => 32,
        ]);
        SubBidang::create([
            'kod' => '070203',
            'sub_bidang' => 'SAMPEL DAN SAMPEL AWETAN HAIWAN/ AKUATIK/ SERANGGA/ TUMBUHAN',
            'bidang_id' => 32,
        ]);

        // Create Kod Bidang UBAT, MAKANAN TERNAKAN/TUMBUHAN,  PERALATAN DAN AKSESORI
        Bidang::create([
            'id' => 33,
            'kod' => '0703',
            'bidang' => 'UBAT, MAKANAN TERNAKAN/ TUMBUHAN, PERALATAN DAN AKSESORI',
        ]);

        // Create Sub Bidang UBAT, MAKANAN TERNAKAN/ TUMBUHAN, PERALATAN DAN AKSESORI
        SubBidang::create([
            'kod' => '070301',
            'sub_bidang' => 'UBAT HAIWAN/ AKUATIK',
            'bidang_id' => 33,
        ]);
        SubBidang::create([
            'kod' => '070302',
            'sub_bidang' => 'MAKANAN HAIWAN/ AKUATIK',
            'bidang_id' => 33,
        ]);
        SubBidang::create([
            'kod' => '070303',
            'sub_bidang' => 'PERALATAN DAN KELENGKAPAN PERTANIAN/ TERNAKAN/ AKUATIK',
            'bidang_id' => 33,
        ]);
        SubBidang::create([
            'kod' => '070304',
            'sub_bidang' => 'HASIL SAMPINGAN DAN SISA PERLADANGAN',
            'bidang_id' => 33,
        ]);
        SubBidang::create([
            'kod' => '070305',
            'sub_bidang' => 'HABITAT DAN TEMPAT KURUNGAN HAIWAN',
            'bidang_id' => 33,
        ]);
        SubBidang::create([
            'kod' => '070306',
            'sub_bidang' => 'PERALATAN PENGAWALAN PEROSAK TANAMAN',
            'bidang_id' => 33,
        ]);
        SubBidang::create([
            'kod' => '070399',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 33,
        ]);

        // Create Kod Bidang KELENGKAPAN/KEMUDAHAN AWAM
        Bidang::create([
            'id' => 34,
            'kod' => '0801',
            'bidang' => 'KELENGKAPAN/KEMUDAHAN AWAM',
        ]);

        // Create Sub Bidang KELENGKAPAN/KEMUDAHAN AWAM
        SubBidang::create([
            'kod' => '080101',
            'sub_bidang' => 'KELENGKAPAN/KEMUDAHAN AWAM (KECUALI KELENGKAPAN KEMUDAHAN PERMAINAN/SUKAN)',
            'bidang_id' => 34,
        ]);
        SubBidang::create([
            'kod' => '080102',
            'sub_bidang' => 'KONTENA',
            'bidang_id' => 34,
        ]);
        SubBidang::create([
            'kod' => '080199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 34,
        ]);

        // Create Kod Bidang BAHAN BINAAN
        Bidang::create([
            'id' => 35,
            'kod' => '0901',
            'bidang' => 'BAHAN BINAAN',
        ]);

        // Create Sub Bidang BAHAN BINAAN
        SubBidang::create([
            'kod' => '090101',
            'sub_bidang' => 'BAHAN BINAAN',
            'bidang_id' => 35,
        ]);
        SubBidang::create([
            'kod' => '090102',
            'sub_bidang' => 'PAIP DAN KELENGKAPAN',
            'bidang_id' => 35,
        ]);
        SubBidang::create([
            'kod' => '090199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 35,
        ]);

        // Create Kod Bidang PERALATAN KESELAMATAN JALAN RAYA
        Bidang::create([
            'id' => 36,
            'kod' => '0902',
            'bidang' => 'PERALATAN KESELAMATAN JALAN RAYA',
        ]);

        // Create Sub Bidang PERALATAN KESELAMATAN JALAN RAYA
        SubBidang::create([
            'kod' => '090201',
            'sub_bidang' => 'PERALATAN KESELAMATAN/PERABOT JALAN RAYA',
            'bidang_id' => 36,
        ]);
        SubBidang::create([
            'kod' => '090299',
            'sub_bidang' => 'PEMBUAT KESELAMATAN/PERABOT JALAN RAYA',
            'bidang_id' => 36,
        ]);

        // Create Kod Bidang PERALATAN SUKATAN DAN UKURAN
        Bidang::create([
            'id' => 37,
            'kod' => '1001',
            'bidang' => 'PERALATAN SUKATAN DAN UKURAN',
        ]);

        // Create Sub Bidang PERALATAN SUKATAN DAN UKURAN
        SubBidang::create([
            'kod' => '100101',
            'sub_bidang' => 'SEMUA PERALATAN SUKATAN/UKURAN',
            'bidang_id' => 37,
        ]);
        SubBidang::create([
            'kod' => '100199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 37,
        ]);

        // Create Kod Bidang KENDERAAN BERMOTOR DAN TIDAK BERMOTOR
        Bidang::create([
            'id' => 38,
            'kod' => '1101',
            'bidang' => 'KENDERAAN BERMOTOR DAN TIDAK BERMOTOR',
        ]);

        // Create Sub Bidang KENDERAAN BERMOTOR DAN TIDAK BERMOTOR
        SubBidang::create([
            'kod' => '110101',
            'sub_bidang' => 'BASIKAL',
            'bidang_id' => 38,
        ]);
        SubBidang::create([
            'kod' => '110102',
            'sub_bidang' => 'MOTOSIKAL',
            'bidang_id' => 38,
        ]);
        SubBidang::create([
            'kod' => '110103',
            'sub_bidang' => 'KERETA',
            'bidang_id' => 38,
        ]);
        SubBidang::create([
            'kod' => '110104',
            'sub_bidang' => 'LORI',
            'bidang_id' => 38,
        ]);
        SubBidang::create([
            'kod' => '110105',
            'sub_bidang' => 'BAS',
            'bidang_id' => 38,
        ]);
        SubBidang::create([
            'kod' => '110106',
            'sub_bidang' => 'KENDERAAN KEGUNAAN KHUSUS',
            'bidang_id' => 38,
        ]);
        SubBidang::create([
            'kod' => '110199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 38,
        ]);

        // Create Kod Bidang JENTERA BERAT
        Bidang::create([
            'id' => 39,
            'kod' => '1102',
            'bidang' => 'JENTERA BERAT',
        ]);

        // Create Sub Bidang JENTERA BERAT
        SubBidang::create([
            'kod' => '110201',
            'sub_bidang' => 'JENTERA BERAT',
            'bidang_id' => 39,
        ]);
        SubBidang::create([
            'kod' => '110202',
            'sub_bidang' => 'KREN',
            'bidang_id' => 39,
        ]);
        SubBidang::create([
            'kod' => '110203',
            'sub_bidang' => 'TRAILER DAN AKSESORI',
            'bidang_id' => 39,
        ]);
        SubBidang::create([
            'kod' => '110299',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 39,
        ]);

        // Create Kod Bidang ALAT GANTI DAN AKSESORI KENDERAAN/JENTERA  BERAT
        Bidang::create([
            'id' => 40,
            'kod' => '1103',
            'bidang' => 'ALAT GANTI DAN AKSESORI KENDERAAN/JENTERA  BERAT',
        ]);

        // Create Sub Bidang ALAT GANTI DAN AKSESORI KENDERAAN/JENTERA  BERAT
        SubBidang::create([
            'kod' => '110301',
            'sub_bidang' => 'ALAT GANTI/AKSESORI KENDERAAN',
            'bidang_id' => 40,
        ]);
        SubBidang::create([
            'kod' => '110302',
            'sub_bidang' => 'ALAT GANTI/AKSESORI JENTERA BERAT',
            'bidang_id' => 40,
        ]);
        SubBidang::create([
            'kod' => '110303',
            'sub_bidang' => 'ENJIN KENDERAAN/JENTERA BERAT',
            'bidang_id' => 40,
        ]);
        SubBidang::create([
            'kod' => '110304',
            'sub_bidang' => 'PERALATAN SERVIS DAN SELENGGARA',
            'bidang_id' => 40,
        ]);
        SubBidang::create([
            'kod' => '110399',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 40,
        ]);

        // Create Kod Bidang KENDERAAN BER REL, PERALATAN DAN ALAT GANTI
        Bidang::create([
            'id' => 41,
            'kod' => '1104',
            'bidang' => 'KENDERAAN BER REL, PERALATAN DAN ALAT GANTI',
        ]);

        // Create Sub Bidang KENDERAAN BER REL, PERALATAN DAN ALAT GANTI
        SubBidang::create([
            'kod' => '110401',
            'sub_bidang' => 'KENDERAAN BER REL DAN KERETA KABEL',
            'bidang_id' => 41,
        ]);
        SubBidang::create([
            'kod' => '110402',
            'sub_bidang' => 'LOKOMOTIF DAN TROLI ELEKTRIK',
            'bidang_id' => 41,
        ]);
        SubBidang::create([
            'kod' => '110403',
            'sub_bidang' => 'SISTEM, PERALATAN, ALAT GANTI KERETAPI DAN AKSESORI',
            'bidang_id' => 41,
        ]);
        SubBidang::create([
            'kod' => '110499',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 41,
        ]);

        // Create Kod Bidang PESAWAT UDARA, KAPAL TERBANG, KAPAL ANGKASA, SATELIT, RADAR
        Bidang::create([
            'id' => 42,
            'kod' => '1105',
            'bidang' => 'PESAWAT UDARA, KAPAL TERBANG, KAPAL ANGKASA, SATELIT, RADAR',
        ]);

        // Create Sub Bidang PESAWAT UDARA, KAPAL TERBANG, KAPAL ANGKASA, SATELIT, RADAR
        SubBidang::create([
            'kod' => '110501',
            'sub_bidang' => 'PESAWAT UDARA',
            'bidang_id' => 42,
        ]);
        SubBidang::create([
            'kod' => '110502',
            'sub_bidang' => 'HELIKOPTER',
            'bidang_id' => 42,
        ]);
        SubBidang::create([
            'kod' => '110503',
            'sub_bidang' => 'ALAT GANTI DAN KELENGKAPAN PESAWAT/ HELIKOPTER',
            'bidang_id' => 42,
        ]);
        SubBidang::create([
            'kod' => '110504',
            'sub_bidang' => 'KAPAL ANGKASA DAN ALATGANTI',
            'bidang_id' => 42,
        ]);
        SubBidang::create([
            'kod' => '110505',
            'sub_bidang' => 'SATELIT DAN ALATGANTI',
            'bidang_id' => 42,
        ]);
        SubBidang::create([
            'kod' => '110506',
            'sub_bidang' => 'RADAR DAN ALATGANTI',
            'bidang_id' => 42,
        ]);
        SubBidang::create([
            'kod' => '110507',
            'sub_bidang' => 'SIMULATOR',
            'bidang_id' => 42,
        ]);
        SubBidang::create([
            'kod' => '110599',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 42,
        ]);

        // Create Kod Bidang BOT DAN KAPAL
        Bidang::create([
            'id' => 43,
            'kod' => '1106',
            'bidang' => 'BOT DAN KAPAL',
        ]);

        // Create Sub Bidang BOT DAN KAPAL
        SubBidang::create([
            'kod' => '110601',
            'sub_bidang' => 'BOT',
            'bidang_id' => 43,
        ]);
        SubBidang::create([
            'kod' => '110602',
            'sub_bidang' => 'KAPAL LAUT/KAPAL SELAM',
            'bidang_id' => 43,
        ]);
        SubBidang::create([
            'kod' => '110603',
            'sub_bidang' => 'ALAT GANTI DAN KELENGKAPAN BOT/KAPAL/KAPAL SELAM',
            'bidang_id' => 43,
        ]);
        SubBidang::create([
            'kod' => '110604',
            'sub_bidang' => 'SIMULATOR BOT /KAPAL/KAPAL SELAM',
            'bidang_id' => 43,
        ]);
        SubBidang::create([
            'kod' => '110699',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 43,
        ]);

        // Create Kod Bidang PERALATAN MARIN
        Bidang::create([
            'id' => 44,
            'kod' => '1107',
            'bidang' => 'PERALATAN MARIN',
        ]);

        // Create Sub Bidang PERALATAN MARIN
        SubBidang::create([
            'kod' => '110701',
            'sub_bidang' => 'PERALATAN MARIN',
            'bidang_id' => 44,
        ]);
        SubBidang::create([
            'kod' => '110799',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 44,
        ]);

        // Create Kod Bidang SENJATA, PELURU, BAHAN LETUPAN DAN AKSESORI
        Bidang::create([
            'id' => 45,
            'kod' => '1201',
            'bidang' => 'SENJATA, PELURU, BAHAN LETUPAN DAN AKSESORI',
        ]);

        // Create Sub Bidang SENJATA, PELURU, BAHAN LETUPAN DAN AKSESORI
        SubBidang::create([
            'kod' => '120101',
            'sub_bidang' => 'SENJATA API',
            'bidang_id' => 45,
        ]);
        SubBidang::create([
            'kod' => '120102',
            'sub_bidang' => 'PELURU DAN BOM',
            'bidang_id' => 45,
        ]);
        SubBidang::create([
            'kod' => '120103',
            'sub_bidang' => 'AKSESORI SENJATA API',
            'bidang_id' => 45,
        ]);
        SubBidang::create([
            'kod' => '120104',
            'sub_bidang' => 'BAHAN LETUPAN/COMPLETE ROUNDS',
            'bidang_id' => 45,
        ]);
        SubBidang::create([
            'kod' => '120199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 45,
        ]);

        // Create Kod Bidang KELENGKAPAN SASARAN
        Bidang::create([
            'id' => 46,
            'kod' => '1202',
            'bidang' => 'KELENGKAPAN SASARAN',
        ]);

        // Create Sub Bidang KELENGKAPAN SASARAN
        SubBidang::create([
            'kod' => '120201',
            'sub_bidang' => 'KELENGKAPAN SASARAN',
            'bidang_id' => 46,
        ]);
        SubBidang::create([
            'kod' => '120299',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 46,
        ]);

        // Create Kod Bidang MISIL, ROKET DAN SUB-SISTEM
        Bidang::create([
            'id' => 47,
            'kod' => '1203',
            'bidang' => 'MISIL, ROKET DAN SUB-SISTEM',
        ]);

        // Create Sub Bidang MISIL, ROKET DAN SUB-SISTEM
        SubBidang::create([
            'kod' => '120301',
            'sub_bidang' => 'PELURU BERPANDU',
            'bidang_id' => 47,
        ]);
        SubBidang::create([
            'kod' => '120302',
            'sub_bidang' => 'SUB SISTEM ROKET',
            'bidang_id' => 47,
        ]);
        SubBidang::create([
            'kod' => '120303',
            'sub_bidang' => 'PELANCAR MISIL DAN ROKET',
            'bidang_id' => 47,
        ]);
        SubBidang::create([
            'kod' => '120399',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 47,
        ]);

        // Create Kod Bidang PERALATAN KESELAMATAN DAN PENGUATKUASAAN
        Bidang::create([
            'id' => 48,
            'kod' => '1204',
            'bidang' => 'PERALATAN KESELAMATAN DAN PENGUATKUASAAN',
        ]);

        // Create Sub Bidang PERALATAN KESELAMATAN DAN PENGUATKUASAAN
        SubBidang::create([
            'kod' => '120401',
            'sub_bidang' => 'ALAT KESELAMATAN, PERLINDUNGAN DAN KAWALAN PERLINDUNGAN DAN KAWALAN',
            'bidang_id' => 48,
        ]);
        SubBidang::create([
            'kod' => '120402',
            'sub_bidang' => 'ALAT FORENSIK DAN AKSESORI',
            'bidang_id' => 48,
        ]);
        SubBidang::create([
            'kod' => '120499',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 48,
        ]);

        // Create Kod Bidang PENGESANAN, PEMANTAUAN DAN PERLINDUNGAN
        Bidang::create([
            'id' => 49,
            'kod' => '1205',
            'bidang' => 'PENGESANAN, PEMANTAUAN DAN PERLINDUNGAN',
        ]);

        // Create Sub Bidang PENGESANAN, PEMANTAUAN DAN PERLINDUNGAN
        SubBidang::create([
            'kod' => '120501',
            'sub_bidang' => 'KUNCI, PERKAKASAN PERLINDUNGAN DAN AKSESORI',
            'bidang_id' => 49,
        ]);
        SubBidang::create([
            'kod' => '120502',
            'sub_bidang' => 'PERALATAN PEMANTAUAN DAN PENGESANAN',
            'bidang_id' => 49,
        ]);
        SubBidang::create([
            'kod' => '120503',
            'sub_bidang' => 'LESEN/PENGENALAN DAN PAS KESELAMATAN BERSALUT (LAMINATED)',
            'bidang_id' => 49,
        ]);
        SubBidang::create([
            'kod' => '120599',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 49,
        ]);

        // Create Kod Bidang PERLINDUNGAN KEBAKARAN
        Bidang::create([
            'id' => 50,
            'kod' => '1206',
            'bidang' => 'PERLINDUNGAN KEBAKARAN',
        ]);

        // Create Sub Bidang PERLINDUNGAN KEBAKARAN
        SubBidang::create([
            'kod' => '120601',
            'sub_bidang' => 'SISTEM PENCEGAH KEBAKARAN',
            'bidang_id' => 50,
        ]);
        SubBidang::create([
            'kod' => '120602',
            'sub_bidang' => 'PERALATAN KAWALAN API',
            'bidang_id' => 50,
        ]);
        SubBidang::create([
            'kod' => '120699',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 50,
        ]);

        // Create Kod Bidang MESIN, KELENGKAPAN BENGKEL DAN MESIN PENGELUARAN
        Bidang::create([
            'id' => 51,
            'kod' => '1301',
            'bidang' => 'MESIN, KELENGKAPAN BENGKEL DAN MESIN PENGELUARAN',
        ]);

        // Create Sub Bidang MESIN, KELENGKAPAN BENGKEL DAN MESIN PENGELUARAN
        SubBidang::create([
            'kod' => '130101',
            'sub_bidang' => 'MESIN DAN KELENGKAPAN BENGKEL',
            'bidang_id' => 51,
        ]);
        SubBidang::create([
            'kod' => '130102',
            'sub_bidang' => 'MESIN DAN KELENGKAPAN KHUSUS',
            'bidang_id' => 51,
        ]);
        SubBidang::create([
            'kod' => '130199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 51,
        ]);

         // Create Kod Bidang JANAKUASA ELEKTRIK DAN PERALATAN GENERATOR/ALAT GANTI DAN BATERI
         Bidang::create([
            'id' => 52,
            'kod' => '1302',
            'bidang' => 'JANAKUASA ELEKTRIK DAN PERALATAN GENERATOR/ALAT GANTI DAN BATERI',
        ]);

        // Create Sub Bidang JANAKUASA ELEKTRIK DAN PERALATAN GENERATOR/ALAT GANTI DAN BATERI
        SubBidang::create([
            'kod' => '130201',
            'sub_bidang' => 'JANAKUASA, PERALATAN/ALAT GANTI/AKSESORI (SECONDARY)',
            'bidang_id' => 52,
        ]);
        SubBidang::create([
            'kod' => '130202',
            'sub_bidang' => 'MESIN DAN KELENGKAPAN KHUSUS',
            'bidang_id' => 52,
        ]);
        SubBidang::create([
            'kod' => '130299',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 52,
        ]);

         // Create Kod Bidang SISTEM KUMBAHAN
         Bidang::create([
            'id' => 53,
            'kod' => '1303',
            'bidang' => 'SISTEM KUMBAHAN',
        ]);

        // Create Sub Bidang SISTEM KUMBAHAN
        SubBidang::create([
            'kod' => '130301',
            'sub_bidang' => 'PERALATAN SISTEM KUMBAHAN DAN AKSESORI',
            'bidang_id' => 53,
        ]);
        SubBidang::create([
            'kod' => '130399',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 53,
        ]);

        // Create Kod Bidang PERALATAN PERINDUSTRIAN MINYAK
        Bidang::create([
            'id' => 54,
            'kod' => '1304',
            'bidang' => 'PERALATAN PERINDUSTRIAN MINYAK',
        ]);

        // Create Sub Bidang PERALATAN PERINDUSTRIAN MINYAK
        SubBidang::create([
            'kod' => '130401',
            'sub_bidang' => 'PERALATAN PERINDUSTRIAN HULUAN',
            'bidang_id' => 54,
        ]);
        SubBidang::create([
            'kod' => '130402',
            'sub_bidang' => 'PERALATAN PERINDUSTRIAN HILIRAN',
            'bidang_id' => 54,
        ]);
        SubBidang::create([
            'kod' => '130499',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 54,
        ]);

        // Create Kod Bidang MESIN DAN JENTERA PENJANAAN DAN PENGAGIHAN TENAGA ELEKTRIK SERTA AKSESORI
        Bidang::create([
            'id' => 55,
            'kod' => '1401',
            'bidang' => 'MESIN DAN JENTERA PENJANAAN DAN PENGAGIHAN TENAGA ELEKTRIK SERTA AKSESORI',
        ]);

        // Create Sub Bidang MESIN DAN JENTERA PENJANAAN DAN PENGAGIHAN TENAGA ELEKTRIK SERTA AKSESORI
        SubBidang::create([
            'kod' => '140101',
            'sub_bidang' => 'MOTOR DAN ALAT UBAH/ALAT GANTI',
            'bidang_id' => 55,
        ]);
        SubBidang::create([
            'kod' => '140102',
            'sub_bidang' => 'ENJIN, KOMPONEN ENJIN DAN AKSESORI',
            'bidang_id' => 55,
        ]);
        SubBidang::create([
            'kod' => '140103',
            'sub_bidang' => 'KOMPONEN ENJIN PEMBAKARAN DALAMAN/GAS TURBINE',
            'bidang_id' => 55,
        ]);
        SubBidang::create([
            'kod' => '140199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 55,
        ]);

        // Create Kod Bidang STESEN JANAKUASA ELEKTRIK DAN PERALATAN GENERATOR/ALAT GANTI DAN BATERI
        Bidang::create([
            'id' => 56,
            'kod' => '1402',
            'bidang' => 'STESEN JANAKUASA ELEKTRIK DAN PERALATAN GENERATOR/ALAT GANTI DAN BATERI',
        ]);

        // Create Sub Bidang STESEN JANAKUASA ELEKTRIK DAN PERALATAN GENERATOR/ALAT GANTI DAN BATERI
        SubBidang::create([
            'kod' => '140201',
            'sub_bidang' => 'STESEN JANAKUASA, PERALATAN/ALAT GANTI/AKSESORI (PRIMARY)',
            'bidang_id' => 56,
        ]);
        SubBidang::create([
            'kod' => '140202',
            'sub_bidang' => 'PENJANA KUASA',
            'bidang_id' => 56,
        ]);
        SubBidang::create([
            'kod' => '140203',
            'sub_bidang' => 'ALAT PENYIMPAN TENAGA DAN AKSESORI',
            'bidang_id' => 56,
        ]);
        SubBidang::create([
            'kod' => '140299',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 56,
        ]);

        // Create Kod Bidang KABEL, WAYAR ELEKTRIK DAN AKSESORI
        Bidang::create([
            'id' => 57,
            'kod' => '1403',
            'bidang' => 'KABEL, WAYAR ELEKTRIK DAN AKSESORI',
        ]);

        // Create Sub Bidang KABEL, WAYAR ELEKTRIK DAN AKSESORI
        SubBidang::create([
            'kod' => '140301',
            'sub_bidang' => 'KABEL ELEKTRIK DAN AKSESORI',
            'bidang_id' => 57,
        ]);
        SubBidang::create([
            'kod' => '140302',
            'sub_bidang' => 'WAYAR ELEKTRIK DAN AKSESORI',
            'bidang_id' => 57,
        ]);
        SubBidang::create([
            'kod' => '140399',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 57,
        ]);

        // Create Kod Bidang PERALATAN UNTUK TENAGA ATOM DAN NUKLEAR
        Bidang::create([
            'id' => 58,
            'kod' => '1404',
            'bidang' => 'PERALATAN UNTUK TENAGA ATOM DAN NUKLEAR',
        ]);

        // Create Sub Bidang PERALATAN UNTUK TENAGA ATOM DAN NUKLEAR
        SubBidang::create([
            'kod' => '140401',
            'sub_bidang' => 'REAKTOR DAN INSTRUMEN NUKLEAR',
            'bidang_id' => 58,
        ]);
        SubBidang::create([
            'kod' => '140499',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 58,
        ]);

        // Create Kod Bidang SISTEM, KOMPONEN ELEKTRIK, ELEKTRONIK, LAMPU DAN AKSESORI
        Bidang::create([
            'id' => 59,
            'kod' => '1405',
            'bidang' => 'SISTEM, KOMPONEN ELEKTRIK, ELEKTRONIK, LAMPU DAN AKSESORI',
        ]);

        // Create Sub Bidang SISTEM, KOMPONEN ELEKTRIK, ELEKTRONIK, LAMPU DAN AKSESORI
        SubBidang::create([
            'kod' => '140501',
            'sub_bidang' => 'SISTEM ELEKTRONIK',
            'bidang_id' => 59,
        ]);
        SubBidang::create([
            'kod' => '140502',
            'sub_bidang' => 'KOMPONEN DAN AKSESORI ELEKTRIK/ ELEKTRONIK',
            'bidang_id' => 59,
        ]);
        SubBidang::create([
            'kod' => '140503',
            'sub_bidang' => 'LAMPU, KOMPONEN LAMPU DAN AKSESORI',
            'bidang_id' => 59,
        ]);
        SubBidang::create([
            'kod' => '140599',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 59,
        ]);

        // Create Kod Bidang PERALATAN DAN KELENGKAPAN KOMPUTER, PERKAKASAN DAN KOMPONEN
        Bidang::create([
            'id' => 60,
            'kod' => '2101',
            'bidang' => 'PERALATAN DAN KELENGKAPAN KOMPUTER, PERKAKASAN DAN KOMPONEN',
        ]);

        // Create Sub Bidang PERALATAN DAN KELENGKAPAN KOMPUTER, PERKAKASAN DAN KOMPONEN
        SubBidang::create([
            'kod' => '210101',
            'sub_bidang' => 'HARDWARE (LOW END TECHNOLOGY) -SUPPLY ALL TYPES OF COMPUTER HARDWARE INCLUDING PC, NOTEBOOK, PRINTER, DOCUMENT SCANNER, PERIPHERALS AND MAINTENANCE',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210102',
            'sub_bidang' => 'HARDWARE (HIGH END TECHNOLOGY) - ALL TYPES OF SERVER, MAINFRAME, HIGH END PRINTERS, STORAGE AREA NETWORK (SAN, NAS) INCLUDING MAINTENANCE',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210103',
            'sub_bidang' => 'SOFTWARE – SUPPLY ALL COMPUTER SOFTWARE, OPERATING SYSTEM, DATABASE, OFF-THE- SHELF PACKAGES INCLUDING MAINTENANCE',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210104',
            'sub_bidang' => 'SOFTWARE/SYSTEM DEVELOPMENT/CUSTOMIZATION AND MAINTENANCE INCLUDING DATA ENTRY, DATA PROCESSING',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210105',
            'sub_bidang' => 'TELECOMMUNICATION/NETWORKING-SUPPLY PRODUCT, INFRASTRUCTURE, SERVICES INCLUDING MAINTENANCE (LAN/WAN/INTERNET/WIRELESS/SATELLITE)',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210106',
            'sub_bidang' => 'DATA MANAGEMENT – PROVIDE SERVICES INCLUDING DISASTER',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210107',
            'sub_bidang' => 'ICT SECURITY AND FIREWALL, ENCRYPTION, PKI, ANTI VIRUS',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210108',
            'sub_bidang' => 'MULTIMEDIA-PRODUCTS,  SERVICES AND MAINTENANCE (VIDEO CONFERENCING, WEB CAST, GRAPHIC DESIGN, ANIMATION)',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210109',
            'sub_bidang' => 'HARDWARE AND SOFTWARE LEASING/RENTING',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210110',
            'sub_bidang' => 'GEOGRAPHIC INFORMATION SYSTEM (GIS) AND SERVICES',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210111',
            'sub_bidang' => 'INDEPENDENT VERIFICATION AND VALIDATION (IV&V)',
            'bidang_id' => 60,
        ]);
        SubBidang::create([
            'kod' => '210199',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 60,
        ]);

        // Create Kod Bidang PERALATAN DAN KELENGKAPAN TELEKOMUNIKASI
        Bidang::create([
            'id' => 61,
            'kod' => '2102',
            'bidang' => 'PERALATAN DAN KELENGKAPAN TELEKOMUNIKASI',
        ]);

        // Create Sub Bidang PERALATAN DAN KELENGKAPAN TELEKOMUNIKASI
        SubBidang::create([
            'kod' => '210201',
            'sub_bidang' => 'ALAT PERHUBUNGAN',
            'bidang_id' => 61,
        ]);
        SubBidang::create([
            'kod' => '210202',
            'sub_bidang' => 'SISTEM PERHUBUNGAN/TELEKOMUNIKASI',
            'bidang_id' => 61,
        ]);
        SubBidang::create([
            'kod' => '210203',
            'sub_bidang' => 'AKSESORI PENGHUBUNG DAN TELEKOMUNIKASI',
            'bidang_id' => 61,
        ]);
        SubBidang::create([
            'kod' => '210299',
            'sub_bidang' => 'PEMBUAT',
            'bidang_id' => 61,
        ]);

        // Create Kod Bidang PENYELENGGARAAN DAN PEMBAIKAN KENDERAAN
        Bidang::create([
            'id' => 62,
            'kod' => '2201',
            'bidang' => 'Bidang PENYELENGGARAAN DAN PEMBAIKAN KENDERAAN',
        ]);

        // Create Sub Bidang Bidang PENYELENGGARAAN DAN PEMBAIKAN KENDERAAN
        SubBidang::create([
            'kod' => '220101',
            'sub_bidang' => 'BASIKAL (TIDAK PERLU LAWATAN PENGESAHAN)',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220102',
            'sub_bidang' => 'MOTOSIKAL',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220103',
            'sub_bidang' => 'KENDERAAN KEGUNAAN KHUSUS (SEPERTI KENDERAAN REKREASI)',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220104',
            'sub_bidang' => 'KENDERAAN BAWAH 3 TON',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220105',
            'sub_bidang' => 'KENDERAAN MELEBIHI 3TON',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220106',
            'sub_bidang' => 'JENTERA BERAT (LORI PELARIK TANAH, ROLLER DAN FORKLIFT)',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220107',
            'sub_bidang' => 'KERJA-KERJA KHUSUS (BAIKPULIH ENJIN) DAN SEBAGAINYA',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220108',
            'sub_bidang' => 'KERJA-KERJA MENGETUK DAN MENGECAT',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220109',
            'sub_bidang' => 'ALAT HAWA DINGIN KENDERAAN',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220110',
            'sub_bidang' => 'MEMBAIK PULIH TEMPAT DUDUK/KUSYEN DAN BUMBUNG',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220111',
            'sub_bidang' => 'KERJA-KERJA PEMBAIKAN KENDERAAN BER REL DAN KERETA KABEL',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220112',
            'sub_bidang' => 'KERJA-KERJA PENYELENGGARAAN SISTEM KENDERAAN',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220113',
            'sub_bidang' => 'MEMBAIK PULIH TAYAR (TIDAK PERLU LAWATAN PENGESAHAN)',
            'bidang_id' => 62,
        ]);
        SubBidang::create([
            'kod' => '220114',
            'sub_bidang' => 'MEMBAIK PULIH BATERI (TIDAK PERLU LAWATAN PENGESAHAN)',
            'bidang_id' => 62,
        ]);

        // Create Kod Bidang PENYELENGGARAAN/PEMBAIKAN MESIN, PERABOT PEJABAT/KEDIAMAN
        Bidang::create([
            'id' => 63,
            'kod' => '2202',
            'bidang' => 'PENYELENGGARAAN/PEMBAIKAN MESIN, PERABOT PEJABAT/KEDIAMAN',
        ]);

        // Create Sub Bidang PENYELENGGARAAN/PEMBAIKAN MESIN, PERABOT PEJABAT/KEDIAMAN
        SubBidang::create([
            'kod' => '220201',
            'sub_bidang' => 'MESIN-MESIN PEJABAT/KEDIAMAN',
            'bidang_id' => 63,
        ]);
        SubBidang::create([
            'kod' => '220202',
            'sub_bidang' => 'PERABOT PEJABAT/KEDIAMAN',
            'bidang_id' => 63,
        ]);
        SubBidang::create([
            'kod' => '220203',
            'sub_bidang' => 'ALAT MUZIK, KESENIAN DAN AKSESORI',
            'bidang_id' => 63,
        ]);

        // Create Kod Bidang PENYELENGGARAAN/PEMBAIKAN ALAT HAWA DINGIN
        Bidang::create([
            'id' => 64,
            'kod' => '2203',
            'bidang' => 'PENYELENGGARAAN/PEMBAIKAN ALAT HAWA DINGIN',
        ]);

        // Create Sub Bidang PENYELENGGARAAN/PEMBAIKAN ALAT HAWA DINGIN
        SubBidang::create([
            'kod' => '220301',
            'sub_bidang' => 'ALAT HAWA DINGIN (WINDOW/SPLIT/BERPUSAT)',
            'bidang_id' => 64,
        ]);

        // Create Kod Bidang PENYELENGGARAAN/PEMBAIKAN ALAT KESELAMATAN
        Bidang::create([
            'id' => 65,
            'kod' => '2204',
            'bidang' => 'PENYELENGGARAAN/PEMBAIKAN ALAT KESELAMATAN',
        ]);

        // Create Sub Bidang PENYELENGGARAAN/PEMBAIKAN ALAT KESELAMATAN
        SubBidang::create([
            'kod' => '220401',
            'sub_bidang' => 'ALAT KEBOMBAAN/ALAT PENYELAMAT/PEMADAM  API',
            'bidang_id' => 65,
        ]);
        SubBidang::create([
            'kod' => '220402',
            'sub_bidang' => 'PERALATAN KAWALAN KESELAMATAN',
            'bidang_id' => 65,
        ]);
        SubBidang::create([
            'kod' => '220403',
            'sub_bidang' => 'MESIN PENGIMBAS',
            'bidang_id' => 65,
        ]);

        // Create Kod Bidang PENYELENGGARAAN/PEMBAIKAN KEJURUTERAAN DAN KOMUNIKASI
        Bidang::create([
            'id' => 66,
            'kod' => '2205',
            'bidang' => 'PENYELENGGARAAN/PEMBAIKAN KEJURUTERAAN DAN KOMUNIKASI',
        ]);

        // Create Sub Bidang PENYELENGGARAAN/PEMBAIKAN KEJURUTERAAN DAN KOMUNIKASI
        SubBidang::create([
            'kod' => '220501',
            'sub_bidang' => 'ALAT SEMBOYAN/PERHUBUNGAN/PENYIARAN',
            'bidang_id' => 66,
        ]);
        SubBidang::create([
            'kod' => '220502',
            'sub_bidang' => 'KONTENA/TANGKI',
            'bidang_id' => 66,
        ]);
        SubBidang::create([
            'kod' => '220503',
            'sub_bidang' => 'PERKAKAS/SISTEM ELEKTRIK',
            'bidang_id' => 66,
        ]);
        SubBidang::create([
            'kod' => '220504',
            'sub_bidang' => 'MESIN DAN PERALATAN WOKSYOP',
            'bidang_id' => 66,
        ]);
        SubBidang::create([
            'kod' => '220505',
            'sub_bidang' => 'MECHANISATION SYSTEM',
            'bidang_id' => 66,
        ]);
        SubBidang::create([
            'kod' => '220506',
            'sub_bidang' => 'MEMBAIKI BUFF FUEL TANK',
            'bidang_id' => 66,
        ]);
        SubBidang::create([
            'kod' => '220507',
            'sub_bidang' => 'PUMP/PAIP AIR DAN KOMPONEN',
            'bidang_id' => 66,
        ]);
        SubBidang::create([
            'kod' => '220508',
            'sub_bidang' => 'BAIKPULIH BARANG-BARANG LOGAM',
            'bidang_id' => 66,
        ]);
        SubBidang::create([
            'kod' => '220509',
            'sub_bidang' => 'PRODUCTION TESTING, SURFACE WELL TESTING AND WIRE LINE SERVICES',
            'bidang_id' => 66,
        ]);
        SubBidang::create([
            'kod' => '220510',
            'sub_bidang' => 'FAKSIMILI',
            'bidang_id' => 66,
        ]);

        // Create Kod Bidang PENYELENGGARAAN/PEMBAIKAN PERALATAN/KELENGKAPAN  PERUBATAN DAN MAKMAL
        Bidang::create([
            'id' => 67,
            'kod' => '2206',
            'bidang' => 'PENYELENGGARAAN/PEMBAIKAN PERALATAN/KELENGKAPAN  PERUBATAN DAN MAKMAL',
        ]);

        // Create Sub Bidang PENYELENGGARAAN/PEMBAIKAN PERALATAN/KELENGKAPAN  PERUBATAN DAN MAKMAL
        SubBidang::create([
            'kod' => '220601',
            'sub_bidang' => 'ALAT KELENGKAPAN PERUBATAN/MAKMAL',
            'bidang_id' => 67,
        ]);
        SubBidang::create([
            'kod' => '220602',
            'sub_bidang' => 'MESIN DAN PERALATAN MAKMAL',
            'bidang_id' => 67,
        ]);

        // Create Kod Bidang PENYELENGGARAAN/PEMBAIKAN BOT/KAPAL, HELIKOPTER, SIMULATOR DAN PESAWAT
        Bidang::create([
            'id' => 68,
            'kod' => '2207',
            'bidang' => 'PENYELENGGARAAN/PEMBAIKAN BOT/KAPAL, HELIKOPTER, SIMULATOR DAN PESAWAT',
        ]);

        // Create Sub Bidang PENYELENGGARAAN/PEMBAIKAN BOT/KAPAL, HELIKOPTER, SIMULATOR DAN PESAWAT
        SubBidang::create([
            'kod' => '220701',
            'sub_bidang' => 'BOT/KAPAL/BARGE/KAPAL  SELAM /JET SKI/SAMPAN (LIMBUNGAN/TANPA LIMBUNGAN)',
            'bidang_id' => 68,
        ]);
        SubBidang::create([
            'kod' => '220702',
            'sub_bidang' => 'SAND BLASTING DAN MENGECAT UNTUK KAPAL (TIDAK PERLU LAWATAN PENGESAHAN)',
            'bidang_id' => 68,
        ]);
        SubBidang::create([
            'kod' => '220703',
            'sub_bidang' => 'PENYELENGGARAAN KAPAL TERBANG',
            'bidang_id' => 68,
        ]);
        SubBidang::create([
            'kod' => '220704',
            'sub_bidang' => 'PENYELENGGARAAN HELIKOPTER',
            'bidang_id' => 68,
        ]);
        SubBidang::create([
            'kod' => '220705',
            'sub_bidang' => 'PENYELENGGARAAN SIMULATOR KAPAL',
            'bidang_id' => 68,
        ]);
        SubBidang::create([
            'kod' => '220706',
            'sub_bidang' => 'PENYELENGGARAAN SIMULATOR KAPAL TERBANG',
            'bidang_id' => 68,
        ]);
        SubBidang::create([
            'kod' => '220707',
            'sub_bidang' => 'PENYELENGGARAAN SIMULATOR HELIKOPTER',
            'bidang_id' => 68,
        ]);
        SubBidang::create([
            'kod' => '220708',
            'sub_bidang' => 'PEMBAIKAN KENDERAAN YANG TIDAK BERENJIN',
            'bidang_id' => 68,
        ]);
        SubBidang::create([
            'kod' => '220709',
            'sub_bidang' => 'KERJA PEMBAIKAN KAPAL ANGKASA/SATELIT ',
            'bidang_id' => 68,
        ]);
        SubBidang::create([
            'kod' => '220710',
            'sub_bidang' => 'ALAT-ALAT MARIN (TIDAK TERMASUK BOT/KAPAL)',
            'bidang_id' => 68,
        ]);

        // Create Kod Bidang KAWALAN KESELAMATAN (PERLU LESEN KDN)
        Bidang::create([
            'id' => 69,
            'kod' => '2208',
            'bidang' => 'KAWALAN KESELAMATAN (PERLU LESEN KDN)',
        ]);

        // Create Sub Bidang KAWALAN KESELAMATAN (PERLU LESEN KDN)
        SubBidang::create([
            'kod' => '220801',
            'sub_bidang' => 'KAWALAN KESELAMATAN (PERLU LESEN KDN)',
            'bidang_id' => 69,
        ]);
        SubBidang::create([
            'kod' => '220802',
            'sub_bidang' => 'PENYIASAT PERSENDIRIAN (PERLU LESEN KDN)',
            'bidang_id' => 69,
        ]);
        SubBidang::create([
            'kod' => '220803',
            'sub_bidang' => 'PENYELENGGARAN DAN PEMBAIKAN SENJATA',
            'bidang_id' => 69,
        ]);
        SubBidang::create([
            'kod' => '220804',
            'sub_bidang' => 'PENYELENGGARAAN MISIL/ ROKET DAN SUB SISTEM, PELANCAR',
            'bidang_id' => 69,
        ]);

        // Create Kod Bidang PENGAWALAN DAN PENGAWASAN
        Bidang::create([
            'id' => 70,
            'kod' => '2209',
            'bidang' => 'PENGAWALAN DAN PENGAWASAN',
        ]);

        // Create Sub Bidang PENGAWALAN DAN PENGAWASAN
        SubBidang::create([
            'kod' => '220901',
            'sub_bidang' => 'KAWALAN SERANGGA PEROSAK, ANTI TERMITE (PERLU LESEN PENGENDALI KAWALAN MAKHLUK PEROSAK DARI JABATAN PERTANIAN)',
            'bidang_id' => 70,
        ]);
        SubBidang::create([
            'kod' => '220902',
            'sub_bidang' => 'MENANGKAP/MENEMBAK  HAIWAN',
            'bidang_id' => 70,
        ]);

        // Create Kod Bidang KHIDMAT KEBERSIHAN DAN RAWATAN
        Bidang::create([
            'id' => 71,
            'kod' => '2210',
            'bidang' => 'KHIDMAT KEBERSIHAN DAN RAWATAN',
        ]);

        // Create Sub Bidang KHIDMAT KEBERSIHAN DAN RAWATAN
        SubBidang::create([
            'kod' => '221001',
            'sub_bidang' => 'PEMBERSIHAN BANGUNAN DAN PEJABAT',
            'bidang_id' => 71,
        ]);
        SubBidang::create([
            'kod' => '221002',
            'sub_bidang' => 'MEMBERSIH KAWASAN',
            'bidang_id' => 71,
        ]);
        SubBidang::create([
            'kod' => '221003',
            'sub_bidang' => 'MENGANGKAT SAMPAH',
            'bidang_id' => 71,
        ]);
        SubBidang::create([
            'kod' => '221004',
            'sub_bidang' => 'MEMBERSIH KENDERAAN (PERLU LESEN PBT)',
            'bidang_id' => 71,
        ]);
        SubBidang::create([
            'kod' => '221005',
            'sub_bidang' => 'MENCUCI KOLAM RENANG',
            'bidang_id' => 71,
        ]);
        SubBidang::create([
            'kod' => '221006',
            'sub_bidang' => 'MEMBERSIH PANTAI/SUNGAI/TERUSAN/EMPANGAN/TASIK',
            'bidang_id' => 71,
        ]);
        SubBidang::create([
            'kod' => '221007',
            'sub_bidang' => 'PELUPUSAN DAN PERAWATAN SISA BERBAHAYA (PERLU LESEN DARIPADA LEMBAGA PERLESENAN TENAGA ATOM (AELB))',
            'bidang_id' => 71,
        ]);
        SubBidang::create([
            'kod' => '221008',
            'sub_bidang' => 'PELUPUSAN DAN PERAWATAN BUANGAN TERJADUAL (PERLU LESEN  DARIPADA JABATAN ALAM SEKITAR)',
            'bidang_id' => 71,
        ]);
        SubBidang::create([
            'kod' => '221009',
            'sub_bidang' => 'PELUPUSAN DAN RAWATAN SISA RADIO AKTIF DAN NUKLEAR (PERLU LESEN DARIPADA LEMBAGA PERLESENAN TENAGA ATOM (AELB))',
            'bidang_id' => 71,
        ]);
        SubBidang::create([
            'kod' => '221010',
            'sub_bidang' => 'KOLAM KUMBAHAN/SISA PERAWATAN/TALIAN PAIP/SESALUR',
            'bidang_id' => 71,
        ]);
        SubBidang::create([
            'kod' => '221011',
            'sub_bidang' => 'PEMBERSIHAN TUMPAHAN MINYAK',
            'bidang_id' => 71,
        ]);

        // Create Kod Bidang GUNA TENAGA
        Bidang::create([
            'id' => 72,
            'kod' => '2211',
            'bidang' => 'GUNA TENAGA',
        ]);

        // Create Sub Bidang GUNA TENAGA
        SubBidang::create([
            'kod' => '221101',
            'sub_bidang' => 'KAKITANGAN IKTISAS (PROFESIONAL) - TIDAK TERMASUK KHIDMAT PERUNDINGAN',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221102',
            'sub_bidang' => 'KAKITANGAN SEPARA IKTISAS (SEMI PROFESIONAL) TIDAK TERMASUK KHIDMAT PERUNDINGAN',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221103',
            'sub_bidang' => 'KHIDMAT GUAMAN',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221104',
            'sub_bidang' => 'TENAGA BURUH',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221105',
            'sub_bidang' => 'PEMUNGUT HUTANG/ PENGHANTAR NOTIS',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221106',
            'sub_bidang' => 'STEVEDOR',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221107',
            'sub_bidang' => 'TELLY CLERK',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221108',
            'sub_bidang' => 'MENGIKAT DAN MELEPAS TALI KAPAL (MOORING)',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221109',
            'sub_bidang' => 'MENYELAM (DIVING SERVICE)',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221110',
            'sub_bidang' => 'KHIDMAT LATIHAN, TENAGA PENGAJAR DAN MODERATOR/NEGOTIATOR',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221111',
            'sub_bidang' => 'SALVAGE BOAT/KAPAL',
            'bidang_id' => 72,
        ]);
        SubBidang::create([
            'kod' => '221112',
            'sub_bidang' => 'MALIM KAPAL',
            'bidang_id' => 72,
        ]);

        // Create Kod Bidang KHIDMAT UDARA/LAUT/DARAT
        Bidang::create([
            'id' => 73,
            'kod' => '2212',
            'bidang' => 'KHIDMAT UDARA/LAUT/DARAT',
        ]);

        // Create Sub Bidang KHIDMAT UDARA/LAUT/DARAT
        SubBidang::create([
            'kod' => '221201',
            'sub_bidang' => 'TOPOGRAFI/LIDAR',
            'bidang_id' => 73,
        ]);
        SubBidang::create([
            'kod' => '221202',
            'sub_bidang' => 'PEMBAJAAN/PEST CONTROL',
            'bidang_id' => 73,
        ]);
        SubBidang::create([
            'kod' => '221203',
            'sub_bidang' => 'CLOUD SEEDING',
            'bidang_id' => 73,
        ]);
        SubBidang::create([
            'kod' => '221204',
            'sub_bidang' => 'HIDROGRAFI',
            'bidang_id' => 73,
        ]);
        SubBidang::create([
            'kod' => '221205',
            'sub_bidang' => 'OCEANOGRAFI',
            'bidang_id' => 73,
        ]);
        SubBidang::create([
            'kod' => '221206',
            'sub_bidang' => 'PEMETAAN/PEMETAAN UTILITI BAWAH TANAH',
            'bidang_id' => 73,
        ]);
        SubBidang::create([
            'kod' => '221207',
            'sub_bidang' => 'GEOLOGI',
            'bidang_id' => 73,
        ]);

        // Create Kod Bidang KESENIAN, HIBURAN DAN PELANCONGAN
        Bidang::create([
            'id' => 74,
            'kod' => '2213',
            'bidang' => 'KESENIAN, HIBURAN DAN PELANCONGAN',
        ]);

        // Create Sub Bidang KESENIAN, HIBURAN DAN PELANCONGAN
        SubBidang::create([
            'kod' => '221301',
            'sub_bidang' => 'PENGELUARAN FILEM (PERLU LESEN FINAS- PENGELUAR)',
            'bidang_id' => 74,
        ]);
        SubBidang::create([
            'kod' => '221302',
            'sub_bidang' => 'RAKAMAN',
            'bidang_id' => 74,
        ]);
        SubBidang::create([
            'kod' => '221303',
            'sub_bidang' => 'FOTOGRAFI',
            'bidang_id' => 74,
        ]);
        SubBidang::create([
            'kod' => '221304',
            'sub_bidang' => 'AUDIO VISUAL',
            'bidang_id' => 74,
        ]);
        SubBidang::create([
            'kod' => '221305',
            'sub_bidang' => 'PENYEDIAAN   PENTAS/PAMERAN PERTUNJUKAN, TAMAN HIBURAN DAN KARNIVAL/PESTARIA',
            'bidang_id' => 74,
        ]);
        SubBidang::create([
            'kod' => '221306',
            'sub_bidang' => 'ARTIS DAN PENGHIBUR PROFESIONAL',
            'bidang_id' => 74,
        ]);
        SubBidang::create([
            'kod' => '221307',
            'sub_bidang' => 'AGEN PENGEMBARAAN',
            'bidang_id' => 74,
        ]);
        SubBidang::create([
            'kod' => '221308',
            'sub_bidang' => 'DOKUMENTASI DAN PANDUARAH',
            'bidang_id' => 74,
        ]);
        SubBidang::create([
            'kod' => '221309',
            'sub_bidang' => 'PEMELIHARAAN BAHAN BAHAN SEJARAH DAN TEMPAT BERSEJARAH',
            'bidang_id' => 74,
        ]);
        SubBidang::create([
            'kod' => '221310',
            'sub_bidang' => 'PENYIMPANAN REKOD (SURAT KELULUSAN DARIPADA ARKIB NEGARA)',
            'bidang_id' => 74,
        ]);
        SubBidang::create([
            'kod' => '221311',
            'sub_bidang' => 'MEMBAIKPULIH BAHAN TERBITAN DAN MANUSKRIP (SURAT KELULUSAN DARIPADA ARKIB NEGARA)',
            'bidang_id' => 74,
        ]);

        // Create Kod Bidang PENGINDAHAN
        Bidang::create([
            'id' => 75,
            'kod' => '2214',
            'bidang' => 'PENGINDAHAN',
        ]);

        // Create Sub Bidang PENGINDAHAN
        SubBidang::create([
            'kod' => '221401',
            'sub_bidang' => 'BANGUNAN/HIASAN DALAMAN (TIDAK TERMASUK PELANSKAPAN DAN SENI TAMAN)',
            'bidang_id' => 75,
        ]);
        SubBidang::create([
            'kod' => '221402',
            'sub_bidang' => 'HIASAN JALAN/KAWASAN (TIDAK TERMASUK PELANSKAPAN DAN SENI TAMAN)',
            'bidang_id' => 75,
        ]);

        // Create Kod Bidang PENYEWAAN DAN PENGURUSAN
        Bidang::create([
            'id' => 76,
            'kod' => '2215',
            'bidang' => 'PENYEWAAN DAN PENGURUSAN',
        ]);

        // Create Sub Bidang PENYEWAAN DAN PENGURUSAN
        SubBidang::create([
            'kod' => '221501',
            'sub_bidang' => 'PERABOT/KELENGKAPAN',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221502',
            'sub_bidang' => 'MESIN DAN PERALATAN PEJABAT',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221503',
            'sub_bidang' => 'KENDERAAN/JENTERA/KENDERAAN REKREASI',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221504',
            'sub_bidang' => 'KAPAL/BOT/BOT TUNDA/FERI/BOT MALIM/BARGE/JET SKI/KAPAL SELAM',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221505',
            'sub_bidang' => 'KAPAL TERBANG/HELIKOPTER/PESAWAT/BELON PANAS/SIMULATOR SERTA LAIN-LAIN KENDERAAN UDARA',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221506',
            'sub_bidang' => 'BANGUNAN/PEJABAT/ STOR/RUANG NIAGA/RUMAH KEDIAMAN',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221507',
            'sub_bidang' => 'KEMUDAHAN AWAM/SUKAN',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221508',
            'sub_bidang' => 'PERALATAN/KELENGKAPAN HOSPITAL DAN MAKMAL',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221509',
            'sub_bidang' => 'PERALATAN KESELAMATAN DAN SENJATA',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221510',
            'sub_bidang' => 'TEMPAT LETAK KERETA',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221511',
            'sub_bidang' => 'P.A SISTEM DAN ALAT MUZIK',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221512',
            'sub_bidang' => 'BANTUAN KECEMASAN DAN AMBULAN/KENDERAAN  JENAZAH',
            'bidang_id' => 76,
        ]);
        SubBidang::create([
            'kod' => '221513',
            'sub_bidang' => 'PAKAIAN/KELENGKAPAN  DAN AKSESORI',
            'bidang_id' => 76,
        ]);

        // Create Kod Bidang PERCETAKAN (DIKHAS KEPADA SYARIKAT 100% BUMIPUTERA)
        Bidang::create([
            'id' => 77,
            'kod' => '2216',
            'bidang' => 'PERCETAKAN (DIKHAS KEPADA SYARIKAT 100% BUMIPUTERA)',
        ]);

        // Create Sub Bidang PERCETAKAN (DIKHAS KEPADA SYARIKAT 100% BUMIPUTERA)
        SubBidang::create([
            'kod' => '221601',
            'sub_bidang' => 'MENCETAK BUKU, MAJALAH, LAPORAN AKHBAR (PERLU LESEN KDN)',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221602',
            'sub_bidang' => 'MENCETAK FAIL, KAD PERNIAGAAN DAN KAD UCAPAN (PERLU LESEN KDN)',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221603',
            'sub_bidang' => 'MENCETAK LABEL, POSTER, PELEKAT DAN IRON ON (PERLU LESEN KDN)',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221604',
            'sub_bidang' => 'MENCETAK LABEL, POSTER DAN PELEKAT (PLASTIK) (PERLU LESEN KDN)',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221605',
            'sub_bidang' => 'MENCETAK CONTINUOUS STATIONERY FORMS (PERLU LESEN KDN)',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221606',
            'sub_bidang' => 'MENCETAK BORANG/KERTAS KOMPUTER (PERLU LESEN KDN)',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221607',
            'sub_bidang' => 'CETAKAN KESELAMATAN (PERLU LESEN KDN DAN SURAT KELULUSAN JPM)',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221608',
            'sub_bidang' => 'CETAKAN HOLOGRAM (PERLU LESEN KDN DAN SURAT KELULUSAN JPM)',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221609',
            'sub_bidang' => 'PISAH WARNA (COLOUR SEPARATION)',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221610',
            'sub_bidang' => 'MENJILID KULIT KERAS',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221611',
            'sub_bidang' => 'VARNISHING',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221612',
            'sub_bidang' => 'LAMINATING',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221613',
            'sub_bidang' => 'MENJILID KULIT LEMBUT',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221614',
            'sub_bidang' => 'PENGATUR HURUF (TYPE SETTING)',
            'bidang_id' => 77,
        ]);
        SubBidang::create([
            'kod' => '221615',
            'sub_bidang' => 'REKABENTUK PERCETAKAN (PRINTING DESIGN)',
            'bidang_id' => 77,
        ]);

        // Create Kod Bidang PERKHIDMATAN PENGANGKUTAN, PENYIMPANAN DAN POS
        Bidang::create([
            'id' => 78,
            'kod' => '2217',
            'bidang' => 'PERKHIDMATAN PENGANGKUTAN, PENYIMPANAN DAN POS',
        ]);

        // Create Sub Bidang PERKHIDMATAN PENGANGKUTAN, PENYIMPANAN DAN POS
        SubBidang::create([
            'kod' => '221701',
            'sub_bidang' => 'PEMILIK KAPAL (PERLU SIJIL MCR)',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221702',
            'sub_bidang' => 'BROKER PERKAPALAN (PERJANJIAN DRPD SYARIKAT PERKAPALAN)',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221703',
            'sub_bidang' => 'AGEN PERKAPALAN (PERLU LESEN KASTAM)',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221704',
            'sub_bidang' => 'PENGANGKUTAN LORI (PERLU LESEN SPAD)',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221705',
            'sub_bidang' => 'AGEN PENGHANTARAN (PERLU LESEN KASTAM)',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221706',
            'sub_bidang' => 'PEMBUNGKUSAN DAN PENYIMPANAN (PERLU GUDANG BERLESEN KASTAM DAN PBT)',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221707',
            'sub_bidang' => 'PEMBUNGKUSAN',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221708',
            'sub_bidang' => 'PENGHANTARAN DOKUMEN (PERLU LESEN POS)',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221709',
            'sub_bidang' => 'MULTIMODAL TRANSPORT OPERATOR (MTO)',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221710',
            'sub_bidang' => 'PERKHIDMATAN MEL PUKAL',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221711',
            'sub_bidang' => 'PENGURUSAN PELABUHAN',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221712',
            'sub_bidang' => 'SHIP CHANDLING',
            'bidang_id' => 78,
        ]);
        SubBidang::create([
            'kod' => '221713',
            'sub_bidang' => 'SHIP TRIMMING',
            'bidang_id' => 78,
        ]);

        // Create Kod Bidang PERKHIDMATAN KEWANGAN DAN INSURAN
        Bidang::create([
            'id' => 79,
            'kod' => '2218',
            'bidang' => 'PERKHIDMATAN KEWANGAN DAN INSURAN',
        ]);

        // Create Sub Bidang PERKHIDMATAN KEWANGAN DAN INSURAN
        SubBidang::create([
            'kod' => '221801',
            'sub_bidang' => 'SYARIKAT INSURAN (PERLU LESEN BANK NEGARA)',
            'bidang_id' => 79,
        ]);
        SubBidang::create([
            'kod' => '221802',
            'sub_bidang' => 'BROKER INSURAN (PERLU LESEN BANK NEGARA)',
            'bidang_id' => 79,
        ]);
        SubBidang::create([
            'kod' => '221803',
            'sub_bidang' => 'PENYEDIAAN AKAUN DAN PENGAUDITAN',
            'bidang_id' => 79,
        ]);
        SubBidang::create([
            'kod' => '221804',
            'sub_bidang' => 'PENGURUSAN KEWANGAN DAN KORPORAT',
            'bidang_id' => 79,
        ]);
        SubBidang::create([
            'kod' => '221805',
            'sub_bidang' => 'PEMFAKTORAN (DIMANSUHKAN)',
            'bidang_id' => 79,
        ]);
        SubBidang::create([
            'kod' => '221806',
            'sub_bidang' => 'SYARIKAT PELELONG AWAM (PERLU LESEN PELELONG PBT)',
            'bidang_id' => 79,
        ]);

        // Create Kod Bidang BARANG LUSUH
        Bidang::create([
            'id' => 80,
            'kod' => '2219',
            'bidang' => 'BARANG LUSUH',
        ]);

        // Create Sub Bidang BARANG LUSUH
        SubBidang::create([
            'kod' => '221901',
            'sub_bidang' => 'MEMBELI BARANG LUSUH TANPA PERMIT',
            'bidang_id' => 80,
        ]);
        SubBidang::create([
            'kod' => '221902',
            'sub_bidang' => 'MEMBELI BARANG LUSUH PERLU PERMIT PDRM',
            'bidang_id' => 80,
        ]);

        // Create Kod Bidang EDITORIAL, REKABENTUK GRAFIK, SENI HALUS DAN HARTA INTELEK
        Bidang::create([
            'id' => 81,
            'kod' => '2220',
            'bidang' => 'EDITORIAL, REKABENTUK GRAFIK, SENI HALUS DAN HARTA INTELEK',
        ]);

        // Create Sub Bidang EDITORIAL, REKABENTUK GRAFIK, SENI HALUS DAN HARTA INTELEK
        SubBidang::create([
            'kod' => '222001',
            'sub_bidang' => 'MEDIA ELEKTRONIK (TIDAK TERMASUK KERJA-KERJA PERCETAKAN)',
            'bidang_id' => 81,
        ]);
        SubBidang::create([
            'kod' => '222002',
            'sub_bidang' => 'MEDIA CETAK (TIDAK TERMASUK KERJA-KERJA PERCETAKAN)',
            'bidang_id' => 81,
        ]);
        SubBidang::create([
            'kod' => '222003',
            'sub_bidang' => 'BILL BOARD',
            'bidang_id' => 81,
        ]);
        SubBidang::create([
            'kod' => '222004',
            'sub_bidang' => 'PENULISAN - SEMUA JENIS PENULISAN',
            'bidang_id' => 81,
        ]);
        SubBidang::create([
            'kod' => '222005',
            'sub_bidang' => 'MEREKA-CIPTA DAN SENI HALUS',
            'bidang_id' => 81,
        ]);
        SubBidang::create([
            'kod' => '222006',
            'sub_bidang' => 'PENTERJEMAHAN',
            'bidang_id' => 81,
        ]);
        SubBidang::create([
            'kod' => '222007',
            'sub_bidang' => 'PENGKOMERSILAN',
            'bidang_id' => 81,
        ]);
        SubBidang::create([
            'kod' => '222008',
            'sub_bidang' => 'HAK HARTA INTELEK (PATENT)',
            'bidang_id' => 81,
        ]);
        SubBidang::create([
            'kod' => '222009',
            'sub_bidang' => 'LAIN-LAIN MEDIA PENGIKLANAN',
            'bidang_id' => 81,
        ]);
        SubBidang::create([
            'kod' => '222010',
            'sub_bidang' => 'PERKHIDMATAN FOTOSTAT',
            'bidang_id' => 81,
        ]);

        // Create Kod Bidang PERKHIDMATAN PERLADANGAN, PERIKANAN, HAIWAN DAN HIDUPAN LIAR
        Bidang::create([
            'id' => 82,
            'kod' => '2221',
            'bidang' => 'PERKHIDMATAN PERLADANGAN, PERIKANAN, HAIWAN DAN HIDUPAN LIAR',
        ]);

        // Create Sub Bidang PERKHIDMATAN PERLADANGAN, PERIKANAN, HAIWAN DAN HIDUPAN LIAR
        SubBidang::create([
            'kod' => '222101',
            'sub_bidang' => 'PERIKANAN DAN AKUAKULTUR',
            'bidang_id' => 82,
        ]);
        SubBidang::create([
            'kod' => '222102',
            'sub_bidang' => 'HORTIKULTUR',
            'bidang_id' => 82,
        ]);
        SubBidang::create([
            'kod' => '222103',
            'sub_bidang' => 'TERNAKAN',
            'bidang_id' => 82,
        ]);
        SubBidang::create([
            'kod' => '222104',
            'sub_bidang' => 'PERTANIAN/TANAMAN/LADANG/TAMAN/HUTAN DAN LADANG HUTAN',
            'bidang_id' => 82,
        ]);
        SubBidang::create([
            'kod' => '222105',
            'sub_bidang' => 'RAWATAN HUTAN',
            'bidang_id' => 82,
        ]);
        SubBidang::create([
            'kod' => '222106',
            'sub_bidang' => 'SUMBER AIR',
            'bidang_id' => 82,
        ]);
        SubBidang::create([
            'kod' => '222107',
            'sub_bidang' => 'TATAHIAS HAIWAN',
            'bidang_id' => 82,
        ]);
        SubBidang::create([
            'kod' => '222108',
            'sub_bidang' => 'TUKUN TIRUAN',
            'bidang_id' => 82,
        ]);

        // Create Kod Bidang PERKHIDMATAN HAL EHWAL SOSIAL DAN POLITIK
        Bidang::create([
            'id' => 83,
            'kod' => '2222',
            'bidang' => 'PERKHIDMATAN HAL EHWAL SOSIAL DAN POLITIK',
        ]);

        // Create Sub Bidang PERKHIDMATAN HAL EHWAL SOSIAL DAN POLITIK
        SubBidang::create([
            'kod' => '222201',
            'sub_bidang' => 'HUBUNGAN ANTARABANGSA',
            'bidang_id' => 83,
        ]);
        SubBidang::create([
            'kod' => '222202',
            'sub_bidang' => 'BANTUAN KEMANUSIAAN',
            'bidang_id' => 83,
        ]);
        SubBidang::create([
            'kod' => '222203',
            'sub_bidang' => 'DASAR DAN PERATURAN',
            'bidang_id' => 83,
        ]);

        // Create Kod Bidang PERKHIDMATAN DOMESTIK
        Bidang::create([
            'id' => 84,
            'kod' => '2223',
            'bidang' => 'PERKHIDMATAN DOMESTIK',
        ]);

        // Create Sub Bidang PERKHIDMATAN DOMESTIK
        SubBidang::create([
            'kod' => '222301',
            'sub_bidang' => 'SOLEKAN',
            'bidang_id' => 84,
        ]);
        SubBidang::create([
            'kod' => '222302',
            'sub_bidang' => 'DOBI',
            'bidang_id' => 84,
        ]);
        SubBidang::create([
            'kod' => '222303',
            'sub_bidang' => 'MEMBEKAL AIR',
            'bidang_id' => 84,
        ]);
        SubBidang::create([
            'kod' => '222304',
            'sub_bidang' => 'PENGURUSAN JENAZAH DAN KELENGKAPAN',
            'bidang_id' => 84,
        ]);
        SubBidang::create([
            'kod' => '222305',
            'sub_bidang' => 'MENGANGKUT MAYAT',
            'bidang_id' => 84,
        ]);

        // Create Kod Bidang PERKHIDMATAN MENJAHIT DAN BAIK PULIH
        Bidang::create([
            'id' => 85,
            'kod' => '2224',
            'bidang' => 'PERKHIDMATAN MENJAHIT DAN BAIK PULIH',
        ]);

        // Create Sub Bidang PERKHIDMATAN MENJAHIT DAN BAIK PULIH
        SubBidang::create([
            'kod' => '222401',
            'sub_bidang' => 'MENJAHIT PAKAIAN DAN KELENGKAPAN',
            'bidang_id' => 85,
        ]);
        SubBidang::create([
            'kod' => '222402',
            'sub_bidang' => 'MENJAHIT BUKAN PAKAIAN',
            'bidang_id' => 85,
        ]);
        SubBidang::create([
            'kod' => '222403',
            'sub_bidang' => 'BAIK PULIH KASUT DAN BARANGAN KULIT',
            'bidang_id' => 85,
        ]);
        SubBidang::create([
            'kod' => '222404',
            'sub_bidang' => 'BARANGAN PVC/KANVAS',
            'bidang_id' => 85,
        ]);
        SubBidang::create([
            'kod' => '222405',
            'sub_bidang' => 'BARANGAN LOGAM',
            'bidang_id' => 85,
        ]);

        // Create Kod Bidang HOTEL, RUMAH TUMPANGAN DAN PUSAT LATIHAN
        Bidang::create([
            'id' => 86,
            'kod' => '2225',
            'bidang' => 'HOTEL, RUMAH TUMPANGAN DAN PUSAT LATIHAN',
        ]);

        // Create Sub Bidang HOTEL, RUMAH TUMPANGAN DAN PUSAT LATIHAN
        SubBidang::create([
            'kod' => '222501',
            'sub_bidang' => 'HOTEL/RESORT (PERLU LESEN PBT DAN SIJIL HALAL)',
            'bidang_id' => 86,
        ]);
        SubBidang::create([
            'kod' => '222502',
            'sub_bidang' => 'MOTEL/CHALET/RUMAH  TUMPANGAN (PERLU LESEN PBT)',
            'bidang_id' => 86,
        ]);
        SubBidang::create([
            'kod' => '222503',
            'sub_bidang' => 'HOMESTAY (SURAT KEMENTERIAN PELANCONGAN)',
            'bidang_id' => 86,
        ]);
        SubBidang::create([
            'kod' => '222504',
            'sub_bidang' => 'PUSAT LATIHAN (LESEN PBT)',
            'bidang_id' => 86,
        ]);

        // Create Kod Bidang PERKHIDMATAN KEJURUTERAAN ELEKTRIK DAN ELEKRONIK
        Bidang::create([
            'id' => 87,
            'kod' => '2226',
            'bidang' => 'PERKHIDMATAN KEJURUTERAAN ELEKTRIK DAN ELEKRONIK',
        ]);

        // Create Sub Bidang PERKHIDMATAN KEJURUTERAAN ELEKTRIK DAN ELEKRONIK
        SubBidang::create([
            'kod' => '222601',
            'sub_bidang' => 'AKUSTIK DAN GELOMBANG',
            'bidang_id' => 87,
        ]);
        SubBidang::create([
            'kod' => '222602',
            'sub_bidang' => 'PENCAHAYAAN (ILLUMINATION) ',
            'bidang_id' => 87,
        ]);

        // Create Kod Bidang PERKHIDMATAN LAIN-LAIN
        Bidang::create([
            'id' => 88,
            'kod' => '2227',
            'bidang' => 'PERKHIDMATAN LAIN-LAIN',
        ]);

        // Create Sub Bidang PERKHIDMATAN LAIN-LAIN
        SubBidang::create([
            'kod' => '222701',
            'sub_bidang' => 'PENGURUSAN TELEKOMUNIKASI',
            'bidang_id' => 88,
        ]);
        SubBidang::create([
            'kod' => '222702',
            'sub_bidang' => 'MARKER/DNA',
            'bidang_id' => 88,
        ]);
        SubBidang::create([
            'kod' => '222703',
            'sub_bidang' => 'BIOTEKNOLOGI',
            'bidang_id' => 88,
        ]);
        SubBidang::create([
            'kod' => '222704',
            'sub_bidang' => 'PENSIJILAN DAN PENGIKTIRAFAN UJIAN',
            'bidang_id' => 88,
        ]);
        SubBidang::create([
            'kod' => '222705',
            'sub_bidang' => 'MAKMAL',
            'bidang_id' => 88,
        ]);
        SubBidang::create([
            'kod' => '222706',
            'sub_bidang' => 'KODIFIKASI',
            'bidang_id' => 88,
        ]);

        // Create Kod Bidang PERKHIDMATAN TEKNOLOGI HIJAU
        Bidang::create([
            'id' => 89,
            'kod' => '2228',
            'bidang' => 'PERKHIDMATAN TEKNOLOGI HIJAU',
        ]);

        // Create Sub Bidang PERKHIDMATAN TEKNOLOGI HIJAU
        SubBidang::create([
            'kod' => '222801',
            'sub_bidang' => 'TEKNOLOGI HIJAU (SURAT/SJIL DARIPADA SURUHANJAYA TENAGA (ENERGY COMMISSION ATAU MALAYSIA GREEN TECHNOLOGY CORPORATION)',
            'bidang_id' => 89,
        ]);

    }
}
