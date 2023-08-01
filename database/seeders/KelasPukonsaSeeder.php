<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sisdant\Models\SubKelasPukonsa;
use Modules\Sisdant\Models\KelasPukonsa;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;

class KelasPukonsaSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('kelas_pukonsa');

        // Create TAJUK 1
        KelasPukonsa::create([
            'tajuk' => 'TAJUK I',
            'keterangan' => 'KERJA-KERJA KEJURUTERAAN AWAM',
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 1',
            'keterangan' => 'KERJA KERJA AM KEJURUTERAAN AWAM',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2',
            'keterangan' => 'JAMBATAN, JETI DAN STRUKTUR KERJA LAUT',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(A)',
            'keterangan' => 'STRUKTUR PENAHAN AIR',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(A)',
            'keterangan' => 'STRUKTUR PENAHAN AIR',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(B)',
            'keterangan' => 'EMPANGAN',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 5',
            'keterangan' => 'SISTEM PEMBETUNGAN',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 6(A)',
            'keterangan' => 'PENEROWONGAN',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 6(B)',
            'keterangan' => 'DINDING, GEGENDANG DAN TAMBATAN PADA TANAH',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(A)',
            'keterangan' => 'STRUKTUR HIDRAULIK',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(B)',
            'keterangan' => 'KERJA-KERJA TANAH',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(C)',
            'keterangan' => 'KONDUIT KUASA ',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(D)',
            'keterangan' => 'RUMAH KUASA ',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 8',
            'keterangan' => 'KERJA-KERJA LANDASAN KERETA API',
            'tajuk_id' => 1,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 9',
            'keterangan' => 'PENANAMAN SESALUR DAN PEMBINAAN PETI PENYAMBUNGAN DAN/ATAU LURANG UNTUK RANGKAIAN KABEL TELEFON',
            'tajuk_id' => 1,
        ]);

        // Create TAJUK 2
        KelasPukonsa::create([
            'tajuk' => 'TAJUK II',
            'keterangan' => 'KERJA-KERJA BANGUNAN',
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 1',
            'keterangan' => 'KERJA-KERJA PEMBINAAN TIDAK TERMASUK STRUKTUR RANGKA KONKRIT BERTETULANG',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2(A)',
            'keterangan' => 'BANGUNAN RANGKA KONKRIT BERTETULANG YANG TIDAK MELEBIHI EMPAT (4) TINGKAT',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2(B)',
            'keterangan' => 'BANGUNAN RANGKA KONKRIT BERTETULANG YANG MELEBIHI EMPAT (4) TINGKAT',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3',
            'keterangan' => 'BANGUNAN KAYU PASANG SIAP',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 4',
            'keterangan' => 'BANGUNAN KONKRIT PASANG SIAP',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 5',
            'keterangan' => 'BANGUNAN RANGKA KELULI',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 6',
            'keterangan' => 'KERJA•KERJA BUMBUNG BERPATEN',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(A)',
            'keterangan' => 'LANTAI PARKET DAN BLOK KAYU',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(B)',
            'keterangan' => 'KEMASAN LANTAI DAN DINDING YANG LAIN',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(C)',
            'keterangan' => 'PERABOT BINA DALAM',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(D)',
            'keterangan' => 'PEMASANGAN TANGGAM',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 8(A)',
            'keterangan' => 'PENYELENGGARAAN SISTEM KEBERSIHAN',
            'tajuk_id' => 2,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 8(B)',
            'keterangan' => 'PENGECATAN SEMULA DAN PEMBAIKAN AM BANGUNAN',
            'tajuk_id' => 2,
        ]);

        // Create TAJUK 3
        KelasPukonsa::create([
            'tajuk' => 'TAJUK III',
            'keterangan' => 'KERJA-KERJA KEJURUTERAAN MEKANIKAL, PEMBERSIHAN DAN AIR (SEMUA TAJUK KECIL TERMASUK BEKALAN PERALATAN)',
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 1(A)',
            'keterangan' => 'SISTEM PENYAMAN UDARA DAN PENGALIH UDARA',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 1(B)',
            'keterangan' => 'BILIK SEJUK',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2',
            'keterangan' => 'LIF DAN ESKALATOR',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3',
            'keterangan' => 'PEMASANGAN PAIP DAN ALAT-ALAT KEBAKARAN',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 4',
            'keterangan' => 'PEMASANGAN ALAT PENGEPAMAN',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 5',
            'keterangan' => 'PEMASANGAN LOJI PEMBERSIHAN KUMBAHAN',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 6',
            'keterangan' => 'PEMASANGAN LOJI PEMBERSIHAN AIR',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7',
            'keterangan' => 'PEMASANGAN KELENGKAPAN MEMASAK DAN DAPUR',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 8',
            'keterangan' => 'PEMASANGAN KELENGKAPAN DOBI',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 9',
            'keterangan' => 'PEMASANGAN LOJI DANDANG DAN KEBUK TEKANAN TAK BERAPI',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 10',
            'keterangan' => 'PEMASANGAN SISTEM MENCEGAH KEBAKARAN',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 11',
            'keterangan' => 'PEMASANGAN S!STEM PENYAMPAI',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 12(A)',
            'keterangan' => 'KREN BAGAN',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 12(B)',
            'keterangan' => 'KREN WORKSHOP',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 12(C)',
            'keterangan' => 'UNIT PENGANGKAT UNTUK PENYELENGGARAAN BANGUNAN',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 13(A)',
            'keterangan' => 'PEMASANGAN LOJI PENGHANCURAN DAN PENAPISAN',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 13(B)',
            'keterangan' => 'PEMASANGAN LOJI MENCAMPUR ASFALT',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 14',
            'keterangan' => 'PEMASANGAN SISTEM KAWALAN PENCEMARAN UDARA',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 15',
            'keterangan' => 'PEMASANGAN KELENGKAPAN JENTERA KILANG MINYAK DAN GETAH',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 16(A)',
            'keterangan' => 'PEMBAIKAN DAN PEMULIHAN GERABAK KERETA API PENUMPANG DAN GERABAK KERETA API BARANG',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 16(B)',
            'keterangan' => 'KERJA-KERJA KIMPALAN LANDASAN KERETA API',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(A)',
            'keterangan' => 'PEMASANGAN SISTEM PENAMPATAN UDARA',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(B)',
            'keterangan' => 'PEMASANGAN SISTEM AIR PANAS',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(C)',
            'keterangan' => 'PEMASANGAN SISTEM GAS PETROLEUM CECAIR (LPG)',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(D)',
            'keterangan' => 'PEMASANGAN PENSTERIL DAN AUTOKLAF',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(E)',
            'keterangan' => 'PEMASANGAN GAS PERUBATAN',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(F)',
            'keterangan' => 'PEMASANGAN ALAT BAKAR SAMPAH',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(G)',
            'keterangan' => 'PEMASANGAN SISTEM AUTOMATIK UNTUK BANGUNAN',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(H)',
            'keterangan' => 'PEMASANGAN RAK BERGERAK ',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(I)',
            'keterangan' => 'PEMASANGAN PERALATAN KOLAM RENANG',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(J)',
            'keterangan' => 'KELENGKAPAN MAKMAL',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(K)',
            'keterangan' => 'PEMASANGAN ALAT ANGKAT PINTU HIDRAUL',
            'tajuk_id' => 3,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 17(I)',
            'keterangan' => 'PEMASANGAN DAN PEMBAIKAN LOJI JENTERA DAN KELENGKAPAN',
            'tajuk_id' => 3,
        ]);


        // Create TAJUK 4
        KelasPukonsa::create([
            'tajuk' => 'TAJUK IV',
            'keterangan' => 'KERJA-KERJA LAIN PAKAR KEJURUTERAAN AWAM',
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 1',
            'keterangan' => 'KERJA-KERJA TANAH',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2(A)',
            'keterangan' => 'KONKRIT DI SITU',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2(B)',
            'keterangan' => 'KONKRIT BERTETULANG TUANG DAHULU',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2(C)',
            'keterangan' => 'KONKRIT PRATEGASAN ATAU PASCATEGASAN',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2(D)',
            'keterangan' => 'KELULI',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2(E)',
            'keterangan' => 'KAYU',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2(F)',
            'keterangan' => 'SISTEM BERPATEN',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(A)',
            'keterangan' => 'KERJA-KERJA PENYALUTAN BERASFALT',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(B)',
            'keterangan' => 'KERJA-KERJA PERMUKAAN JALAN BITUMEN',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(C)',
            'keterangan' => 'KERJA•KERJA MEMBUAT ISYARAT JALAN DAN MENGECAT JALAN',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(D)',
            'keterangan' => 'KERJA-KERJA MEMBUAT PENGADANG SUSUR. SAWAR. PENANDA BATU DAN KERJA YANG LAIN UNTUK JALAN',
            'tajuk_id' => 4,
        ]);
        //SINI
        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 4(A)',
            'keterangan' => 'KERJA-KERJA KELULI',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 4(B)',
            'keterangan' => 'KERJA-KERJA KELULI BERPATEN DAN PASANG SIAP',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 5',
            'keterangan' => 'PENYALIRAN BAWAH TANAH',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 6(A)',
            'keterangan' => 'PEMASANGAN SESALUR AIR',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(A)',
            'keterangan' => 'KERJA-KERJA PENGGERUDIAN UNTUK AIR BAWAH TANAH',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(B)',
            'keterangan' => 'KERJA-KERJA PENYELIDIKAN TANAH',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7(C)',
            'keterangan' => 'KERJA-KERJA KAJIAN GEOFIZIK',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 8',
            'keterangan' => 'KONKRIT BERTETULANG ATAU TANPA TETULANG TUANG DAHULU UNTUK RUSUK. BERBENDUL JALAN PEMBETUNG DAN SALIRAN',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 9',
            'keterangan' => 'PEMBINAAN KONKRIT PRATEGASAN ATAU PASCATEGANGAN',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 10(A)',
            'keterangan' => 'KERJA-KERJA PENURAPAN TEKANAN',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 10(B)',
            'keterangan' => 'GUNITNG',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 10(C)',
            'keterangan' => 'KERJA-KERJA UJIAN YANG TIDAK MEMBERIKAN KESAN PADA ANGGOTA KONKRIT',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 10(D)',
            'keterangan' => 'KERJA-KERJA SOKONG BAWAH',
            'tajuk_id' => 4,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 10(E)',
            'keterangan' => 'KERJA-KERJA SEROMBONG STESEN KUASA',
            'tajuk_id' => 4,
        ]);

        // Create TAJUK V1
        KelasPukonsa::create([
            'tajuk' => 'TAJUK VI',
            'keterangan' => 'PEMBANGUNAN HUTAN DAN TANAH',
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 1',
            'keterangan' => 'PENYEDIAAN DAN PENYELENGGARAAN TAPAK SEMAIAN',
            'tajuk_id' => 5,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2',
            'keterangan' => 'KERJA-KERJA PEMBERSIHAN HUTAN DAN PENYEDIAAN TANAH',
            'tajuk_id' => 5,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(A)',
            'keterangan' => 'KERJA-KERJA PENANAMAN DAN PENYELENGGARAAN POKOK',
            'tajuk_id' => 5,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(B)',
            'keterangan' => 'KERJA-KERJA PENANAMAN SEMULA DAN PENYELENGGARAAN POKOK',
            'tajuk_id' => 5,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 4',
            'keterangan' => 'KERJA-KERJA MEMUNGUT DAN MENGANGKUT HASIL TANAMAN',
            'tajuk_id' => 5,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 5',
            'keterangan' => 'KERJA-KERJA PEMULIHAN HUTAN',
            'tajuk_id' => 5,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 6(A)',
            'keterangan' => 'KERJA-KERJA SENI TANAM',
            'tajuk_id' => 5,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 6(B)',
            'keterangan' => 'KERJA-KERJA PENANAMAN BENIH BERAIR',
            'tajuk_id' => 5,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 7',
            'keterangan' => 'JALAN HUTAN',
            'tajuk_id' => 5,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 8',
            'keterangan' => 'KERJA KERJA AM PERTANIAN',
            'tajuk_id' => 5,
        ]);

        // Create TAJUK V11
        KelasPukonsa::create([
            'tajuk' => 'TAJUK VII',
            'keterangan' => 'KERJA-KERJA TELEKOMUNIKASI',
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 1(A)',
            'keterangan' => 'PENANAMAN, PENYAMBUNGAN DAN PENGUJIAN RANGKAIAN KABEL AGIHAN',
            'tajuk_id' => 6,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 1(B)',
            'keterangan' => 'PENANAMAN, PENYAMBUNGAN DAN PENGUJIAN RANGKAIAN KABEL UTAMA',
            'tajuk_id' => 6,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 1(C)',
            'keterangan' => 'PENANAMAN. PENYAMBUNGAN DAN PENGUJIAN RANGKAIAN KABEL SIMPANG',
            'tajuk_id' => 6,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2(A)',
            'keterangan' => 'PEMASANGAN PENAIK KABEL RANGKA AGIHAN UTAMA PETI AGIHAN SALUR BAWAH LANTAI DAN KABEL TELEFON DALAM BANGUNAN',
            'tajuk_id' => 6,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 2(B)',
            'keterangan' => 'PEMASANGAN SEPASANG KABEL TELEFON DALAM BANGUNAN',
            'tajuk_id' => 6,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(A)',
            'keterangan' => 'PEMASANGAN SISTEM SEMBOYAN YANG MENGANDUNGI GEGANTI BERKAITPANCA DAN GEGANTI BONGKAH AUTOMATIK',
            'tajuk_id' => 6,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(B)',
            'keterangan' => 'PEMASANGAN SISTEM PERHUBUNGAN UNTUK KAWALAN PUSAT DAN LALUAN TEPI STESEN',
            'tajuk_id' => 6,
        ]);

        SubKelasPukonsa::create([
            'tajuk_kecil' => 'TAJUK KECIL 3(C)',
            'keterangan' => 'PEMASANGAN SAWAR ELEKTRIK LENGKAP DENGAN ISYARAT/SUSUR DAN PENGGERA LEBUH RAYA',
            'tajuk_id' => 6,
        ]);

    }
}
