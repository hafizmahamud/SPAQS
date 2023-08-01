<?php

namespace Modules\Tunas\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sisdant\Models\IklanPerolehan;
use App\Domains\Auth\Models\User;
use Modules\Tunas\Models\KehadiranLawatanTapak;
use Modules\Tunas\Models\JadualHarga;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Tunas\Models\TemplatBorangDaftar;
use Modules\Tunas\Models\BorangDaftarMinat;
use Modules\Sisdant\Models\BidangSubbidang;
use Modules\Sisdant\Models\KelasPengkhususan;
use Modules\Sisdant\Models\Bidang;
use Modules\Sisdant\Models\SubBidang;
use Modules\Sisdant\Models\Kelas;
use Modules\Sisdant\Models\Pengkhususan;
use App\Models\ModelHasRoles;
use Modules\Tunas\Models\Tender;
use Modules\Tunas\Models\Addendum;
use DataTables;
use Carbon\Carbon;
use Mail;
use Modules\Tunas\Emails\MaklumanGagalSaringanPetender;
use Modules\Tunas\Emails\MaklumanLulusSaringanPetender;
use Modules\Tunas\Emails\MaklumanMuatNaikResitBayaranPengiklan;
use Modules\Tunas\Emails\MaklumanMuatNaikResitBayaranPetender;
use Modules\Tunas\Emails\MailMaklumResitSah;
use Modules\Tunas\Emails\MailMaklumResitGagal;
use Modules\Tunas\Emails\DokumenTambahan;
use Illuminate\Support\Facades\Storage;
use App\Models\Negeri;
use Modules\Sisdant\Models\JenisIklan;
use Modules\Sisdant\Models\KategoriPerolehan;
use Modules\Sisdant\Models\JenisTender;
use Modules\Sisdant\Models\CaraBayar;
use App\Models\SenaraiAlamat;
use Modules\Sisdant\Models\BayarKepada;
use Modules\Sisdant\Models\MatrikIklan;
use Modules\Sisdant\Models\Grade;
use Modules\Sisdant\Models\SubKelasPukonsa;
use Modules\Sisdant\Models\KelasPukonsa;
use Modules\Sisdant\Models\SubKelasUpkj;
use Modules\Sisdant\Models\KelasUpkj;
use Modules\Sisdant\Models\IklanKelasUpkj;
use Modules\Sisdant\Models\IklanKelasPukonsa;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\HeaderSurat;

class IklanBelumTutupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function iklanBelumTutup()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $role =[];

        for ($i=0; $i < count($checkrole); $i++) {
            array_push($role, $checkrole[$i]->role_id);
        }

        if(in_array(4, $role) || in_array(5, $role)) {

            return view('tunas::iklanBelumTutup');

        } else if(in_array(6, $role)) {

            return redirect('/tunas/iklan-telah-tutup');

        } else {
            return redirect('/dashboard');
        }

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewIklanBelumTutup($id)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $role =[];

        for ($i=0; $i < count($checkrole); $i++) {
            array_push($role, $checkrole[$i]->role_id);
        }

        if(in_array(4, $role) || in_array(5, $role)) {
            $data = IklanPerolehan::with('caraBayar', 'pejabatPamer', 'pejabatLapor', 'bayarKepada', 'petiTender')->where('id', $id )
                    ->where('status_iklan_id', 4)
                    ->where('tarikh_keluar_iklan', '<=', Carbon::now()->format('Y-m-d'))
                    ->where('tarikh_waktu_tutup', '>=', Carbon::now()->format('Y-m-d'))
                    ->first();
            if ($data) {
                $mohon = PermohonanNomborPerolehan::with('negeri', 'users.section', 'matrikIklan.jenisIklan', 'matrikIklan.KategoriPerolehan', 'matrikIklan.jenisTender')
                                    ->where('id_perolehan', $data->mohon_no_perolehan_id)->first();
                $dokumen_tender = Tender::where('iklan_perolehan_id', $id)->get();
                $fail_addendum = Addendum::where('iklan_perolehan_id', $id)->get();
                $bidang_data = BidangSubbidang::with('bidang')->where('iklan_perolehan_id', $data->id)->distinct('bidang_id')->get();
                $kelas_data = KelasPengkhususan::with('kelas')->where('iklan_perolehan_id', $data->id)->distinct('kelas_id')->get();
                $pukonsa_data = IklanKelasPukonsa::with('kelas')->where('iklan_perolehan_id', $data->id)->distinct('tajuk_id')->get();
                $upkj_data = IklanKelasUpkj::with('kelas')->where('iklan_perolehan_id', $data->id)->distinct('tajuk_id')->get();

                $bidang_sub = [];
                for ($bd=0; $bd<count($bidang_data); $bd++){

                    $sub_data = BidangSubbidang::with('subbidang')->where('iklan_perolehan_id', $bidang_data[$bd]->iklan_perolehan_id)->where('bidang_id', $bidang_data[$bd]->bidang_id)->distinct('sub_bidang_id')->get();
                    array_push($bidang_sub, $sub_data);
                }
                $bidang_sub = collect($bidang_sub);

                $data_khusus = [];
                for ($kk = 0; $kk < count($kelas_data); $kk++) {
                    $khusus = KelasPengkhususan::with('khusus')->where('iklan_perolehan_id', $kelas_data[$kk]->iklan_perolehan_id)->where('kelas_id', $kelas_data[$kk]->kelas_id)->distinct('pengkhususan_id')->get();
                    array_push($data_khusus, $khusus);

                }
                $data_khusus = collect($data_khusus);

                //pukonsa
                $data_pukonsa = [];
                for ($pk = 0; $pk < count($pukonsa_data); $pk++) {
                    $pukonsa = IklanKelasPukonsa::with('khusus')->where('iklan_perolehan_id', $pukonsa_data[$pk]->iklan_perolehan_id)->where('tajuk_id', $pukonsa_data[$pk]->tajuk_id)->get();
                    array_push($data_pukonsa, $pukonsa);

                }
                $data_pukonsa = collect($data_pukonsa);

                //upkj
                $data_upkj = [];
                for ($pk = 0; $pk < count($upkj_data); $pk++) {
                    $upkj = IklanKelasUpkj::with('khusus')->where('iklan_perolehan_id', $upkj_data[$pk]->iklan_perolehan_id)->where('tajuk_id', $upkj_data[$pk]->tajuk_id)->get();
                    array_push($data_upkj, $upkj);

                }
                $data_upkj = collect($data_upkj);
                // dd($data_upkj);

                $negeri = Negeri::where('id', '!=', $mohon->negeri_id)->get();
                $jenis = JenisIklan::where('id', '!=', $mohon->matrikiklan['jenis_iklan_id'])->get();
                $tender = JenisTender::where('id', '!=', $mohon->matrikiklan['jenis_tender_id'])->get();
                $kategori = KategoriPerolehan::where('id', '!=', $mohon->matrikiklan['kategori_perolehan_id'])->get();
                $carabayar = CaraBayar::where('id', '!=', $data->cara_bayaran_id)->get();
                $senaraialamat = SenaraiAlamat::where('id', '!=', $data->pejabat_pamer_jual)->get();
                $alamat = SenaraiAlamat::where('id', '!=', $data->pejabatlapor['id'])->get();

                if ($data->peti_tender == null){
                    $petitender = SenaraiAlamat::get();
                } else {
                    $petitender = SenaraiAlamat::where('id', '!=', $data->petitender['id'])->get();
                }

                $bayarkepada = BayarKepada::where('id', '!=', $data->bayar_kepada_id)->get();
                $tablebidang = Bidang::all();
                $tableSubbidang = SubBidang::all();
                $tablekelas = Kelas::all();
                $tableKhusus = Pengkhususan::all();
                $tablepukonsa = KelasPukonsa::get();
                $subkelaspukonsa = SubKelasPukonsa::get();
                $tableupkj = KelasUpkj::get();
                $subkelasupkj = SubKelasUpkj::get();
                $grade = Grade::get();

                return view('tunas::viewIklanBelumTutup',  compact('data', 'mohon', 'negeri', 'jenis', 'tender', 'kategori', 'carabayar', 'senaraialamat', 'bayarkepada', 'alamat', 'petitender', 'bidang_sub', 'dokumen_tender', 'tablebidang', 'tableSubbidang', 'bidang_data', 'kelas_data', 'data_khusus', 'tablekelas', 'tableKhusus','grade', 'data_pukonsa', 'tablepukonsa', 'subkelaspukonsa', 'pukonsa_data', 'upkj_data', 'data_upkj', 'tableupkj', 'subkelasupkj', 'fail_addendum'));
            } else {
                return redirect('/tunas/senaraiiklanbelumtutup');
            }
        } else {
            return redirect('/dashboard');
        }

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewPetender($idIklanPerolehan, $idBorang)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $role =[];

        for ($i=0; $i < count($checkrole); $i++) {
            array_push($role, $checkrole[$i]->role_id);
        }

        if(in_array(4, $role) || in_array(5, $role)) {
            $iklan_perolehan = IklanPerolehan::where('id', $idIklanPerolehan )->where('status_iklan_id', '!=', 7)
                                ->where('tarikh_keluar_iklan', '<=', Carbon::now()->format('Y-m-d'))
                                ->where('tarikh_waktu_tutup', '>=', Carbon::now()->format('Y-m-d'))->first();
            if ($iklan_perolehan) {
                $borang_daftar = TemplatBorangDaftar::where('iklan_perolehan_id', $iklan_perolehan->id )->first();
                if($borang_daftar) {
                    $getBorangDaftar = BorangDaftarMinat::where('id', $idBorang)->first();
                    $jawatan = KehadiranLawatanTapak::where('iklan_perolehan_id', $iklan_perolehan->id)->where('no_syarikat',$getBorangDaftar->no_syarikat )->first();
                    // bidang dan sub bidang
                    $bidang = BidangSubbidang::select('sub_bidang_id')->where('iklan_perolehan_id', $iklan_perolehan->id  )->get();
                    $kelas = KelasPengkhususan::select('pengkhususan_id')->where('iklan_perolehan_id', $iklan_perolehan->id  )->get();
                    $pukonsa = IklanKelasPukonsa::select('tajukkecil_id')->where('iklan_perolehan_id', $borang_daftar->iklan_perolehan_id )->get();
                    $upkj = IklanKelasUpkj::select('tajukkecil_id')->where('iklan_perolehan_id', $borang_daftar->iklan_perolehan_id )->get();

                    $getbidang = Subbidang::whereIn('id', $bidang)->get();
                    $getkelas = Pengkhususan::whereIn('id', $kelas)->get();
                    $getPukonsa = SubkelasPukonsa::select('kelas_pukonsa.keterangan as tajuk_besar', 'subkelas_pukonsa.keterangan as tajuk_kecil', 'subkelas_pukonsa.id as id')->join('kelas_pukonsa', 'kelas_pukonsa.id', '=', 'subkelas_pukonsa.tajuk_id')->wherein('subkelas_pukonsa.id', $pukonsa)->get();
                    $getUpkj = SubkelasUpkj::select('kelas_upkj.keterangan as tajuk_besar', 'subkelas_upkj.keterangan as tajuk_kecil', 'subkelas_upkj.id as id')->join('kelas_upkj', 'kelas_upkj.id', '=', 'subkelas_upkj.tajuk_id')->wherein('subkelas_upkj.id', $upkj)->get();

                    $detailPerolehan = PermohonanNomborPerolehan::where('id_perolehan', $iklan_perolehan->mohon_no_perolehan_id)->first();
                    //get dokumen iklan
                    $dokumenIklan = $detailPerolehan->dokumen_muatnaik;
                    //get dokumen tender
                    $dokumenTender = Tender::where('iklan_perolehan_id', $iklan_perolehan->id)->first();
                    //get dokumen addendum
                    $dokumenAddendum = Addendum::where('iklan_perolehan_id', $iklan_perolehan->id)->first();
                    //checking jenis pembayaran
                    if($iklan_perolehan->cara_bayaran_id == '1') {
                        $jenisTender = 'tanpa bayaran';
                    } else if ($iklan_perolehan->cara_bayaran_id == '3'){
                        $jenisTender = 'bayar';
                    } else if ($iklan_perolehan->cara_bayaran_id == '2' || $iklan_perolehan->cara_bayaran_id == '4') {
                        $jenisTender = 'tunai';
                    }

                    $headerSurat = HeaderSurat::first();
                    //coverdokumen
                    $data = [
                        'nama_perolehan' => $detailPerolehan->tajuk_perolehan,
                        'no_perolehan' => $detailPerolehan->no_perolehan,
                        'no_siri' => $getBorangDaftar->no_siri,
                        'jata' => $headerSurat->path_jata_negara
                    ];

                    $pdf = PDF::loadView('tunas::coverDokumenPDF', $data);
                    $noPerolehan = str_replace("/","_",$getBorangDaftar->no_siri);
                    //save to database if column cover_dokumen is empty
                    if ($getBorangDaftar->cover_dokumen == null) {
                        $name = 'COVER_DOKUMEN_'.$noPerolehan.'.pdf';
                        Storage::put('/public/cover_dokumen/'.$name, $pdf->output());
                        BorangDaftarMinat::where('id', $idBorang)->update(['cover_dokumen_path' => 'storage/cover_dokumen/'.$name, 'cover_dokumen' => $name]);
                    }
                    $grade = Grade::get();
                    return view('tunas::viewPetender', compact('grade', 'borang_daftar', 'iklan_perolehan', 'getBorangDaftar', 'getbidang', 'getkelas', 'jawatan', 'dokumenIklan', 'dokumenTender', 'dokumenAddendum', 'jenisTender', 'getPukonsa', 'getUpkj' ));
                } else {
                    return redirect('/tunas/senaraiiklanbelumtutup');
                }
            } else {
                return redirect('/tunas/senaraiiklanbelumtutup');
            }
        } else {
            return redirect('/dashboard');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function savePetender(Request $request)
    {
        if ($request->status == 'berjaya') {
            $iklanPerolehan = IklanPerolehan::where('id', $request->iklan_perolehan_id)->with('pejabatLapor')->first();
            $alamat = $iklanPerolehan->pejabatLapor['alamat'];
            $petender = BorangDaftarMinat::where('id', $request->borang_saringan_id )->first();
            $jenisTender = $request->jenis_tender;
            //dokumen attachment
            $coverDokumen = config('app.url').'/'.$petender->cover_dokumen_path;
            if($request->dokumen_iklan != null){
                $dokumenIklan = config('app.url').'/'.$request->dokumen_iklan;
            } else {
                $dokumenIklan = '';
            }
            // hantar emel berjaya
            if ($jenisTender == 'bayar') {
                BorangDaftarMinat::where('id',$request->borang_saringan_id )->update(['status_petender' => 'berjaya']);
            } else {
                BorangDaftarMinat::where('id',$request->borang_saringan_id )->update(['status_petender' => 'berjaya',  'status_resit' => 'sah']);
            }
            $detailPerolehan = PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_no_perolehan_id)->first();
            $to_emel = $petender->emel_rasmi;
            $link = config('app.url'). '/uploadresit'.'/' . $request->borang_saringan_id;
            if($request->dokumen_tender != null){
                $linkTender = config('app.url').'/'.$request->dokumen_tender;
            } else {
                $linkTender = '';
            }

            if($request->dokumen_addendum != null){
                $linkAddendum = config('app.url').'/'.$request->dokumen_addendum;
            } else {
                $linkAddendum = '';
            }

            $data = array(  'nama_syarikat' => $petender->nama_syarikat,
            'no_syarikat' => $petender->no_syarikat,
            'tajuk_perolehan' => $detailPerolehan->tajuk_perolehan,
            'no_perolehan' => $detailPerolehan->no_perolehan,
            'jenis_tender' => $jenisTender,
            'link' => $link,
            'dokumeniklan' => config('app.url').'/'.$dokumenIklan,
            'dokumentender' => $linkTender,
            'dokumenaddendum' =>  $linkAddendum,
            'coverDokumen' =>  $coverDokumen,
            'dokumenIklan' =>  $dokumenIklan,
            'alamat' =>  $alamat,
            );

            Mail::to($to_emel)->send(new MaklumanLulusSaringanPetender($data));
            return redirect()->route('iklan.viewbelumtutup', [$request->iklan_perolehan_id])->with( ['data2' => $data] )->withFlashSuccess(__('Maklumat Petender Telah Dikemaskini'));

        } else {
            // hantar emel gagal
            $petender = BorangDaftarMinat::where('id', $request->borang_saringan_id )->first();
            $detailPerolehan = PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_no_perolehan_id)->first();
            BorangDaftarMinat::where('id', $request->borang_saringan_id )->update(['status_petender' => 'gagal']);
            $to_emel = $petender->emel_rasmi;
            $data = array(  'nama_syarikat' => $petender->nama_syarikat,
                            'no_syarikat' => $petender->no_syarikat,
                            'tajuk_perolehan' => $detailPerolehan->tajuk_perolehan,
                            'no_perolehan' => $detailPerolehan->no_perolehan);
            Mail::to($to_emel)->send(new MaklumanGagalSaringanPetender($data));
            return redirect()->route('iklan.viewbelumtutup', [$request->iklan_perolehan_id])->with( ['data2' => $data] )->withFlashSuccess(__('Maklumat Petender Telah Dikemaskini'));
        }

    }

    public function uploadResitBayaran($id)
    {
        $rekodPetender = BorangDaftarMinat::where('id', $id )->first();
        if($rekodPetender) {
            $iklan_perolehan = IklanPerolehan::where('id', $rekodPetender->iklan_perolehan_id )->where('status_iklan_id','!=', 7)->where('cara_bayaran_id', '!=', 1)->first();
            if ($iklan_perolehan) {
                $no_perolehan = PermohonanNomborPerolehan::where('id_perolehan', $iklan_perolehan->mohon_no_perolehan_id )->first();
                // tarikh
                $date_today = Carbon::now();
                $date_asal = Carbon::createFromFormat('Y-m-d H:i:s', $iklan_perolehan->tarikh_waktu_tutup);
                $date = Carbon::parse($date_asal)->format('d/m/Y');

                return view('tunas::uploadResitBayaran', compact('rekodPetender', 'iklan_perolehan', 'no_perolehan', 'date', 'date_asal', 'date_today'));
            } else {
                $statusperolehan = "eperolehan";
                return view ('tunas::resitBayaranInvalid', compact('statusperolehan'));
            }
        } else {
            $statusperolehan = "eperolehan";
            return view ('tunas::resitBayaranInvalid', compact('statusperolehan'));
        }
    }

    public function saveResitBayaran(Request $request)
    {
        $arrNoPer = $request->objArr;
        $noPerolehan = [];
        $idPetender = [];
        $decodeArrNoPer = json_decode($arrNoPer, true);
        foreach ($decodeArrNoPer as $d) {
            array_push($noPerolehan, $d['no_perolehan']);
            array_push($idPetender, $d['id_petender']);
        }

        $resitBayaran = $request->file('dokumen'); //get dokumen iklan
        $pathing = $name = "";
        if($resitBayaran) {
            $name = $resitBayaran->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $resitBayaran->move(storage_path().'/app/public/resit_bayaran/', $name);
            $pathing ='storage/resit_bayaran/'.$name;
        BorangDaftarMinat::where('id', $idPetender[0] )->update(['resit_path' => $pathing, 'resit' => $name, 'status_resit' => 'baru']);
        }

        $detailPerolehan = PermohonanNomborPerolehan::where('no_perolehan', $noPerolehan[0])->first();
        $petender = BorangDaftarMinat::where('id', $idPetender[0] )->first();

        $users_id = [];
        $checkrole = ModelHasRoles::where('role_id', 4)->get();
        for ($i = 0; $i < count($checkrole); $i++){
            array_push($users_id, $checkrole[$i]->model_id);
        }
        $getPengiklan = User::whereIn('id', $users_id)->get();
        for ($sah = 0; $sah < count($getPengiklan); $sah++){

            $to_nama = $getPengiklan[$sah]->name;
            $to_emel = $getPengiklan[$sah]->email;
            $data = array(  'nama_syarikat' => $petender->nama_syarikat,
                                    'no_syarikat' => $petender->no_syarikat,
                                    'tajuk_perolehan' => $detailPerolehan->tajuk_perolehan,
                                    'no_perolehan' => $detailPerolehan->no_perolehan,
                                    'link' => config('app.url'). '/tunas/verifyresit'.'/'.$idPetender[0]);
            Mail::to($to_emel)->send(new MaklumanMuatNaikResitBayaranPengiklan($data));
        }
        // mail to petender
        $date_asal = Carbon::createFromFormat('Y-m-d H:i:s', $petender->updated_at);
        $date = Carbon::parse($date_asal)->format('d/m/Y H:i');
        $dataPetender = array('tajuk_perolehan' => $detailPerolehan->tajuk_perolehan,
                            'no_perolehan' => $detailPerolehan->no_perolehan,
                            'masa_upload' => $date);
        Mail::to($petender->emel_rasmi)->send(new MaklumanMuatNaikResitBayaranPetender($dataPetender));

        return response()->json(['result' => true], 200);
    }

    public function saveResitStatus(Request $request)
    {
        $data_borang = BorangDaftarMinat::where('id', $request->id)->first();
        $iklan = IklanPerolehan::where('id', $data_borang->iklan_perolehan_id )->first();
        $perolehan = PermohonanNomborPerolehan::where('id_perolehan', $iklan->mohon_no_perolehan_id )->first();
        $dokumenAddendum = Addendum::where('iklan_perolehan_id', $iklan->id)->get();
        $dokumenTender = Tender::where('iklan_perolehan_id', $iklan->id)->get();

        $arrayTender = [];
        if ($dokumenTender != null) {
            $countTender = count($dokumenTender);
            for ($i = 0; $i < $countTender; $i++){
                array_push($arrayTender, config('app.url').'/'.$dokumenTender[$i]->dokumen);
            }
        }

        $arrayAddendum = [];
        if ($dokumenAddendum != null) {
            $countAddendum = count($dokumenAddendum);
            for ($i = 0; $i < $countAddendum ; $i++){
                array_push($arrayAddendum, config('app.url').'/'.$dokumenAddendum[$i]->dokumen);
            }
        }
        if($request->status == "sah") {
            $petender = BorangDaftarMinat::where('id', $request->id)->update(['status_resit' => 'sah']);
            $data = array(  'nama_syarikat' => $data_borang->nama_syarikat,
            'tajuk_perolehan' => $perolehan->tajuk_perolehan,
            'no_perolehan' => $perolehan->no_perolehan,
            'status_resit'=> "sah");
            Mail::to($data_borang->emel_rasmi)->send(new MailMaklumResitSah($data, $arrayTender, $arrayAddendum, $countAddendum, $countTender));
        } else {
            $petender = BorangDaftarMinat::where('id', $request->id)->update(['status_resit' => 'gagal']);
            $data = array( 'nama_syarikat' => $data_borang->nama_syarikat,
            'tajuk_perolehan' => $perolehan->tajuk_perolehan,
            'no_perolehan' => $perolehan->no_perolehan,
            'status_resit'=> "gagal",
            'link' => config('app.url'). '/uploadresit/' . $data_borang->id );
            Mail::to($data_borang->emel_rasmi)->send(new MailMaklumResitGagal($data));
        }
        return response()->json([$data]);
    }

    public function verifyResit($id)
    {
        $getBorangDaftar = BorangDaftarMinat::where('id', $id )->first();
        return view('tunas::verifyResit', compact('getBorangDaftar'));
    }

    public function saveAddendum(Request $request)
    {
        if($request->status != "Batal") {
            // update iklan perolehan
            IklanPerolehan::where('id', $request->iklan_perolehan_id)->update([
                'tarikh_mula_jual' => $request->tarikh_mula_jual,
                'tarikh_akhir_jual' => $request->tarikh_akhir_jual,
                'pejabat_pamer_jual' => $request->pejabat_pamer,
                'tarikh_lawatan_tapak' => $request->tarikh_lawatan_tapak,
                'lawatan_tapak' => $request->lawatan_tapak,
                'pejabat_lapor' => $request->pejabat_lapor,
                'waktu_lapor' => $request->waktu_lapor,
                'lokasi_tapak' => $request->lokasi,
                'tarikh_waktu_tutup' => $request->tarikh_tutup .' '. $request->waktu_tutup,
                'peti_tender' => $request->peti_tender,
                'tarikh_taklimat_tender' => $request->tarikh_taklimat_tender,
                'taklimat_tender' => $request->taklimat_tender,
            ]);

            // update dokumen iklan
            $fileIklan = $request->file('fileIklan'); //get dokumen iklan
            $pathing = $name = "";
            if($fileIklan) {
                $name = $fileIklan->getClientOriginalName();
                $tarikh_file = Carbon::now()->format('ymd_His');
                $explode_name = explode('.', $name);

                $nama_fail = '';
                for ($i=0; $i < count($explode_name)-1; $i++) {
                    $nama_fail .= $explode_name[$i];
                }

                $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
                $fileIklan->move(storage_path().'/app/public/permohonan/', $name);
                $pathing ='storage/permohonan/'.$name;

                //update mohon perolehan bersama dokumen iklan
                PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_perolehan_id)->update([
                    'dokumen_muatnaik' =>$pathing,
                    'nama_dokumen'=> $name
                ]);
            }

            //checking status kemaskini
            $check = IklanPerolehan::where('id',$request->iklan_perolehan_id)->first();
            if ($check->status_kemaskini == 1){
                $status_kemaskini = 1;
            } else {
                $status_kemaskini = $check->status_kemaskini + 1;
            }

            //save file addendum
            $fileAddendum = $request->file('fileAddendum');

            if($fileAddendum){
                $name = $fileAddendum->getClientOriginalName();
                $tarikh_file = Carbon::now()->format('ymd_His');
                $explode_name = explode('.', $name);

                $nama_fail = '';
                for ($i=0; $i < count($explode_name)-1; $i++) {
                    $nama_fail .= $explode_name[$i];
                }

                $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
                $fileAddendum->move(storage_path().'/app/public/addendum/', $name);
                $path = 'storage/addendum/'.$name;

                $data_addendum = array(
                    'iklan_perolehan_id' => $request->iklan_perolehan_id,
                    'dokumen' => $name,
                    'path' => $path,
                    'status' => $status_kemaskini,
                );

                $addendum = new Addendum;
                $addendum->fill($data_addendum);
                $addendum->save();
            }

            //get file addendum
            $file_addendum = Addendum::where('iklan_perolehan_id', $request->iklan_perolehan_id)->get();
            $arrayAddendum = [];
            for($j = 0; $j < count($file_addendum); $j++){
                array_push($arrayAddendum, config('app.url') . '/'.$file_addendum[$j]->path);
            }
            // get nombor perolehan
            $mohon_perolehan = PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_perolehan_id)->get();

            //get cara bayar
            $cara_bayar = CaraBayar::where('id', $request->cara_bayar)->get();
            if ($request->cara_bayar != 1){
                //get petender berjaya
                $petender_berjaya = BorangDaftarMinat::where('iklan_perolehan_id', $request->iklan_perolehan_id)
                ->where('status_petender', 'berjaya')
                ->where('status_resit', 'sah')
                ->get();

            } else { //pembayaran secara percuma
                //get petender berjaya
                $petender_berjaya = BorangDaftarMinat::where('iklan_perolehan_id', $request->iklan_perolehan_id)
                ->where('status_petender', 'berjaya')
                ->get();

            }

            if($request->status == "hantar") {
                // email kepada petender berjaya
                if (!$petender_berjaya->isEmpty()){

                    for ($l = 0; $l < count($petender_berjaya); $l++){

                        $to_name = $petender_berjaya[$l]->nama_pegawai;
                        $to_email = $petender_berjaya[$l]->emel_rasmi;

                        $data = array('name'=> $to_name, 'no_perolehan' => $mohon_perolehan[0]->no_perolehan, 'tajuk_perolehan' => $mohon_perolehan[0]->tajuk_perolehan);
                        Mail::to($to_email)->send(new DokumenTambahan($data, $arrayAddendum));
                    }

                }
                $msg = "Dokumen Tambahan Telah Berjaya Dihantar";
            } else {
                $msg = "Dokumen Tambahan Telah Berjaya Disimpan";
            }
        } else {
            $id = $request->iklan_perolehan_id;
            $file_upload = $request->file('dokumen');
            $pathimg = "";
            $user = auth()->user();
            if($file_upload) {
                $name = $file_upload->getClientOriginalName();
                $tarikh_file = Carbon::now()->format('ymd_His');
                $explode_name = explode('.', $name);

                $nama_fail = '';
                for ($i=0; $i < count($explode_name)-1; $i++) {
                    $nama_fail .= $explode_name[$i];
                }

                $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
                $file_upload->move(storage_path().'/app/public/bataliklan/', $name);
                $pathimg ='storage/bataliklan/'.$name;
            }
            IklanPerolehan::where('id',$id)->update([
                'status_iklan_id' => 6,
                'justifikasi_batal' => $request->justifikasi,
                'dokumen_batal' => $pathimg,
                'dibatalkan_oleh' => $user->id,
                'tarikh_batal' => date("Y-m-d H:i:s")
            ]);
            $msg = "Rekod Iklan Telah Dibatalkan";
        }

        return redirect('/tunas/senaraiiklanbelumtutup')->with('status', $msg);
    }

    public function deleteaddendum(Request $request){
        Addendum::where('id', $request->id)->delete();

        $data = Addendum::where('iklan_perolehan_id', $request->iklan_id)->get();

        return response()->json($data);
    }
}
