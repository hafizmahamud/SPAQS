<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Tabuna\Breadcrumbs\Trail;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Tunas\Models\BorangDaftarMinat;
use Modules\Sisdant\Models\IklanPerolehan;

Route::prefix('tunas')->group(function() {
    Route::get('/senarai-iklan-telah-buka', 'TunasController@iklanBelumTutupPublic')->name('index.SenaraiIklanTelahBuka');
    Route::get('/viewiklan-public/{id}', 'TunasController@viewIklanPublic')->name('iklan.viewpublic');
});

Route::group(['middleware' => ['auth']], function() {
    Route::prefix('tunas')->group(function() {
        Route::get('/', 'TunasController@index')->name('iklan.noperolehan')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Senarai Permohonan Iklan');
            }
        );

        Route::get('/account', 'TunasController@profile')->name('tunas.profile')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Akaun Saya');
            }
        );

        Route::get('/viewiklan/{id}', 'TunasController@viewIklan')->name('iklan.view')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Senarai Permohonan Iklan', route('iklan.noperolehan'))
                    ->push('Kemaskini Permohonan Baharu');
            }
        );
        Route::post('/saveiklan', 'TunasController@saveIklan');
        Route::post('/viewiklan/deletetender/', 'TunasController@deletetender');
        Route::get('/justifikasi/{id}', 'TunasController@getMaklumatJustifikasiPadam');

        // IKLAN TELAH TUTUP
        Route::get('/iklan-telah-tutup', 'IklanTelahTutupController@index')->name('index.iklanTelahTutup')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Iklan Telah Tutup');
            }
        );

        Route::post('/iklan-telah-tutup/jadual-harga/tambah/{id}', 'IklanTelahTutupController@tambahJadualHarga')->name('iklanTelahTutup.tambahJadualHarga');
        Route::patch('/iklan-telah-tutup/jadual-harga/hantar', 'IklanTelahTutupController@hantarJadualHarga')->name('iklanTelahTutup.hantarJadualHarga');
        Route::get('/iklan-telah-tutup/jadual-harga/senarai/{id}', 'IklanTelahTutupController@senaraiJadualHarga')->name('iklanTelahTutup.senaraiJadualHarga');
        Route::get('/iklan-telah-tutup/jadual-harga/padam/{id}', 'IklanTelahTutupController@padamJadualHarga')->name('iklanTelahTutup.padamJadualHarga');
        Route::get('/iklan-telah-tutup/jadual-harga/{id}', 'IklanTelahTutupController@jadualHarga')->name('iklanTelahTutup.jadualharga')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Iklan Telah Tutup', route('index.iklanTelahTutup'))
                    ->push('Jadual Harga');
            }
        );

        // IKLAN BELUM TUTUP
        Route::get('/senaraiiklanbelumtutup', 'IklanBelumTutupController@iklanBelumTutup')->name('iklan.belumtutup')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Senarai Iklan Belum Tutup');
            }
        );

        Route::get('/viewiklanbelumtutup/{id?}', 'IklanBelumTutupController@viewIklanBelumTutup')->name('iklan.viewbelumtutup')
                ->breadcrumbs(
                    function (Trail $trail, $perolehan) {
                        $noPerolehan = IklanPerolehan::where('id', $perolehan)->first();
                        $noPerolehan = PermohonanNomborPerolehan::where('id_perolehan', $noPerolehan->mohon_no_perolehan_id)->first();
                        $trail->push('Menu Utama', route('frontend.user.dashboard'))
                            ->push('Senarai Iklan Belum Tutup', route('iklan.belumtutup'))
                            ->push(__(':no_perolehan', ['no_perolehan' => $noPerolehan->no_perolehan]));
                    }
                );

        Route::get('/viewpetender/{iklan_perolehan_id}/{id}', 'IklanBelumTutupController@viewPetender')->name('iklan.viewpetender')
        ->breadcrumbs(
            function (Trail $trail, $perolehan, $id) {
                $noPerolehan = IklanPerolehan::where('id', $perolehan)->first();
                $noPerolehan = PermohonanNomborPerolehan::where('id_perolehan', $noPerolehan->mohon_no_perolehan_id)->first();
                $namaSyarikat = BorangDaftarMinat::where('id', $id)->first();
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Senarai Iklan Belum Tutup', route('iklan.belumtutup'))
                    ->push(__(':no_perolehan', ['no_perolehan' => $noPerolehan->no_perolehan]), route('iklan.viewbelumtutup',  ['id' => $perolehan]))
                    ->push(__(':syarikat', ['syarikat' => $namaSyarikat->nama_syarikat]));

            }
        );
        Route::post('/saringpetender', 'IklanBelumTutupController@savePetender');
        Route::get('/laporan_iklan_perolehan', 'TunasController@laporanIklan')->name('laporanIklan.laporaniklan')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Laporan Iklan Perolehan');
            }
        );
        Route::post('/laporan_iklan_perolehan_filter', 'TunasController@filterLaporan')->name('laporaniklanperolehan.laporaniklanfilter');
        Route::post('/getKategori', 'TunasController@getKategoriPerolehan');
        Route::post('/getJenisPerolehan', 'TunasController@getJenisPerolehan');
        Route::post('/saveresitstatus', 'IklanBelumTutupController@saveResitStatus');
        Route::get('/verifyresit/{id}', 'IklanBelumTutupController@verifyResit')->name('iklan.verifyResit');
        Route::post('/saveaddendum', 'IklanBelumTutupController@saveAddendum');
        Route::post('/viewiklanbelumtutup/deleteaddendum/', 'IklanBelumTutupController@deleteaddendum');
        Route::post('/laporanb_iklan_perolehan_filter', 'TunasController@filterLaporanB')->name('laporanbiklanperolehan.laporanbiklanfilter');
        Route::get('/senarai-petender-berjaya', 'IklanTelahTutupController@petenderBerjaya')->name('iklan.petenderberjaya');



    });

});
Route::get('/saringanwajib/{id}', 'TunasController@viewSaringanWajib')->name('iklan.viewSaringanWajib');
Route::post('/checknosiri', 'TunasController@getNoSiri');
Route::post('/savesaringanwajib', 'TunasController@saveSaringanWajib');
Route::get('/uploadresit/{id}', 'IklanBelumTutupController@uploadResitBayaran')->name('iklan.uploadResit');
Route::post('/saveresit', 'IklanBelumTutupController@saveResitBayaran')->name('iklan.saveResit');
// Route::get('/verifyresit/{id}', 'IklanBelumTutupController@verifyResit')->name('iklan.verifyResit');
Route::get('/kehadiranlawatantapak/{id}', 'TunasController@kehadiranlawatantapak');
Route::post('/kehadiranlawatantapak/simpan', 'TunasController@simpanLawatanTapak');
Route::get('/checkmof', 'TunasController@checkMof')->name('iklan.checkmof');
Route::get('/senarai-iklan-telah-tutup', 'IklanTelahTutupController@senaraiIklanTelahTutup')->name('index.SenaraiIklanTelahTutup');

