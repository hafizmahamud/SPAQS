<?php

namespace Database\Seeders;

use App\Domains\Auth\Models\Permission;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Modules\Sisdant\Models\Kelas;
use Modules\Sisdant\Models\Pengkhususan;
use Database\Seeders\Traits\TruncateTable;

/**
 * Class PermissionRoleTableSeeder.
 */
class KelasSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->truncate('kelas');

        // Create PENGKHUSUSAN KATEGORI BANGUNAN
        Kelas::create([
            'id' => 1,
            'kod' => 'B',
            'kelas' => 'BANGUNAN',
        ]);

        // Create PENGKHUSUSAN BANGUNAN
        Pengkhususan::create([
            'kod' => 'B01',
            'pengkhususan' => 'IBS: SISTEM KONKRIT PASANG SIAP',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B02',
            'pengkhususan' => 'IBS: SISTEM KERANGKA KELULI',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B03',
            'pengkhususan' => 'PEMULIHAN DAN PEMULIHARAAN',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B04',
            'pengkhususan' => 'KERJA-KERJA PEMBINAAN BANGUNAN',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B05',
            'pengkhususan' => 'KERJA CERUCUK',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B06',
            'pengkhususan' => 'KERJA PEMBAIKAN STRUKTUR KONKRIT',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B07',
            'pengkhususan' => 'HIASAN DALAMAN',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B08',
            'pengkhususan' => 'PEMASANGAN BAHAN KALIS AIR',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B09',
            'pengkhususan' => 'LANSKAP DALAM BANGUNAN',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B10',
            'pengkhususan' => 'SISTEM PAIP AIR DALAMAN',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B11',
            'pengkhususan' => 'PEMASANGAN PAPAN TANDA PADA BANGUNAN',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B12',
            'pengkhususan' => 'KERJA PEMASANGAN KACA',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B13',
            'pengkhususan' => 'PEMASANGAN JUBIN',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B14',
            'pengkhususan' => 'KERJA-KERJA CAT',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B15',
            'pengkhususan' => 'PEMASANGAN BUMBUNG',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B16',
            'pengkhususan' => 'KOLAM RENANG',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B17',
            'pengkhususan' => 'KERJA PRESTRESSING DAN POST TENSIONING',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B18',
            'pengkhususan' => 'KERJA-KERJA LOGAM',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B19',
            'pengkhususan' => 'IBS: SISTEM FORMWORK',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B20',
            'pengkhususan' => 'SISTEM PAIP GAS DALAM BANGUNAN',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B21',
            'pengkhususan' => 'PEMASANGAN PERANCAH',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B22',
            'pengkhususan' => 'IBS: SISTEM BLOK',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B23',
            'pengkhususan' => 'IBS: SISTEM KERANGKA KAYU',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B24',
            'pengkhususan' => 'KERJA PENYENGGARAAN BANGUNAN',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B25',
            'pengkhususan' => 'PENYAMBUNGAN PAIP PERSENDIRIAN KE PEMBETUNG (SEWERAGE)',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B26',
            'pengkhususan' => 'KERJA-KERJA MEROBOH',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B27',
            'pengkhususan' => 'PERKHIDMATAN PENYENGARAAN SISTEM AIR ATAU SISTEM PEMBETUNGAN',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B28',
            'pengkhususan' => 'KERJA-KERJA UBAHSUAI',
            'kelas_id' => 1,
        ]);
        Pengkhususan::create([
            'kod' => 'B29',
            'pengkhususan' => 'KERJA BANGUNAN KESIHATAN',
            'kelas_id' => 1,
        ]);

        // Create PENGKHUSUSAN KATEGORI KEJURUTERAAN AWAM
        Kelas::create([
            'id' => 2,
            'kod' => 'CE',
            'kelas' => 'KEJURUTERAAN AWAM',
        ]);

        // Create PENGKHUSUSAN KEJURUTERAAN AWAM
        Pengkhususan::create([
            'kod' => 'CE01',
            'pengkhususan' => 'PEMBINAAN JALAN DAN PAVEMEN',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE02',
            'pengkhususan' => 'PEMBINAAN JAMBATAN DAN JETI',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE03',
            'pengkhususan' => 'STRUKTUR MERIN',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE04',
            'pengkhususan' => 'EMPANGAN',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE05',
            'pengkhususan' => 'TEROWONG DAN SOKONG BAWAH TANAH',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE06',
            'pengkhususan' => 'STRUKTUR SALIRAN, PENGALIRAN DAN KAWALAN BANJIR',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE07',
            'pengkhususan' => 'LANDASAN REL',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE08',
            'pengkhususan' => 'SISTEM PERLINDUNGAN DAN PENSTABILAN CERUN',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE09',
            'pengkhususan' => 'SALURAN UTAMA PAIP MINYAK ATAU GAS',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE10',
            'pengkhususan' => 'KERJA CERUCUK',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE11',
            'pengkhususan' => 'KERJA PEMBAIKAN STRUKTUR KONKRIT',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE12',
            'pengkhususan' => 'KERJA PENYIASATAN TANAH',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE13',
            'pengkhususan' => 'PEMASANGAN PAPAN IKLAN',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE14',
            'pengkhususan' => 'LANDSKAP DILUAR BANGUNAN',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE15',
            'pengkhususan' => 'PELANTAR MINYAK DAN GAS',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE16',
            'pengkhususan' => 'KERJA-KERJA PENYENGGARAAN STRUKTUR DIBAWAH AIR',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE17',
            'pengkhususan' => 'LAPANGAN TERBANG',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE18',
            'pengkhususan' => 'TEBUSGUNA TANAH',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE19',
            'pengkhususan' => 'SISTEM PEMBENTUNGAN',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE20',
            'pengkhususan' => 'SISTEM BEKALAN AIR',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE21',
            'pengkhususan' => 'PEMBINAAN KEJURUTERAAN AWAM',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE22',
            'pengkhususan' => 'TREK PADANG PERMAINAN SINTETIK',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE23',
            'pengkhususan' => 'KERJA PRESTRESSING DAN POST TENSIONING',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE24',
            'pengkhususan' => 'STRUKTUR MENARA',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE25',
            'pengkhususan' => 'KERJA-KERJA MELETUP',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE26',
            'pengkhususan' => 'STRUKTUR BERUKIR (SCULPTURED STRUCTURES)',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE27',
            'pengkhususan' => 'KERJA PENEBATAN HABA/REFRACTORY',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE28',
            'pengkhususan' => 'ACUAN KONKRIT KHUSUS',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE29',
            'pengkhususan' => 'PEMASANGAN PERANCAH',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE30',
            'pengkhususan' => 'KERJA-KERJA PENSATABILAN TANAH',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE31',
            'pengkhususan' => 'STRUKTUR LALUAN KABEL BAWAH TANAH',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE32',
            'pengkhususan' => 'KERJA PENYENGGARAAN KEJURUTERAAN AWAM',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE33',
            'pengkhususan' => 'TELAGA TIUB',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE34',
            'pengkhususan' => 'KERJA PEMASANGAN KONKRIT PRATUANG',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE35',
            'pengkhususan' => 'UJIAN KONKRIT',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE36',
            'pengkhususan' => 'KERJA-KERJA TANAH',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE37',
            'pengkhususan' => 'KERJA SEROMBONG STESEN KUASA',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE38',
            'pengkhususan' => 'PENYENGGARAAN SISTEM PEMBETUNGAN',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE39',
            'pengkhususan' => 'PENYELENGARAAN SISTEM BEKALAN AIR',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE40',
            'pengkhususan' => 'KERJA-KERJA PENGOREKAN DAN KAWALAN HAKISAN',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE41',
            'pengkhususan' => 'KERJA MEMBINA TAKUNGAN AIR',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE42',
            'pengkhususan' => 'KERJA SEROMBONG STESEN KUASA',
            'kelas_id' => 2,
        ]);
        Pengkhususan::create([
            'kod' => 'CE43',
            'pengkhususan' => 'PERABOT JALAN',
            'kelas_id' => 2,
        ]);

        // Create PENGKHUSUSAN KATEGORI MEKANIKAL
        Kelas::create([
            'id' => 3,
            'kod' => 'ME',
            'kelas' => 'MEKANIKAL',
        ]);

        // Create PENGKHUSUSAN MEKANIKAL
        Pengkhususan::create([
            'kod' => 'M01',
            'pengkhususan' => 'SISTEM HAWA DINGIN DAN PENGEDARAN UDARA',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M02',
            'pengkhususan' => 'SISTEM PENCEGAHAN DAN PERLINDUNGAN KEBAKARAN',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M03',
            'pengkhususan' => 'LIFT DAN ESKALATOR',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M04',
            'pengkhususan' => 'SISTEM AUTOMASI BANGUNAN',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M05',
            'pengkhususan' => 'SISTEM UNTUK BENGKEL, KILANG KUARI DAN SEBAGAINYA',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M06',
            'pengkhususan' => 'SISTEM PERALATAN PERUBATAN',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M07',
            'pengkhususan' => 'SISTEM PERALATAN DAPUR',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M08',
            'pengkhususan' => 'SISTEM LOJI DANDANG DAN TEKANAN BERAPI',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M09',
            'pengkhususan' => 'SISTEM PEMAMPATAN DAN PENJANAAN BERASASKAN MEKANIKAL',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M10',
            'pengkhususan' => 'SISTEM PENDINGIN UNTUK KUASA PENJANAAN',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M11',
            'pengkhususan' => 'PEMBINAAN DAN RAWATAN KHUSUS',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M12',
            'pengkhususan' => 'LOJI KHUSUS',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M13',
            'pengkhususan' => 'STRUKTUR PENGERUDIAN LUAR PANTAI',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M14',
            'pengkhususan' => 'SISTEM KAWALAN PENCEMARAN',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M15',
            'pengkhususan' => 'KELENGKAPAN MEKANIKAL PELBAGAI',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M16',
            'pengkhususan' => 'KREN MENARA',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M17',
            'pengkhususan' => 'SISTEM PERALATAN DOBI',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M18',
            'pengkhususan' => 'SISTEM AIR PANAS',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M19',
            'pengkhususan' => 'PEMASANGAN KELENGKAPAN LOJI',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M20',
            'pengkhususan' => 'PENYENGGARAAN AM MEKANIKAL',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M21',
            'pengkhususan' => 'KERJA-KERJA KIMPALAN',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M22',
            'pengkhususan' => 'SISTEM PAM',
            'kelas_id' => 3,
        ]);
        Pengkhususan::create([
            'kod' => 'M23',
            'pengkhususan' => 'SISTEM SCADA DAN TELEMETRI',
            'kelas_id' => 3,
        ]);

        // Create PENGKHUSUSAN KATEGORI ELEKTRIK
        Kelas::create([
            'id' => 4,
            'kod' => 'E',
            'kelas' => 'ELEKTRIK',
        ]);

        // Create PENGKHUSUSAN ELEKTRIK
        Pengkhususan::create([
            'kod' => 'E01',
            'pengkhususan' => 'SISTEM BUNYI',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E02',
            'pengkhususan' => 'SISTEM PENGAWASAN DAN KESELAMATAN',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E03',
            'pengkhususan' => 'SISTEM AUTOMASI BANGUNAN',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E04',
            'pengkhususan' => 'PEMASANGAN VOLTAN RENDAH',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E05',
            'pengkhususan' => 'PEMASANGAN VOLTAN TINGGI SEHINGGA 11KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E06',
            'pengkhususan' => 'SISTEM PENCAHAYAAN KHAS',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E07',
            'pengkhususan' => 'SISTEM TELEKOMUNIKASI DALAMAN',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E08',
            'pengkhususan' => 'SISTEM TELEKOMUNIKASI LUARAN',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E09',
            'pengkhususan' => 'SISTEM PEMASANGAN PERALATAN PERUBATAN',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E10',
            'pengkhususan' => 'SISTEM BEKALAN KUASA TANPA GANGGUAN',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E11',
            'pengkhususan' => 'KERJA AM ELEKTRIK',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E12',
            'pengkhususan' => 'PAPAN TANDA ELEKTRIK',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E13',
            'pengkhususan' => 'SISTEM TELEKOMUNIKASI PERKHIDMATAN REL',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E14',
            'pengkhususan' => 'KABEL RANGKAIAN KOMPUTER',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E15',
            'pengkhususan' => 'LAMPU LANDASAN LAPANGAN TERBANG',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E16',
            'pengkhususan' => 'LAMPU JALAN & LAMPU ISYARAT',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E17',
            'pengkhususan' => 'KABEL BAWAH TANAH VOLTAN RENDAH',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E18',
            'pengkhususan' => 'KABEL BAWAH TANAH VOLTAN TINGGI SEHINGGA 11KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E19',
            'pengkhususan' => 'KABEL BAWAH TANAH VOLTAN TINGGI MELEBIHI 11KV SEHINGGA 33KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E20',
            'pengkhususan' => 'KABEL BAWAH TANAH  VOLTAN TINGGI MELEBIHI 33KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E21',
            'pengkhususan' => 'TALIAN ATAS VOLTAN RENDAH',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E22',
            'pengkhususan' => 'KABEL TALIAN ATAS VOLTAN TINGGI SEHINGGA 33KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E23',
            'pengkhususan' => 'KABEL TALIAN ATAS VOLTAN TINGGI MELEBIHI 33KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E24',
            'pengkhususan' => 'PEMASANGAN VOLTAN TINGGI MELEBIHI 11KV SEHINGGA 33KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E25',
            'pengkhususan' => 'PEMASANGAN  VOLTAN TINGGI MELEBIHI 33KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E26',
            'pengkhususan' => 'KERJA-KERJA MENCANTUM KABEL VOLTAN RENDAH 1KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E27',
            'pengkhususan' => 'KERJA-KERJA MENCANTUM KABEL SEHINGGA 11KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E28',
            'pengkhususan' => 'KERJA-KERJA MENCANTUM KABEL MELEBIHI 11KV SEHINGGA 33KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E29',
            'pengkhususan' => 'KERJA-KERJA MENCANTUM KABEL 33KV SEHINGGA 66KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E30',
            'pengkhususan' => 'KERJA-KERJA MENCANTUM KABEL SEHINGGA 132KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E31',
            'pengkhususan' => 'KERJA-KERJA MENCANTUM KABEL TIADA SEKATAN MELEBIHI 132KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E32',
            'pengkhususan' => 'JANAKUASA VOLTAN RENDAH',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E33',
            'pengkhususan' => 'JANAKUASA VOLTAN TINGGI SEHINGGA 33KV',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E34',
            'pengkhususan' => 'SISTEM SOLAR FOTOVOLTA (PHOTOVOLTIC) TERSAMBUNG GRID YANG BERKAPASITI SEHINGGA 72KW',
            'kelas_id' => 4,
        ]);
        Pengkhususan::create([
            'kod' => 'E35',
            'pengkhususan' => 'SISTEM SOLAR FOTOVOLTA (PHOTOVOLTAIC) TERSAMBUNG GRID BERKAPASITI MELEBIHI 72 KW',
            'kelas_id' => 4,
        ]);

        // Create PENGKHUSUSAN KATEGORI FASILITI
        Kelas::create([
            'id' => 5,
            'kod' => 'F',
            'kelas' => 'FASILITI',
        ]);

        // Create PENGKHUSUSAN FASILITI
        Pengkhususan::create([
            'kod' => 'F01',
            'pengkhususan' => 'FASILITI BANGUNAN DAN INFRASTRUKTUR',
            'kelas_id' => 5,
        ]);
        Pengkhususan::create([
            'kod' => 'F02',
            'pengkhususan' => 'FASILITI BANGUNAN PENJAGAAN KESIHATAN',
            'kelas_id' => 5,
        ]);

    }
}
