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
use Modules\Awas\Models\PenilaianPerolehan;
use App\Http\Controllers\AwasController;

Route::prefix('awas')->group(function() {
    Route::get('/viewpetenderberjaya-public', 'AwasController@viewPetenderBerjayaPublic')->name('petenderberjayapublic');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/senarai-petender-berjaya', 'AwasController@senaraiPetenderBerjayaPublic')->name('index.senaraiPetenderBerjayaPublic');
    Route::prefix('awas')->group(function() {
        Route::get('/', 'AwasController@index')->name('index.iklantutup')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Penilaian');
            }
        );
        Route::get('/keputusan', 'AwasController@indexkeputusan')->name('index.keputusan')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Keputusan');
            }
        );

        Route::get('/account', 'AwasController@profile')->name('awas.profile')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Akaun Saya');
            }
        );

        Route::get('/suratPerakuan', 'AwasController@suratPerakuan')->name('index.suratperakuan')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Senarai Hantar Surat Perakuan');
            }
        );
        Route::get('/suratLanjutan', 'AwasController@suratLanjutan')->name('index.suratlanjutan')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Senarai Hantar Surat Lanjutan');
            }
        );
        Route::get('/penilaian/{id}', 'AwasController@Penilaian')->name('index.penilaian')
        ->breadcrumbs(
            function (Trail $trail, $perolehan) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push(('Penilaian'), route('index.iklantutup'))
                ->push('Butiran Penilaian');
            }
        );



        Route::get('/penilaianperolehan/{id}', 'AwasController@penilaianPerolehan')->name('index.penilaianperolehan')
        ->breadcrumbs(
            function (Trail $trail, $perolehan) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push(('Keputusan'), route('index.keputusan'))
                ->push('Butiran Keputusan');
            }
        );

        Route::get('/keputusanperolehan/{id}', 'AwasController@keputusanPerolehan')->name('index.keputusanperolehan')
        ->breadcrumbs(
            function (Trail $trail, $perolehan) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push(('Keputusan'), route('index.keputusan'))
                ->push('Butiran Keputusan');
            }
        );
        Route::get('/viewpenilaian/{id}', 'AwasController@viewPenilaian')->name('index.viewpenilaian')
        ->breadcrumbs(
            function (Trail $trail, $perolehan) {

                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push(('Keputusan'), route('index.keputusan'))
                ->push('Butiran Penilaian & Keputusan');
        }
        );

        Route::get('/editpenilaian/{id}', 'AwasController@editPenilaian')->name('index.editpenilaian')
        ->breadcrumbs(
            function (Trail $trail, $perolehan) {

                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push(('Penilaian'), route('index.iklantutup'))
                    ->push('Kemaskini Lantikan Penilai');
            }
        );

        Route::get('/senarai_petender_berjaya', 'AwasController@petenderBerjaya')->name('senaraiPetenderBerjaya')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push('Senarai Petender Berjaya');
            }
        );
       
        Route::get('/dokumen_kontrak/{id}', 'AwasController@dokumenKontrak')->name('dokumenKontrak')
        ->breadcrumbs(
            function (Trail $trail, $penilaian) {
                $idPenilaian = PenilaianPerolehan::where('id', $penilaian)
                            ->with('iklanPerolehan.mohonNoPerolehan')->first();
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push(__(':no_perolehan', ['no_perolehan' => $idPenilaian->iklanPerolehan->mohonNoPerolehan['no_perolehan']]), route('senaraiPetenderBerjaya'))
                    ->push('Dokumen Kontrak');
                }
            );

        Route::get('/laporan_pemantauan_tender', 'AwasController@laporanTender')->name('laporantender')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push('Laporan Pemantauan Tender');
            }
        );
        
        Route::post('savedokumenkontrak','AwasController@saveDokumenKontrak');
        Route::post('/savepenilaian', 'AwasController@savePenilaianTender');
        Route::get('/getiklan/{id}', 'AwasController@getiklan')->name('iklan.getiklan');
        Route::get('/butiran-sst/{id}', 'AwasController@butiranSST')->name('iklan.butiranSST')
        ->breadcrumbs(
            function (Trail $trail, $penilaian) {
                $idPenilaian = PenilaianPerolehan::where('id', $penilaian)
                            ->with('iklanPerolehan.mohonNoPerolehan')->first();
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push(__(':no_perolehan', ['no_perolehan' => $idPenilaian->iklanPerolehan->mohonNoPerolehan['no_perolehan']]), route('senaraiPetenderBerjaya'))
                    ->push('Butiran SST');
                }
            );
        Route::post('/laporan_penilai_filter', 'AwasController@filterPenilai')->name('laporanpenilaifilter');
        Route::get('/checksyarikat/{id}', 'AwasController@checkSyarikat');
        Route::post('/savekeputusan', 'AwasController@saveKeputusanPortal');
        Route::post('/savekeputusanperolehan', 'AwasController@saveKeputusanPerolehan');
        Route::post('/savekeputusanperolehandraf', 'AwasController@saveKeputusanPerolehanDraf');
        Route::get('/viewdrafkeputusan/{id}', 'AwasController@viewDrafkeputusan')->name('index.viewDrafkeputusan')
        ->breadcrumbs(
            function (Trail $trail, $perolehan) {

                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push(('Keputusan'), route('index.keputusan'))
                ->push('Butiran Penilaian & Keputusan');
            }
        );

        Route::get('/viewdrafkeputusanperolehan/{id}', 'AwasController@viewDrafKeputusanPerolehan')->name('index.viewDrafKeputusanPerolehan')
        ->breadcrumbs(
            function (Trail $trail, $perolehan) {

                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push(('Keputusan'), route('index.keputusan'))
                ->push('Butiran Keputusan');
            }
        );

        Route::get('/viewkeputusan/{id}', 'AwasController@viewKeputusan')->name('index.viewKeputusan')
        ->breadcrumbs(
            function (Trail $trail, $perolehan) {

                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push(('Keputusan'), route('index.keputusan'))
                ->push('Butiran Penilaian dan Keputusan');
            }
        );
        Route::get('/viewkeputusanperolehan/{id}', 'AwasController@viewKeputusanPerolehan')->name('index.viewKeputusanPerolehan')
        ->breadcrumbs(
            function (Trail $trail, $perolehan) {

                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push(('Keputusan'), route('index.keputusan'))
                ->push('Butiran Keputusan');
            }
        );
        Route::post('/suratPerakuan/pdf', 'AwasController@generateSuratPerakuan');
        Route::post('/suratLanjutan/pdf', 'AwasController@generateSuratLanjutan');
        Route::patch('/dokumenSST', 'AwasController@dokumenSST');
        Route::get('/file/{file}', function($file)
        {
            $path = storage_path().'/app/public/tetapanTemplate/'.$file;
            if (file_exists($path)) {
                return Response::download($path);
            }
        });

    });
});
