<?php

use App\Domains\Auth\Http\Controllers\Backend\Role\RoleController;
use App\Domains\Auth\Http\Controllers\Backend\User\DeactivatedUserController;
use App\Domains\Auth\Http\Controllers\Backend\User\DeletedUserController;
use App\Domains\Auth\Http\Controllers\Backend\User\UserController;
use App\Domains\Auth\Http\Controllers\Backend\Bidang\BidangController;
use App\Domains\Auth\Http\Controllers\Backend\Upkj\UpkjController;
use App\Domains\Auth\Http\Controllers\Backend\SubBidang\SubBidangController;
use App\Domains\Auth\Http\Controllers\Backend\SubUpkj\SubUpkjController;
use App\Domains\Auth\Http\Controllers\Backend\Kelas\KelasController;
use App\Domains\Auth\Http\Controllers\Backend\Pengkhususan\PengkhususanController;
use App\Domains\Auth\Http\Controllers\Backend\User\UserPasswordController;
use App\Domains\Auth\Http\Controllers\Backend\User\UserSessionController;
use App\Domains\Auth\Http\Controllers\Backend\Iklan\IklanController;
use App\Domains\Auth\Http\Controllers\Backend\Iklan\JenisIklanController;
use App\Domains\Auth\Http\Controllers\Backend\Iklan\KategoriIklanController;
use App\Domains\Auth\Http\Controllers\Backend\Iklan\JenisTenderController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanSistem\BahagianController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanSistem\BayaranController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanSistem\NegeriController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanSistem\AlamatController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanSistem\PukonsaController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanSistem\SubKelasPukonsaController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate\LantikanPenilaiController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate\KepalaSuratController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate\InfoPengarahController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate\AkuanPelantikanController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate\SelesaiTugasController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate\HantarDokumenController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate\LanjutSahLakuController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate\SuratKeputusanController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate\MemoKeputusanController;
use App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate\SSTController;
use App\Domains\Auth\Http\Controllers\TetapanTemplate\PDFController;
use App\Domains\Auth\Http\Controllers\Backend\Announcement\AnnouncementController;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use App\Domains\Announcement\Models\Announcement;
use Modules\Sisdant\Models\Bidang;
use Modules\Sisdant\Models\KelasUpkj;
use Modules\Sisdant\Models\SubKelasUpkj;
use Modules\Sisdant\Models\KelasPukonsa;
use Modules\Sisdant\Models\SubKelasPukonsa;
use Modules\Sisdant\Models\SubBidang;
use Modules\Sisdant\Models\Kelas;
use Modules\Sisdant\Models\Pengkhususan;
use Modules\Sisdant\Models\JenisIklan;
use Modules\Sisdant\Models\KategoriPerolehan;
use Modules\Sisdant\Models\MatrikIklan;
use Modules\Sisdant\Models\JenisTender;
use Modules\Sisdant\Models\BayarKepada;
use App\Models\Pejabat;
use App\Models\Negeri;
use App\Models\SenaraiAlamat;
use App\Models\LantikanPenilai;
use App\Models\HeaderSurat;
use App\Models\Tandatangan;
use App\Models\Pelantikan;
use App\Models\SelesaiTugas;
use App\Models\HantarDokumen;
use App\Models\LanjutSahLaku;
use App\Models\SuratEdarKeputusan;
use App\Models\MemoEdarKeputusan;
use App\Models\TemplatSST;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.auth'.
Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'prefix' => 'user',
        'as' => 'user.',
    ], function () {
        Route::group([
            'middleware' => 'role:'.config('boilerplate.access.role.admin'),
        ], function () {
            Route::get('deleted', [DeletedUserController::class, 'index'])
                ->name('deleted')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.auth.user.index')
                        ->push(__('Deleted Users'), route('admin.auth.user.deleted'));
                });

            Route::get('create', [UserController::class, 'create'])
                ->name('create')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.auth.user.index')
                        ->push(__('Create User'), route('admin.auth.user.create'));
                });

            Route::post('/', [UserController::class, 'store'])->name('store');

            Route::group(['prefix' => '{user}'], function () {
                Route::get('edit', [UserController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, User $user) {
                        $trail->parent('admin.auth.user.show', $user)
                            ->push(__('Edit'), route('admin.auth.user.edit', $user));
                    });

                Route::patch('/', [UserController::class, 'update'])->name('update');
                Route::delete('/', [UserController::class, 'destroy'])->name('destroy');

            });

            Route::group(['prefix' => '{deletedUser}'], function () {
                Route::patch('restore', [DeletedUserController::class, 'update'])->name('restore');
                Route::delete('permanently-delete', [DeletedUserController::class, 'destroy'])->name('permanently-delete');
            });
        });

        Route::post('/semakpengguna', [UserController::class, 'semakpengguna']);


        Route::group([
            'middleware' => 'permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.reactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password',
        ], function () {
            Route::get('deactivated', [DeactivatedUserController::class, 'index'])
                ->name('deactivated')
                ->middleware('permission:admin.access.user.reactivate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.auth.user.index')
                        ->push(__('Deactivated Users'), route('admin.auth.user.deactivated'));
                });

            Route::get('/', [UserController::class, 'index'])
                ->name('index')
                ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.dashboard')
                        ->push(__('User Management'), route('admin.auth.user.index'));
                });

            Route::group(['prefix' => '{user}'], function () {
                Route::get('/', [UserController::class, 'show'])
                    ->name('show')
                    ->middleware('permission:admin.access.user.list')
                    ->breadcrumbs(function (Trail $trail, User $user) {
                        $trail->parent('admin.auth.user.index')
                            ->push($user->name, route('admin.auth.user.show', $user));
                    });

                Route::patch('mark/{status}', [DeactivatedUserController::class, 'update'])
                    ->name('mark')
                    ->where(['status' => '[0,1]'])
                    ->middleware('permission:admin.access.user.deactivate|admin.access.user.reactivate');

                Route::post('clear-session', [UserSessionController::class, 'update'])
                    ->name('clear-session')
                    ->middleware('permission:admin.access.user.clear-session');

                Route::get('password/change', [UserPasswordController::class, 'edit'])
                    ->name('change-password')
                    ->middleware('permission:admin.access.user.change-password')
                    ->breadcrumbs(function (Trail $trail, User $user) {
                        $trail->parent('admin.auth.user.show', $user)
                            ->push(__('Change Password'), route('admin.auth.user.change-password', $user));
                    });

                Route::patch('password/change', [UserPasswordController::class, 'update'])
                    ->name('change-password.update')
                    ->middleware('permission:admin.access.user.change-password');
            });
        });
    });

    Route::group([
        'prefix' => 'role',
        'as' => 'role.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [RoleController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Role Management'), route('admin.auth.role.index'));
            });

        Route::get('create', [RoleController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.role.index')
                    ->push(__('Create Role'), route('admin.auth.role.create'));
            });

        Route::post('/', [RoleController::class, 'store'])->name('store');

        Route::group(['prefix' => '{role}'], function () {
            Route::get('edit', [RoleController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Role $role) {
                    $trail->parent('admin.auth.role.index')
                        ->push(__('Editing :role', ['role' => $role->name]), route('admin.auth.role.edit', $role));
                });

            Route::patch('/', [RoleController::class, 'update'])->name('update');
            Route::delete('/', [RoleController::class, 'destroy'])->name('destroy');

            Route::get('view', [RoleController::class, 'lihatUser'])
                ->name('view')
                ->breadcrumbs(function (Trail $trail, $role) {
                    $namaRole = Role::where('id', $role)->first();
                    $trail->parent('admin.auth.role.index')
                        ->push(__('Senarai Pengguna :role', ['role' => ucwords(strtolower($namaRole->name))]), route('admin.auth.role.view', $role));
                });
        });
    });

    // START ROUTE KOD BIDANG
    Route::group([
        'prefix' => 'bidang',
        'as' => 'bidang.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [BidangController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Kod Bidang'), route('admin.auth.bidang.index'));
            });

        Route::get('create', [BidangController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.bidang.index')
                    ->push(__('Tambah Kod Bidang'), route('admin.auth.bidang.create'));
            });

        Route::post('/', [BidangController::class, 'store'])->name('store');

        Route::get('delete/{id}', [BidangController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{bidang}'], function () {
            Route::get('/', [BidangController::class, 'show'])
                ->name('show')
                ->breadcrumbs(function (Trail $trail, Bidang $bidang) {
                    $trail->parent('admin.auth.bidang.index')
                        ->push(__('Kemaskini Kod Bidang'), route('admin.auth.bidang.show', $bidang));
                });

            Route::patch('/', [BidangController::class, 'update'])->name('update');

            Route::get('edit', [BidangController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, Bidang $bidang) {
                        $trail->parent('admin.auth.bidang.index')
                            ->push(__('Sub Bidang'), route('admin.auth.bidang.edit', $bidang));
                    });

        });


    });
    // START ROUTE KOD BIDANG

    // START ROUTE SUB BIDANG
    Route::group([
        'prefix' => 'subBidang',
        'as' => 'subBidang.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {

        Route::post('/', [SubBidangController::class, 'store'])->name('store');
        Route::get('delete/{id}', [SubBidangController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{bidang}'], function () {

            Route::get('create', [SubBidangController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail, Bidang $bidang) {
                $trail->parent('admin.auth.bidang.index')
                    ->push(__('Sub Bidang'), route('admin.auth.bidang.edit', $bidang))
                    ->push(__('Tambah Sub Bidang'), route('admin.auth.subBidang.create', $bidang));
            });

        });

        Route::group(['prefix' => '{subBidang}'], function () {

            Route::get('edit', [SubBidangController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, SubBidang $subBidang) {
                        $trail->parent('admin.auth.bidang.index')
                            ->push(__('Sub Bidang'), route('admin.auth.bidang.edit', $subBidang->bidang_id))
                            ->push(__('Kemaskini Sub Bidang'), route('admin.auth.subBidang.edit', $subBidang));
                    });

            Route::patch('/', [SubBidangController::class, 'update'])->name('update');

        });

    });
    // END ROUTE SUB BIDANG

    Route::group([
        'middleware' => 'permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.reactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password',
    ], function () {
        Route::get('deactivated', [DeactivatedUserController::class, 'index'])
            ->name('deactivated')
            ->middleware('permission:admin.access.user.reactivate')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.user.index')
                    ->push(__('Deactivated Users'), route('admin.auth.user.deactivated'));
            });

        Route::get('/', [UserController::class, 'index'])
            ->name('index')
            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('User Management'), route('admin.auth.user.index'));
            });
    });

    // MODUL TETAPAN IKLAN
    Route::group([
        'prefix' => 'iklan',
        'as' => 'iklan.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        // MATRIK IKLAN
        Route::get('/matrik_iklan', [IklanController::class, 'index'])
            ->name('matrik_iklan')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Matrik Iklan'), route('admin.auth.iklan.matrik_iklan'));
            });

        Route::get('/matrik_iklan/create', [IklanController::class, 'create'])
        ->name('create_matrik')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.auth.iklan.matrik_iklan')
                ->push(__('Tambah Matrik Iklan'), route('admin.auth.iklan.create_matrik'));
        });

        Route::post('/matrik_iklan/simpan', [IklanController::class, 'simpan'])->name('simpan_matrik');
        Route::get('/matrik_iklan/padam_matrik_iklan/{id}', [IklanController::class, 'destroy'])->name('padam_matrik_iklan');

        Route::group(['prefix' => '{matrikIklan}'], function () {
            Route::get('edit_matrik_iklan', [IklanController::class, 'edit'])
                ->name('edit_matrik_iklan')
                ->breadcrumbs(function (Trail $trail, MatrikIklan $matrikIklan) {
                    $trail->parent('admin.auth.iklan.matrik_iklan', $matrikIklan)
                        ->push(__('Kemaskini Matrik Iklan'), route('admin.auth.iklan.edit_matrik_iklan', $matrikIklan));

                });

            Route::patch('update_matrik_iklan', [IklanController::class, 'update'])->name('update_matrik_iklan');
        });
        // JENIS IKLAN
        Route::get('/jenis_iklan', [JenisIklanController::class, 'index'])
            ->name('jenis_iklan')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Senarai Jenis Iklan'), route('admin.auth.iklan.jenis_iklan'));
        });

        Route::get('/jenis_iklan/create', [JenisIklanController::class, 'create'])
            ->name('create_jenis_iklan')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.iklan.jenis_iklan')
                    ->push(__('Tambah Jenis Iklan'), route('admin.auth.iklan.create_jenis_iklan'));
        });

        Route::post('/jenis_iklan/simpan', [JenisIklanController::class, 'simpanJenisIklan'])->name('simpan_jenis_iklan');
        Route::get('/jenis_iklan/delete/{id}', [JenisIklanController::class, 'destroy'])->name('delete');

        Route::group(['prefix' => '{jenisIklan}'], function () {
            Route::get('edit', [JenisIklanController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, JenisIklan $jenisIklan) {
                    $trail->parent('admin.auth.iklan.jenis_iklan', $jenisIklan)
                        ->push(__('Kemaskini Jenis Iklan'), route('admin.auth.iklan.edit', $jenisIklan));

            });

            Route::patch('/', [JenisIklanController::class, 'update'])->name('update');
        });
        // KATEGORI PEROLEHAN
        Route::get('/kategori_perolehan', [KategoriIklanController::class, 'index'])
            ->name('kategori_iklan')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Senarai Kategori Perolehan'), route('admin.auth.iklan.kategori_iklan'));
        });

        Route::get('/kategori_perolehan/create', [KategoriIklanController::class, 'create'])
            ->name('create_kategori_perolehan')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.iklan.kategori_iklan')
                    ->push(__('Tambah Kategori Perolehan'), route('admin.auth.iklan.create_kategori_perolehan'));
        });

        Route::post('/kategori_perolehan/simpan', [KategoriIklanController::class, 'simpanKategoriPerolehan'])->name('simpan_kategori_iklan');
        Route::get('/kategori_perolehan/padam_kategori_perolehan/{id}', [KategoriIklanController::class, 'destroy'])->name('padam_kategori_perolehan');

        Route::group(['prefix' => '{kategoriPerolehan}'], function () {
            Route::get('edit_kategori_perolehan', [KategoriIklanController::class, 'edit'])
                ->name('edit_kategori_perolehan')
                ->breadcrumbs(function (Trail $trail, KategoriPerolehan $kategoriPerolehan) {
                    $trail->parent('admin.auth.iklan.kategori_iklan', $kategoriPerolehan)
                        ->push(__('Kemaskini Kategori Perolehan'), route('admin.auth.iklan.edit_kategori_perolehan', $kategoriPerolehan));

                });

            Route::patch('update_kategori_perolehan', [KategoriIklanController::class, 'updateKategoriPerolehan'])->name('update_kategori_perolehan');
        });
        // JENIS TENDER
        Route::get('/jenis_tender', [JenisTenderController::class, 'index'])
            ->name('jenis_tender')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Senarai Perolehan'), route('admin.auth.iklan.jenis_tender'));
        });

        Route::get('/jenis_tender/create', [JenisTenderController::class, 'create'])
            ->name('create_jenis_tender')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.iklan.kategori_iklan')
                    ->push(__('Tambah Kategori Perolehan'), route('admin.auth.iklan.create_jenis_tender'));
        });

        Route::post('/jenis_tender/simpan', [JenisTenderController::class, 'store'])->name('simpan_jenis_tender');
        Route::get('/jenis_tender/padam/{id}', [JenisTenderController::class, 'destroy'])->name('padam');

        Route::group(['prefix' => '{jenisTender}'], function () {
            Route::get('edit_jenis_tender', [JenisTenderController::class, 'edit'])
                ->name('edit_jenis_tender')
                ->breadcrumbs(function (Trail $trail, JenisTender $jenisTender) {
                    $trail->parent('admin.auth.iklan.jenis_tender', $jenisTender)
                        ->push(__('Kemaskini Jenis Perolehan'), route('admin.auth.iklan.edit_jenis_tender', $jenisTender));

                });

            Route::patch('update_jenis_tender', [JenisTenderController::class, 'updateJenisTender'])->name('update_jenis_tender');
        });
    });
    // END OF TETAPAN IKLAN

    //START TETAPAN SISTEM

    //route alamat
    Route::group([
        'prefix' => 'alamat',
        'as' => 'alamat.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [AlamatController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Senarai Alamat'), route('admin.auth.alamat.index'));
            });

        Route::get('create', [AlamatController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.alamat.index')
                    ->push(__('Tambah Alamat'), route('admin.auth.alamat.create'));
            });

        Route::post('/', [AlamatController::class, 'store'])->name('store');
        Route::get('delete/{id}', [AlamatController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{alamat}'], function () {
            Route::get('edit', [AlamatController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, SenaraiAlamat $alamat) {
                    $trail->parent('admin.auth.alamat.index')
                        ->push(__('Kemaskini :alamat', ['alamat' => $alamat->name]), route('admin.auth.alamat.edit', $alamat));
                });

            Route::patch('/', [AlamatController::class, 'update'])->name('update');
        });
    });

    //route negeri
    Route::group([
        'prefix' => 'negeri',
        'as' => 'negeri.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [NegeriController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Senarai Pejabat JPS'), route('admin.auth.negeri.index'));
            });

        Route::get('create', [NegeriController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.negeri.index')
                    ->push(__('Tambah Pejabat JPS'), route('admin.auth.negeri.create'));
            });

        Route::post('/', [NegeriController::class, 'store'])->name('store');
        Route::get('delete/{id}', [NegeriController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{negeri}'], function () {
            Route::get('edit', [NegeriController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Negeri $negeri) {
                    $trail->parent('admin.auth.negeri.index')
                        ->push(__('Kemaskini :pejabat', ['negeri' => $negeri->name]), route('admin.auth.negeri.edit', $negeri));
                });

            Route::get('bahagian', [BahagianController::class, 'index'])
                ->name('bahagian')
                ->breadcrumbs(function (Trail $trail, Negeri $negeri) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Senarai Pejabat JPS'), route('admin.auth.negeri.index'))
                        ->push(__('Senarai Bahagian'), route('admin.auth.negeri.bahagian', $negeri));
            });

            Route::patch('/', [NegeriController::class, 'update'])->name('update');
        });
    });

    //END OF TETAPAN SISTEM

    // START ROUTE KOD KELAS
    Route::group([
        'prefix' => 'kelas',
        'as' => 'kelas.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [KelasController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Kategori'), route('admin.auth.kelas.index'));
            });

        Route::get('create', [KelasController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.kelas.index')
                    ->push(__('Tambah Kategori'), route('admin.auth.kelas.create'));
            });

        Route::post('/', [KelasController::class, 'store'])->name('store');

        Route::get('delete/{id}', [KelasController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{kelas}'], function () {
            Route::get('/', [KelasController::class, 'show'])
                ->name('show')
                ->breadcrumbs(function (Trail $trail, Kelas $kelas) {
                    $trail->parent('admin.auth.kelas.index')
                        ->push(__('Kemaskini Kategori'), route('admin.auth.kelas.show', $kelas));
                });

            Route::patch('/', [KelasController::class, 'update'])->name('update');

            Route::get('edit', [KelasController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, Kelas $kelas) {
                        $trail->parent('admin.auth.kelas.index')
                            ->push(__('Pengkhususan'), route('admin.auth.kelas.edit', $kelas));
                    });

        });


    });
    // START ROUTE KOD BIDANG

    // START ROUTE PENGKHUSUSAN
    Route::group([
        'prefix' => 'pengkhususan',
        'as' => 'pengkhususan.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {

        Route::post('/', [PengkhususanController::class, 'store'])->name('store');
        Route::get('delete/{id}', [PengkhususanController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{kelas}'], function () {

            Route::get('create', [PengkhususanController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail, Kelas $kelas) {
                $trail->parent('admin.auth.kelas.index')
                    ->push(__('Pengkhususan'), route('admin.auth.kelas.edit', $kelas))
                    ->push(__('Tambah Pengkhususan'), route('admin.auth.pengkhususan.create', $kelas));
            });

        });

        Route::group(['prefix' => '{pengkhususan}'], function () {

            Route::get('edit', [PengkhususanController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, Pengkhususan $pengkhususan) {
                        $trail->parent('admin.auth.kelas.index')
                            ->push(__('Pengkhususan'), route('admin.auth.kelas.edit', $pengkhususan->kelas_id))
                            ->push(__('Kemaskini Pengkhususan'), route('admin.auth.pengkhususan.edit', $pengkhususan));
                    });

            Route::patch('/', [PengkhususanController::class, 'update'])->name('update');

        });

    });
    // END ROUTE PENGKHUSUSAN

    //route bahagian
    Route::group([
        'prefix' => 'bahagian',
        'as' => 'bahagian.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::group(['prefix' => '{negeri}'], function () {
            Route::get('create', [BahagianController::class, 'create'])
                ->name('create')
                ->breadcrumbs(function (Trail $trail, Negeri $negeri) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Senarai Negeri'), route('admin.auth.negeri.index'))
                        ->push(__('Senarai Bahagian'), route('admin.auth.negeri.bahagian', $negeri))
                        ->push(__('Tambah Bahagian'), route('admin.auth.bahagian.create', $negeri));
            });
        });
        Route::post('/', [BahagianController::class, 'store'])->name('store');
        Route::get('delete/{id}', [BahagianController::class, 'delete'])->name('delete');


        Route::group(['prefix' => '{bahagian}'], function () {
            Route::get('edit', [BahagianController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Pejabat $bahagian) {
                    $trail->parent('admin.dashboard')
                    ->push(__('Senarai Negeri'), route('admin.auth.negeri.index'))
                    ->push(__('Senarai Bahagian'), route('admin.auth.negeri.bahagian', $bahagian->negeri_id))
                    ->push(__('Kemaskini Bahagian', ['bahagian' => $bahagian->name]), route('admin.auth.bahagian.edit', $bahagian));
                });

            Route::patch('/', [BahagianController::class, 'update'])->name('update');
        });
    });

    //route announcement
    Route::group([
        'prefix' => 'announcement',
        'as' => 'announcement.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [AnnouncementController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Pengumuman'), route('admin.auth.announcement.index'));
        });

        Route::get('create', [AnnouncementController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.announcement.index')
                    ->push(__('Tambah Pengumuman'), route('admin.auth.announcement.create'));
        });

        Route::post('/', [AnnouncementController::class, 'store'])->name('store');
        Route::get('delete/{id}', [AnnouncementController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{announcement}'], function () {
            Route::get('edit', [AnnouncementController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Announcement $announcement) {
                    $trail->parent('admin.auth.announcement.index')
                    ->push(__('Kemaskini Pengumuman'), route('admin.auth.bahagian.edit', $announcement));
                });

            Route::patch('/', [AnnouncementController::class, 'update'])->name('update');
        });

    });

    //START ROUTE MEMO LANTIKAN PENILAI
    Route::group([
        'prefix' => 'lantikanpenilai',
        'as' => 'lantikanpenilai.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [LantikanPenilaiController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Memo Lantikan Penilai'), route('admin.auth.lantikanpenilai.index'));
            });

        Route::group(['prefix' => '{lantikanpenilai}'], function () {
            Route::get('edit', [LantikanPenilaiController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, LantikanPenilai $lantikanpenilai) {
                    $trail->parent('admin.auth.lantikanpenilai.index')
                        ->push(__('Kemaskini', ['data' => $lantikanpenilai]), route('admin.auth.lantikanpenilai.edit', $lantikanpenilai));
                });

            Route::post('/', [LantikanPenilaiController::class, 'update'])->name('update');
        });

        Route::get('/downloadmemolantikan/{id}', [LantikanPenilaiController::class, 'generateMemoLantikanPenilai']);

    });
    //END ROUTE MEMO LANTIKAN PENILAI

    //START ROUTE KEPALA MEMO DAN SURAT
    Route::group([
        'prefix' => 'kepalasurat',
        'as' => 'kepalasurat.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [KepalaSuratController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Kepala Memo dan Surat'), route('admin.auth.kepalasurat.index'));
            });

        Route::group(['prefix' => '{headersurat}'], function () {
            Route::get('edit', [KepalaSuratController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, HeaderSurat $headersurat) {
                    $trail->parent('admin.auth.kepalasurat.index')
                        ->push(__('Kemaskini', ['data' => $headersurat]), route('admin.auth.kepalasurat.edit', $headersurat));
                });

            Route::post('/', [KepalaSuratController::class, 'update'])->name('update');
        });

    });
    //END ROUTE KEPALA MEMO DAN SURAT

    //START ROUTE MAKLUMAT PENGARAH
    Route::group([
        'prefix' => 'infopengarah',
        'as' => 'infopengarah.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [InfoPengarahController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Maklumat Pengarah'), route('admin.auth.infopengarah.index'));
            });

        Route::group(['prefix' => '{tandatangan}'], function () {
            Route::get('edit', [InfoPengarahController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Tandatangan $tandatangan) {
                    $trail->parent('admin.auth.infopengarah.index')
                        ->push(__('Kemaskini', ['data' => $tandatangan]), route('admin.auth.infopengarah.edit', $tandatangan));
                });

            Route::post('/', [InfoPengarahController::class, 'update'])->name('update');
        });

    });
    //END ROUTE MAKLUMAT PENGARAH
    //START ROUTE SURAT AKUAN PELANTIKAN
    Route::group([
        'prefix' => 'akuanpelantikan',
        'as' => 'akuanpelantikan.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [AkuanPelantikanController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Surat Akuan Pelantikan'), route('admin.auth.akuanpelantikan.index'));
            });

        Route::group(['prefix' => '{pelantikan}'], function () {
            Route::get('edit', [AkuanPelantikanController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Pelantikan $pelantikan) {
                    $trail->parent('admin.auth.akuanpelantikan.index')
                        ->push(__('Kemaskini', ['data' => $pelantikan]), route('admin.auth.akuanpelantikan.edit', $pelantikan));
                });

            Route::post('/', [AkuanPelantikanController::class, 'update'])->name('update');
        });

        Route::get('/downloadakuanlantikan/{id}', [AkuanPelantikanController::class, 'generateakuanlantikan']);

    });
    //END ROUTE SURAT AKUAN PELANTIKAN
    //START ROUTE SURAT AKUAN SELESAI TUGAS
    Route::group([
        'prefix' => 'selesaitugas',
        'as' => 'selesaitugas.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [SelesaiTugasController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Surat Akuan Selesai Tugas'), route('admin.auth.selesaitugas.index'));
            });

        Route::group(['prefix' => '{selesaitugas}'], function () {
            Route::get('edit', [SelesaiTugasController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, SelesaiTugas $selesaitugas) {
                    $trail->parent('admin.auth.selesaitugas.index')
                        ->push(__('Kemaskini', ['data' => $selesaitugas]), route('admin.auth.selesaitugas.edit', $selesaitugas));
                });

            Route::post('/', [SelesaiTugasController::class, 'update'])->name('update');
        });

        Route::get('/downloadselesaitugas/{id}', [SelesaiTugasController::class, 'generateselesaitugas']);

    });
    //END ROUTE SURAT AKUAN SELESAI TUGAS
    //START ROUTE SURAT HANTAR DOKUMEN
    Route::group([
        'prefix' => 'hantardokumen',
        'as' => 'hantardokumen.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [HantarDokumenController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Surat Hantar Dokumen'), route('admin.auth.hantardokumen.index'));
            });

        Route::group(['prefix' => '{hantardokumen}'], function () {
            Route::get('edit', [HantarDokumenController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, HantarDokumen $hantardokumen) {
                    $trail->parent('admin.auth.hantardokumen.index')
                        ->push(__('Kemaskini', ['data' => $hantardokumen]), route('admin.auth.hantardokumen.edit', $hantardokumen));
                });

            Route::post('/', [HantarDokumenController::class, 'update'])->name('update');
        });

        Route::get('/downloadhantardokumen/{id}', [HantarDokumenController::class, 'generatehantardokumen']);

    });
    //END ROUTE SURAT HANTAR DOKUMEN
    //START ROUTE SURAT LANJUT SAH LAKU
    Route::group([
        'prefix' => 'sahlaku',
        'as' => 'sahlaku.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [LanjutSahLakuController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Surat Lanjut Sah laku'), route('admin.auth.sahlaku.index'));
            });

        Route::group(['prefix' => '{lanjutsahlaku}'], function () {
            Route::get('edit', [LanjutSahLakuController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, LanjutSahLaku $lanjutsahlaku) {
                    $trail->parent('admin.auth.sahlaku.index')
                        ->push(__('Kemaskini', ['data' => $lanjutsahlaku]), route('admin.auth.sahlaku.edit', $lanjutsahlaku));
                });

            Route::post('/', [LanjutSahLakuController::class, 'update'])->name('update');
        });

        Route::get('/downloadsahlaku/{id}', [LanjutSahLakuController::class, 'generatesahlaku']);

    });
    //END ROUTE SURAT LANJUT SAH LAKU
    //START ROUTE SURAT EDAR KEPUTUSAN
    Route::group([
        'prefix' => 'suratkeputusan',
        'as' => 'suratkeputusan.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [SuratKeputusanController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Surat Edar Keputusan'), route('admin.auth.suratkeputusan.index'));
            });

        Route::group(['prefix' => '{suratedarkeputusan}'], function () {
            Route::get('edit', [SuratKeputusanController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, SuratEdarKeputusan $suratedarkeputusan) {
                    $trail->parent('admin.auth.suratkeputusan.index')
                        ->push(__('Kemaskini', ['data' => $suratedarkeputusan]), route('admin.auth.suratkeputusan.edit', $suratedarkeputusan));
                });

            Route::post('/', [SuratKeputusanController::class, 'update'])->name('update');
        });

        Route::get('/downloadsuratkeputusan/{id}', [SuratKeputusanController::class, 'generatesuratkeputusan']);

    });
    //END ROUTE SURAT EDAR KEPUTUSAN
    //START ROUTE MEMO EDAR KEPUTUSAN
    Route::group([
        'prefix' => 'memokeputusan',
        'as' => 'memokeputusan.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [MemoKeputusanController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Memo Edar Keputusan'), route('admin.auth.memokeputusan.index'));
            });

        Route::group(['prefix' => '{memoedarkeputusan}'], function () {
            Route::get('edit', [MemoKeputusanController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, MemoEdarKeputusan $memoedarkeputusan) {
                    $trail->parent('admin.auth.memokeputusan.index')
                        ->push(__('Kemaskini', ['data' => $memoedarkeputusan]), route('admin.auth.memokeputusan.edit', $memoedarkeputusan));
                });

            Route::post('/', [MemoKeputusanController::class, 'update'])->name('update');
        });

        Route::get('/downloadmemokeputusan/{id}', [MemoKeputusanController::class, 'generatememokeputusan']);

    });
    //END ROUTE MEMO EDAR KEPUTUSAN

    //Start routing for upload sst
    Route::group([
        'prefix' => 'sst',
        'as' => 'sst.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [SSTController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Templat Borang SST'), route('admin.auth.sst.index'));
            });


        Route::post('/', [SSTController::class, 'update'])->name('update');
        Route::get('file/{file}', function($file)
        {
            $path = storage_path().'/app/public/tetapanTemplate/'.$file;
            if (file_exists($path)) {
                return Response::download($path);
            }
        });

    });
    //End routing for upload sst

    //START ROUTE BAYARAN KEPADA2
    Route::group([
        'prefix' => 'bayaran',
        'as' => 'bayaran.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [BayaranController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Senarai Bayaran Kepada'), route('admin.auth.bayaran.index'));
            });

        Route::get('create', [BayaranController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Senarai Bayaran Kepada'), route('admin.auth.bayaran.index'))
                    ->push(__('Tambah Bayaran Kepada'), route('admin.auth.bayaran.create'));
        });
        Route::post('/', [BayaranController::class, 'store'])->name('store');
        Route::get('delete/{id}', [BayaranController::class, 'delete'])->name('delete');
        Route::group(['prefix' => '{bayarKepada}'], function () {
            Route::get('edit', [BayaranController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, BayarKepada $bayarKepada) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Senarai Bayaran Kepada'), route('admin.auth.bayaran.index'))
                        ->push(__('Kemaskini Bayaran Kepada'), route('admin.auth.bayaran.edit', $bayarKepada));
                });

            Route::patch('/', [BayaranController::class, 'update'])->name('update');
        });

    });
    //END ROUTE MEMO EDAR KEPUTUSAN
    //ROUTE UPKJ
    Route::group([
        'prefix' => 'upkj',
        'as' => 'upkj.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [UpkjController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('UPKJ'), route('admin.auth.upkj.index'));
            });

        Route::get('create', [UpkjController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.upkj.index')
                    ->push(__('Tambah UPKJ'), route('admin.auth.upkj.create'));
            });

        Route::post('/', [UpkjController::class, 'store'])->name('store');

        Route::get('delete/{id}', [UpkjController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{upkj}'], function () {
            Route::get('/', [UpkjController::class, 'show'])
                ->name('show')
                ->breadcrumbs(function (Trail $trail, KelasUpkj $upkj) {
                    $trail->parent('admin.auth.upkj.index')
                        ->push(__('Kemaskini UPKJ'), route('admin.auth.upkj.show', $upkj));
                });

            Route::patch('/', [UpkjController::class, 'update'])->name('update');

            Route::get('subupkj', [UpkjController::class, 'subupkj'])
                    ->name('subupkj')
                    ->breadcrumbs(function (Trail $trail, KelasUpkj $upkj) {
                        $trail->parent('admin.auth.upkj.index')
                            ->push(__('Sub UPKJ'), route('admin.auth.upkj.subupkj', $upkj));
                    });

        });

    });

    //ROUTE SUBUPKJ
    Route::group([
        'prefix' => 'subUpkj',
        'as' => 'subUpkj.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {

        Route::post('/', [SubUpkjController::class, 'store'])->name('store');
        Route::get('delete/{id}', [SubUpkjController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{upkj}'], function () {

            Route::get('create', [SubUpkjController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail, KelasUpkj $upkj) {
                $trail->parent('admin.auth.upkj.index')
                    ->push(__('Sub Upkj'), route('admin.auth.upkj.subupkj', $upkj))
                    ->push(__('Tambah Sub Upkj'), route('admin.auth.subUpkj.create', $upkj));
            });

        });

        Route::group(['prefix' => '{subUpkj}'], function () {

            Route::get('edit', [SubUpkjController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, SubKelasUpkj $subUpkj) {
                        $trail->parent('admin.auth.upkj.index')
                            ->push(__('Sub UPKJ'), route('admin.auth.upkj.subupkj', $subUpkj->tajuk_id))
                            ->push(__('Kemaskini Sub UPKJ'), route('admin.auth.subUpkj.edit', $subUpkj));
                    });

            Route::patch('/', [SubUpkjController::class, 'update'])->name('update');

        });

    });
    // START ROUTE KELAS PUKONSA
    Route::group([
        'prefix' => 'pukonsa',
        'as' => 'pukonsa.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {
        Route::get('/', [PukonsaController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Kelas Pukonsa'), route('admin.auth.pukonsa.index'));
            });

        Route::get('create', [PukonsaController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.auth.pukonsa.index')
                    ->push(__('Tambah Kelas Pukonsa'), route('admin.auth.pukonsa.create'));
            });

        Route::post('/', [PukonsaController::class, 'store'])->name('store');

        Route::get('delete/{id}', [PukonsaController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{kelasPukonsa}'], function () {
            Route::get('/', [PukonsaController::class, 'show'])
                ->name('show')
                ->breadcrumbs(function (Trail $trail, KelasPukonsa $kelasPukonsa) {
                    $trail->parent('admin.auth.pukonsa.index')
                        ->push(__('Kemaskini Kelas Pukonsa'), route('admin.auth.pukonsa.show', $kelasPukonsa));
                });

            Route::patch('/', [PukonsaController::class, 'update'])->name('update');

            Route::get('edit', [PukonsaController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, KelasPukonsa $kelasPukonsa) {
                        $trail->parent('admin.auth.pukonsa.index')
                            ->push(__('Sub Kelas Pukonsa'), route('admin.auth.pukonsa.edit', $kelasPukonsa));
                    });

        });
    });
    // END ROUTE KELAS PUKONSA

    // START ROUTE SUB Kelas Pukonsa
    Route::group([
        'prefix' => 'subKelasPukonsa',
        'as' => 'subKelasPukonsa.',
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
    ], function () {

        Route::post('/', [SubKelasPukonsaController::class, 'store'])->name('store');
        Route::get('delete/{id}', [SubKelasPukonsaController::class, 'delete'])->name('delete');

        Route::group(['prefix' => '{kelasPukonsa}'], function () {

            Route::get('create', [SubKelasPukonsaController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail, KelasPukonsa $kelasPukonsa) {
                $trail->parent('admin.auth.pukonsa.index')
                    ->push(__('Sub Kelas Pukonsa'), route('admin.auth.bidang.edit', $kelasPukonsa))
                    ->push(__('Tambah Sub Kelas Pukonsa'), route('admin.auth.subBidang.create', $kelasPukonsa));
            });

        });

        Route::group(['prefix' => '{subKelasPukonsa}'], function () {

            Route::get('edit', [SubKelasPukonsaController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, SubKelasPukonsa $subKelasPukonsa) {
                        $trail->parent('admin.auth.pukonsa.index')
                            ->push(__('Sub Kelas Pukonsa'), route('admin.auth.pukonsa.edit', $subKelasPukonsa->tajuk_id))
                            ->push(__('Kemaskini Sub Kelas Pukonsa'), route('admin.auth.subKelasPukonsa.edit', $subKelasPukonsa));
                    });

            Route::patch('/', [SubKelasPukonsaController::class, 'update'])->name('update');
        });

    });

    // END ROUTE SUB KELAS PUKONSA
});
