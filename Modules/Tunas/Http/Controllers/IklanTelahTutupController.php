<?php

namespace Modules\Tunas\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Tunas\Models\KehadiranLawatanTapak;
use Modules\Tunas\Models\BorangDaftarMinat;
use Modules\Tunas\Models\JadualHarga;
use App\Models\ModelHasRoles;
use DataTables;

class IklanTelahTutupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // role = Pengiklan
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "6"){
                $type = "PENDAFTAR JADUAL HARGA";
            }
        }
        $today = date("Y-m-d");

        IklanPerolehan::where('status_iklan_id' , 4 )->whereDate('tarikh_waktu_tutup', '<=', $today) -> update(
            [
            'status_iklan_id'=> 5,
            'jadual_harga_status' => 'TINDAKAN',
            ]
        );

        if( $type == "PENDAFTAR JADUAL HARGA") {

            return view('tunas::iklanTelahTutup');
        } else {
            return redirect('/dashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     * * @param int $id
     * @return Renderable
     */
    public function jadualHarga($id)
    {
        $iklantutup  = IklanPerolehan::where('id', $id) -> with('mohonNoPerolehan.negeri', 'mohonNoPerolehan.matrikIklan.jenisIklan', 'mohonNoPerolehan.matrikIklan.kategoriPerolehan')
                    ->where('status_iklan_id', 5)
                    ->first();

        $jadualHarga = JadualHarga::where('iklan_perolehan_id', $id)
                    ->with('syarikat')
                    ->get();

        $syarikat  = BorangDaftarMinat::where('iklan_perolehan_id', $id)->where('status_resit', 'sah')
                    ->get();

        $syarikatform  = BorangDaftarMinat::where('iklan_perolehan_id', $id)->where('status_resit', 'sah')
                    ->get();

        return view('tunas::jadualHarga', compact('iklantutup', 'syarikat', 'syarikatform', 'jadualHarga'));
    }

    /**
     * Update profile user.
     *
     * @param  Request $request
     * @param  int     $id
     * @return Renderable
     */
    public function tambahJadualHarga(Request $request, $id)
    {
        $jadualHarga = JadualHarga::where('iklan_perolehan_id', $id)->get();
        $jadulHargaCount = $jadualHarga->count();

        $rs = new JadualHarga;
        $rs->iklan_perolehan_id = $id;
        $rs->syarikat_id = $request->syarikat;
        $rs->rujukan = $jadulHargaCount + 1;
        $rs->harga = $request->harga;
        $rs->tempoh = $request->tempoh;
        $rs->bulan_minggu = $request->bulan;
        $rs->catatan = $request->catatan;
        $rs->save();

        $Response   = array(
            'success' => '1',
        );
        return response($rs, 200, compact('Response'));
    }

    /**
     * Update profile user.
     *
     * @param  int     $id
     * @return Renderable
     */
    public function padamJadualHarga($id)
    {
        $iklan_perolehan_id = JadualHarga::where('id', $id)->first();
        $rs = JadualHarga::where('id', $id)->delete();
        $jadualHarga_all = JadualHarga::where('iklan_perolehan_id', $iklan_perolehan_id->iklan_perolehan_id)->get();

        for ($i=0; $i<count($jadualHarga_all); $i++) {
            $jadual = JadualHarga::where('id', $jadualHarga_all[$i]->id) -> update(
                [
                'rujukan'=> $i + 1,
                ]
            );
        }

        $Response   = array(
            'success' => '1',
        );
        return response($rs, 200, compact('Response'));
    }

    /**
     * Update profile user.
     *
     * @param  int     $id
     * @return Renderable
     */
    public function senaraiJadualHarga($id)
    {
        $iklantutup  = IklanPerolehan::where('id', $id) -> with('mohonNoPerolehan.negeri', 'mohonNoPerolehan.matrikIklan.jenisIklan', 'mohonNoPerolehan.matrikIklan.kategoriPerolehan')
                    ->where('status_iklan_id', 5)
                    ->first();

        $jadualHarga = JadualHarga::where('iklan_perolehan_id', $id)
                    ->with('syarikat')
                    ->get();

        return view('tunas::modaljadualHarga', compact('iklantutup', 'jadualHarga'));
    }

     /**
     * Update profile user.
     *
     * @param  Request $request
     * @return Renderable
     */
    public function hantarJadualHarga(Request $request)
    {
        $simpan = $request->input('simpan');
        $tindakan = $request->input('tindakan');

        $jadual_harga = $request->input('jadual_harga');  //here scores is the input array param

        foreach($jadual_harga as $row){
            $jadual = JadualHarga::where('id', $row['id']) -> update(
                [
                'harga'=>$row['harga'],
                'tempoh'=>$row['tempoh'],
                'bulan_minggu'=>$row['bulan'],
                'catatan'=>$row['catatan'],
                ]
            );
        }

        if ($simpan) {

            IklanPerolehan::where('id', $request->input('iklan_perolehan_id'))->update(
                [
                'jadual_harga_status'=> 'DRAF',
                ]
            );

            $msg = 'Jadual Harga Berjaya Disimpan.';

        } else if ($tindakan == 'iklankan') {
            IklanPerolehan::where('id', $request->input('iklan_perolehan_id'))->update(
                [
                'jadual_harga_status'=> 'SELESAI',
                ]
            );

            $msg = 'Jadual Harga Berjaya Diiklankan.';

        } else if ($tindakan == 'kemaskini'){

            $msg = 'Jadual Harga Berjaya Dikemaskini.';
        }

        return redirect()->back()->withFlashSuccess(__($msg));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function senaraiIklanTelahTutup()
    {
        return view('tunas::SenaraiIklanTelahTutup');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function petenderBerjaya()
    {
        return view('tunas::petenderBerjaya');
    }

}
