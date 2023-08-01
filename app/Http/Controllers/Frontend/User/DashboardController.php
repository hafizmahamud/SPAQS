<?php
/**
 * File DashboardController.
 *
 * PHP Version 8.0
 *
 * @category DashboardController
 * @package  DashboardController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Controllers\Frontend\User;
use App\Models\ModelHasRoles;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Tunas\Models\BorangDaftarMinat;
use Modules\Awas\Models\PenilaianPerolehan;
use Modules\Awas\Models\DokumenSST;
use Modules\Awas\Models\DokumenKontrak;

/**
 * Class DashboardController.
 *
 * @category DashboardController
 * @package  DashboardController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class DashboardController
{
    /**
     * Dashboard
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $role = "";
            $all_role = [];
            $sisdant = 0;
            $tunas = 0;
            $awas = 0;
            $checkrole = ModelHasRoles::where('model_id', $user->id)->get();

            for ($i=0; $i < count($checkrole); $i++) {
                if ($checkrole[$i]->role_id  == "2") {
                    $role = "PENTADBIR SISTEM";
                } else if ($checkrole[$i]->role_id  == "3") {
                    $role = "PENGESAH NOMBOR PEROLEHAN";
                } else if ($checkrole[$i]->role_id  == "4") {
                    $role = "PENGIKLAN";
                } else if ($checkrole[$i]->role_id  == "5") {
                    $role = "PENYARING PETENDER";
                } else if ($checkrole[$i]->role_id  == "6") {
                    $role = "PENDAFTAR JADUAL HARGA";
                } else if ($checkrole[$i]->role_id  == "7") {
                    $role = "PENDAFTAR PENILAI";
                } else if ($checkrole[$i]->role_id  == "8") {
                    $role = "PEGAWAI PENILAI 1";
                } else if ($checkrole[$i]->role_id  == "9") {
                    $role = "PEGAWAI PENILAI 2";
                } else if ($checkrole[$i]->role_id  == "10") {
                    $role = "PENDAFTAR KEPUTUSAN LP";
                } else if ($checkrole[$i]->role_id  == "11") {
                    $role = "PENYEDIA DOKUMEN";
                } else if ($checkrole[$i]->role_id  == "12") {
                    $role = "PELAKSANA";
                }

                array_push($all_role, $role);
            }

            if (in_array('PELAKSANA', $all_role)) {
                // status = 'sah' -> selepas pengesahan untuk kemaskini pertama kali
                // status = 'draf-iklan' -> simpan selepas kemaskini
                $pelaksana = PermohonanNomborPerolehan::with('users')
                    ->whereHas(
                        'users', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->where('status', 'draf-iklan')
                    ->where('user_id', $user->id)
                    ->count();

                $sisdant = $sisdant + $pelaksana;

                $id_mohon = [];
                $no_perolehan = PermohonanNomborPerolehan::with('users')
                    ->whereHas(
                        'users', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->where('user_id', $user->id)
                    ->where('status', 'sah')->get();

                for ($i=0; $i < count($no_perolehan); $i++) {
                    array_push($id_mohon, $no_perolehan[$i]->id_perolehan);
                }

                $iklan_per = IklanPerolehan::whereIn('mohon_no_perolehan_id', $id_mohon)->count();

                $kemaskini_per = count($no_perolehan) - $iklan_per;

                $sisdant = $sisdant + $kemaskini_per;

            }

            if (in_array('PENGESAH NOMBOR PEROLEHAN', $all_role)) {
                // status = 'belum sah' -> perlukan pengesahan
                $pengesah_no_perolehan = PermohonanNomborPerolehan::with('users')
                    ->whereHas(
                        'users', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->where('status', 'belum sah')->count();
                $sisdant = $sisdant + $pengesah_no_perolehan;
            }

            if (in_array('PENGIKLAN', $all_role)) {
                // status = 2 (BAHARU) -> baharu diiklankan dan perlu kemaskini dokumen tender
                // status = 3 (DERAF) -> apabila dia simpan selepas kemaskini dokumen tender
                $pengiklan = IklanPerolehan::with('user')
                    ->whereHas(
                        'user', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->whereIn('status_iklan_id', [2,3])->count();
                $tunas = $tunas + $pengiklan;
            }

            if (in_array('PENDAFTAR JADUAL HARGA', $all_role)) {
                // status_iklan_id = 5 (TUTUP) -> Perlu kemaskini jadual harga
                $pendaftar_jadual_harga = IklanPerolehan::with('user')
                    ->whereHas(
                        'user', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->where('status_iklan_id', 5)
                    ->whereIn('jadual_harga_status', ['TINDAKAN', 'DRAF'])
                    ->count();
                $tunas = $tunas + $pendaftar_jadual_harga;
            }

            if (in_array('PENYARING PETENDER', $all_role)) {
                // status_petender = dalam proses -> maksudnya belum berjaya, penyaring petender yang perlu jayakan
                $penyaring_petender = BorangDaftarMinat::where('status_petender', 'dalam proses')
                                        ->count();
                $tunas = $tunas + $penyaring_petender;
            }

            if (in_array('PENDAFTAR PENILAI', $all_role)) {
                // tarikh_kemaskini_penilaian = null -> belum dinilai
                // status_iklan_id = 5 (TUTUP)
                // jenis_iklan_id = 2 (TENDER)
                $pendaftar_penilai = IklanPerolehan::with('user')
                    ->whereHas(
                        'user', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->with('mohonNoPerolehan.matrikIklan')
                    ->whereHas(
                        'mohonNoPerolehan.matrikIklan', function ($query) {
                            $query->where('jenis_iklan_id', 2);
                        }
                    )
                    ->where('status_iklan_id', 5)
                    ->where('jadual_harga_status', 'SELESAI')
                    ->where('tarikh_kemaskini_penilaian', null)
                    ->count();
                $awas = $awas + $pendaftar_penilai;

                $surat_ke_kasa = PenilaianPerolehan::with('iklanPerolehan')
                    ->with('iklanPerolehan.user')
                    ->whereHas(
                        'iklanPerolehan.user', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->with('iklanPerolehan.mohonNoPerolehan.matrikIklan')
                    ->whereHas(
                        'iklanPerolehan', function ($query) {
                            $query->where('status_iklan_id', 5);
                        }
                    )
                    ->whereHas(
                        'iklanPerolehan.mohonNoPerolehan.matrikIklan', function ($query) {
                            $query->where('jenis_iklan_id', 2);
                        }
                    )
                    ->where('status_penilaian', 0)
                    ->count();

                $awas = $awas + $surat_ke_kasa;
            }

            if (in_array('PENDAFTAR KEPUTUSAN LP', $all_role)) {

                // PORTAL
                $pendaftar_keputusan_portal = PenilaianPerolehan::with('iklanPerolehan')
                    ->whereHas(
                        'iklanPerolehan', function ($query) {
                            $query->where('status_kemaskini_penilaian', '=', '1');
                        }
                    )
                    ->with('iklanPerolehan.user')
                    ->whereHas(
                        'iklanPerolehan.user', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->whereNotIn('status_penilaian', ['0', 'syor_tamat'])
                    ->count();
                $awas = $awas + $pendaftar_keputusan_portal;

                // E-Perolehan
                // status_iklan_id = 7 (E-PEROLEHAN)
                // jenis_iklan_id = 2 (TENDER)
                $id_ep_awas = [];
                $pendaftar_keputusan_ep = IklanPerolehan::with('user')
                    ->whereHas(
                        'user', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->with('mohonNoPerolehan.matrikIklan')
                    ->whereHas(
                        'mohonNoPerolehan.matrikIklan', function ($query) {
                            $query->where('jenis_iklan_id', 2);
                        }
                    )
                    ->where('status_iklan_id', 7)
                    ->get();

                for ($i=0; $i < count($pendaftar_keputusan_ep); $i++) {
                    array_push($id_ep_awas, $pendaftar_keputusan_ep[$i]->id);
                }
                $id_penilaian_ep = PenilaianPerolehan::whereIn('iklan_perolehan_id', $id_ep_awas)->count();
                $keputusan_ep = count($pendaftar_keputusan_ep) - $id_penilaian_ep;


                $awas = $awas + $keputusan_ep;


            }

            if (in_array('PENYEDIA DOKUMEN', $all_role)) {

                $id_penilaian = [];
                // status_penilaian = syor_tamat -> sudah ada keputusan
                $penilaian = PenilaianPerolehan::select('id')
                    ->with('iklanPerolehan.user')
                    ->whereHas(
                        'iklanPerolehan.user', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->where('status_penilaian', 'syor_tamat')->get();

                for ($i=0; $i < count($penilaian); $i++) {
                    array_push($id_penilaian, $penilaian[$i]->id);
                }

                $sst = DokumenSST::whereIn('penilaian_perolehan_id', $id_penilaian)->count();

                $penyedia_dokumen_sst = count($penilaian) - $sst;

                $awas = $awas + $penyedia_dokumen_sst;

                $id_iklan = [];
                // status_penilaian = syor_tamat -> sudah ada keputusan
                $iklan_perolehan = PenilaianPerolehan::select('iklan_perolehan_id')
                    ->with('iklanPerolehan.user')
                    ->whereHas(
                        'iklanPerolehan.user', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->where('status_penilaian', 'syor_tamat')->get();
                for ($i=0; $i < count($iklan_perolehan); $i++) {
                    array_push($id_iklan, $iklan_perolehan[$i]->iklan_perolehan_id);
                }

                $dokumen_kontrak = DokumenKontrak::whereIn('iklan_perolehan_id', $id_iklan)->count();

                $penyedia_dokumen_kontrak = count($iklan_perolehan) - $dokumen_kontrak;

                $awas = $awas + $penyedia_dokumen_kontrak;

            }

            if (auth()->user()->isAdmin()) {
                return view('backend.dashboard');
            } else {
                return view('frontend.user.dashboard', compact('sisdant', 'tunas', 'awas'));
            }

        }
        return view('frontend.auth.login');
    }
}
