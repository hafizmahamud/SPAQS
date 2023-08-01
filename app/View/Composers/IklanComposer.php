<?php
/**
 * IklanComposer File.
 *
 * PHP Version 8.0
 *
 * @category IklanComposer
 * @package  IklanComposer
 * @author   Nurul Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\View\Composers;

use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Tunas\Models\BorangDaftarMinat;
use Modules\Awas\Models\PenilaianPerolehan;
use Modules\Awas\Models\DokumenSST;
use Modules\Awas\Models\DokumenKontrak;
use App\Domains\Auth\Models\User;
use Illuminate\View\View;

/**
 * Class IklanComposer.
 *
 * PHP Version 8.0
 *
 * @category IklanComposer
 * @package  IklanComposer
 * @author   Nurul Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class IklanComposer
{
    /**
     * Get Status
     *
     * @param View $view comment disabled
     *
     * @return Renderable
     */
    public function compose(View $view)
    {

        $user = auth()->user();
        $status = "";
        $status_array = [];
        if ($user) {
            // SISDANT

            // PENTADBIR
            $admin  = User::where('active', '!=', 1)->count();

            if ($admin != 0) {
                $status = 'TIDAK AKTIF';
                array_push($status_array, $status);
            }

            // PELAKSANA
            // status = 'sah' -> selepas pengesahan untuk kemaskini pertama kali
            // status = 'draf-iklan' -> simpan selepas kemaskini
            $pelaksana = PermohonanNomborPerolehan::with('users')
                ->whereHas(
                    'users', function ($query) {
                            $query->where('deleted_at', null);
                    }
                )
                ->whereIn('status', ['sah','draf-iklan'])
                ->where('user_id', $user->id)
                ->count();

            if ($pelaksana != 0) {
                $status = 'PELAKSANA KEMASKINI';
                array_push($status_array, $status);
            }

            // PENGESAH NOMBOR PEROLEHAN
            // status = 'belum sah' -> perlukan pengesahan
            $pengesah_no_perolehan = PermohonanNomborPerolehan::with('users')
                ->whereHas(
                    'users', function ($query) {
                            $query->where('deleted_at', null);
                    }
                )
                ->where('status', 'belum sah')->count();

            if ($pengesah_no_perolehan != 0) {
                $status = 'PENGESAH';
                array_push($status_array, $status);
            }

            // TUNAS

            // PENGIKLAN
            // status = 2 (BAHARU) -> baharu diiklankan dan perlu kemaskini dokumen tender
            // status = 3 (DERAF) -> apabila dia simpan selepas kemaskini dokumen tender
            $pengiklan = IklanPerolehan::with('user')
                ->whereHas(
                    'user', function ($query) {
                            $query->where('deleted_at', null);
                    }
                )
                ->whereIn('status_iklan_id', [2,3])->count();

            if ($pengiklan != 0) {
                $status = 'KEMASKINI TENDER';
                array_push($status_array, $status);
            }

            // PENYARING PETENDER
             // status_petender = dalam proses -> maksudnya belum berjaya, penyaring petender yang perlu jayakan
            $penyaring_petender = BorangDaftarMinat::where('status_petender', 'dalam proses')
                                        ->count();

            if ($penyaring_petender != 0) {
                $status = 'PENYARING PETENDER';
                array_push($status_array, $status);
            }

            // PENDAFTAR JADUAL HARGA
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

            if ($pendaftar_jadual_harga != 0) {
                $status = 'JADUAL HARGA';
                array_push($status_array, $status);
            }

            // PENDAFTAR PENILAI
            // tarikh_kemaskini_penilaian = null -> belum dinilai
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

            if ($pendaftar_penilai != 0) {
                $status = 'PENILAIAN';
                array_push($status_array, $status);
            }

            // SURAT KE KASA
            $surat_ke_kasa = PenilaianPerolehan::with('iklanPerolehan')
                ->with('iklanPerolehan.mohonNoPerolehan.matrikIklan')
                ->with('iklanPerolehan.user')
                ->whereHas(
                    'iklanPerolehan.user', function ($query) {
                            $query->where('deleted_at', null);
                    }
                )
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

            if ($surat_ke_kasa != 0) {
                $status = 'SURAT KE KASA';
                array_push($status_array, $status);
            }

            // PENDAFTAR KEPUTUSAN LP
            // PORTAL
            $pendaftar_keputusan = PenilaianPerolehan::with('iklanPerolehan')
                ->with('iklanPerolehan.user')
                ->whereHas(
                    'iklanPerolehan.user', function ($query) {
                            $query->where('deleted_at', null);
                    }
                )
                ->whereHas(
                    'iklanPerolehan', function ($query) {
                            $query->where('status_kemaskini_penilaian', '=', '1');
                    }
                )
                ->whereNotIn('status_penilaian', ['0', 'syor_tamat'])
                ->count();

            if ($pendaftar_keputusan != 0) {
                $status = 'KEPUTUSAN PORTAL';
                array_push($status_array, $status);
            }

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
            $id_penilaian_ep = PenilaianPerolehan::with('iklanPerolehan.user')
                ->whereHas(
                    'iklanPerolehan.user', function ($query) {
                            $query->where('deleted_at', null);
                    }
                )
                ->whereIn('iklan_perolehan_id', $id_ep_awas)->count();
            $keputusan_ep = count($pendaftar_keputusan_ep) - $id_penilaian_ep;

            if ($keputusan_ep != 0) {
                $status = 'KEPUTUSAN EP';
                array_push($status_array, $status);
            }

            // PENYEDIA DOKUMEN
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

            if ($penyedia_dokumen_sst != 0) {
                $status = 'DOKUMEN SST';
                array_push($status_array, $status);
            }

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

            if ($penyedia_dokumen_kontrak != 0) {
                $status = 'DOKUMEN KONTRAK';
                array_push($status_array, $status);
            }

        }

        $view->with('status', $status_array);
    }
}
