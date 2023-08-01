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
Route::group(['middleware' => ['auth']], function() {

    Route::prefix('sisdant')->group(function() {
        Route::get('/', 'SisdantController@index')->name('index.noperolehan')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Permohonan Nombor Perolehan');
            }
        );

        Route::get('/account', 'SisdantController@profile')->name('index.profile')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Akaun Saya');
            }
        );

        Route::get('/viewiklan/{id}', 'SisdantController@viewIklan')->name('Siklan.view')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Permohonan Nombor Perolehan', route('index.noperolehan'))
                    ->push('Kemaskini Permohonan Sah');
            }
        );

        Route::get('/iklan-batal/{id}', 'SisdantController@iklanbatal')->name('iklan.batal')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Permohonan Nombor Perolehan', route('index.noperolehan'))
                    ->push('Iklan Dibatalkan');
            }
        );

        Route::get('/viewiklansah/{id}', 'SisdantController@viewIklanSah')->name('Siklan.viewiklansah')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Permohonan Nombor Perolehan', route('index.noperolehan'))
                    ->push('Permohonan Sah');
            }
        );

        Route::post('/saveiklan', 'SisdantController@saveIklan');

        Route::get('/pengesah', 'SisdantController@indexPengesah')->name('index.noperolehanpengesah')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Pengesahan Nombor Perolehan');
            }
        );

        Route::get('/permohonanbaru', 'SisdantController@permohonanbaru')->name('permohonanbaru.noperolehan')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Permohonan Nombor Perolehan', route('index.noperolehan'))
                    ->push('Permohonan Baharu');
            }
        );
        Route::get('/kategoriperolehan/{id}', 'SisdantController@getKategoriPerolehan');
        Route::post('/kategoritender', 'SisdantController@getKategoriTender');
        Route::post('/kategoritenderwithperolehan', 'SisdantController@getKategoriTenderPerolehan');
        Route::post('/jenistender', 'SisdantController@getJenisTender');
        Route::post('/getnoperolehan', 'SisdantController@getNoPerolehan');
        Route::post('/savepermohonan', 'SisdantController@savePermohonanNombor');
        Route::post('/simpanpermohonan', 'SisdantController@simpanPermohonan');
        Route::get('/deletepermohonan/{id}', 'SisdantController@deletePermohonan');
        Route::get('/deletepermohonandraf/{id}', 'SisdantController@deletePermohonanDraf');
        Route::get('/editpermohonandraf/{id}', 'SisdantController@editPermohonanDraf')->name('permohonandrafbaru.edit')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Permohonan Nombor Perolehan', route('index.noperolehan'))
                    ->push('Kemaskini Permohonan Baharu');
            }
        );
        Route::post('/savepermohonandraf', 'SisdantController@savePermohonanNomborDraf');
        Route::get('/viewpermohonan/{id}', 'SisdantController@viewPermohonan')->name('permohonanbaru.sah')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Pengesahan Nombor Perolehan', route('index.noperolehanpengesah'))
                    ->push('Sah Permohonan Baharu');
            }
        );
        Route::post('/sahpermohonan', 'SisdantController@sahPermohonan');

    //start kemaskini permohonan selepas sah
    //redirect to edit page
    Route::get('/editpermohonansah/{id}', 'SisdantController@edit')->name('permohonanbaru.edit')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push('Permohonan Nombor Perolehan', route('index.noperolehan'))
                ->push('Kemaskini Permohonan Sah');
        }
    );
    Route::get('/editpermohonanbelumsah/{id}', 'SisdantController@viewPermohonanBelumSah')->name('permohonanbaru.viewPermohonanBelumSah')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push('Permohonan Nombor Perolehan', route('index.noperolehan'))
                ->push('Permohonan Dalam Proses');
        }
    );

    Route::get('/viewpermohonanstatusbatal/{id}', 'SisdantController@viewPermohonanStatusBatal')->name('permohonanbaru.viewPermohonanBatal')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->push('Menu Utama', route('frontend.user.dashboard'))
                ->push('Permohonan Nombor Perolehan', route('index.noperolehan'))
                ->push('Permohonan Dibatalkan');
        }
    );
    //delete uploaded file
    Route::post('/editpermohonansah/deletefile/{id}', 'SisdantController@deletefile');
    Route::post('/editpermohonandraf/deletefiledraf/{id}', 'SisdantController@deletefileDraf');
    Route::get('/editpermohonansah/subbidang/{id}', 'SisdantController@getSubBidang');
    Route::get('/editpermohonansah/pengkhususan/{id}', 'SisdantController@getkhusus');
    Route::get('/editpermohonansah/subtajuk/{id}', 'SisdantController@getSubTajuk');
    Route::get('/editpermohonansah/subtajukupkj/{id}', 'SisdantController@getSubTajukUpkj');
    Route::get('/getmaklumatpadam/{id}', 'SisdantController@getMaklumatPadam');
    // Route::get('/editpermohonansah/bidang', 'SisdantController@getbidang');

    Route::post('/updatepermohonansah', 'SisdantController@updatePermohonanSah');

    // end kemaskini permohonan selepas sah

        Route::get('/senarai_nombor_perolehan', 'SisdantController@senaraiPerolehan')->name('senaraiPerolehan.noperolehan')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Senarai Nombor Perolehan');
            }
        );
    
    // Laporan Senarai Nombor Perolehan
    Route::get('/laporan_daftar_perolehan', 'SisdantController@laporanPerolehan')->name('laporanPerolehan.laporanperolehan')
        ->breadcrumbs(
            function (Trail $trail) {
                $trail->push('Menu Utama', route('frontend.user.dashboard'))
                    ->push('Laporan Daftar Perolehan');
            }
        );
    Route::post('/laporan_daftar_perolehan_filter', 'SisdantController@filterLaporan')->name('laporanPerolehan.laporanperolehanfilter');
    Route::post('/bahagian', 'SisdantController@getBahagian');
    });

});

