<?php

namespace Modules\Tunas\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Tunas\Models\TemplatBorangDaftar;
use Modules\Tunas\Models\BorangDaftarMinat;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use App\Models\RunningNumberLawatanTapak;
use App\Models\ModelHasRoles;
use Carbon\Carbon;
use Modules\Tunas\Models\KehadiranLawatanTapak;
use Modules\Sisdant\Models\BidangSubbidang;
use Modules\Sisdant\Models\KelasPengkhususan;
use Modules\Sisdant\Models\Bidang;
use Modules\Sisdant\Models\SubBidang;
use Modules\Sisdant\Models\Kelas;
use Modules\Sisdant\Models\Pengkhususan;
use App\Rules\Captcha;
use App\Domains\Auth\Models\User;
use Modules\Tunas\Emails\KehadiranLawatanTapakMail;
use Mail;
use Modules\Tunas\Emails\PublishIklan;
use Modules\Tunas\Emails\BatalIklan;
use Modules\Tunas\Emails\mailMaklumanBorangSaringanWajib;
use App\Models\Negeri;
use Modules\Sisdant\Models\JenisIklan;
use Modules\Sisdant\Models\KategoriPerolehan;
use Modules\Sisdant\Models\JenisTender;
use Modules\Sisdant\Models\CaraBayar;
use App\Models\SenaraiAlamat;
use Modules\Sisdant\Models\BayarKepada;
use Modules\Sisdant\Models\MatrikIklan;
use Modules\Tunas\Models\Tender;
use Modules\Sisdant\Models\Grade;
use Modules\Sisdant\Models\SubKelasPukonsa;
use Modules\Sisdant\Models\KelasPukonsa;
use Modules\Sisdant\Models\SubKelasUpkj;
use Modules\Sisdant\Models\KelasUpkj;
use Modules\Sisdant\Models\IklanKelasUpkj;
use Modules\Sisdant\Models\IklanKelasPukonsa;
use App\Models\Pejabat;
use Modules\Sisdant\Models\StatusIklan;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use App\Models\HeaderSurat;

class TunasController extends Controller
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

        $today = date("Y-m-d");

        IklanPerolehan::where('status_iklan_id' , 4 )->whereDate('tarikh_waktu_tutup', '<=', $today) -> update(
            [
            'status_iklan_id'=> 5,
            'jadual_harga_status' => 'TINDAKAN',
            ]
        );

        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $role =[];

        for ($i=0; $i < count($checkrole); $i++) {
            array_push($role, $checkrole[$i]->role_id);
        }

        if(in_array(4, $role)) {

            return view('tunas::index');

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
    public function profile()
    {
        $user = auth()->user();
        $user  = User::where('id', $user->id)->first();

        $listpejabat = Pejabat::where('negeri_id', $user->negeri_id)
            ->select('id', 'bahagian', 'singkatan')
            ->orderBy('bahagian', 'asc')
            ->get();

        $listnegeri = Negeri::select('id', 'negeri', 'singkatan')
            ->orderBy('negeri', 'asc')
            ->get();

        return view('tunas::profile', compact('listnegeri', 'listpejabat', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('tunas::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('tunas::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $lawatantapak = KehadiranLawatanTapak::find($kehadiranlawatantapak->id);
        return view('tunas::edit', compact('lawatantapak'));
    }

    public function update(Request $request, $id)
    {
        $Response   = array(
            'success' => '1',
        );
        return response($update, 200, compact('Response'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function simpanLawatanTapak(Request $request)
    {
        $request->validate([
            'name_syarikat' => ['required', 'max:255', 'string'],
            'notel' => ['required', 'max:255', 'string'],
            'no_syarikat' => ['required', 'max:255', 'string'],
            'nofax' => ['required', 'max:255', 'string'],
            'nama_pegawai_ditauliah' => ['required', 'max:255', 'string'],
            'alamat' => ['required', 'max:255', 'string'],
            'alamat2' => ['required', 'max:255', 'string'],
            'bandar' => ['required', 'max:255', 'string'],
            'poskod' => ['required', 'max:255', 'string'],
            'negeri' => ['required', 'max:255', 'string'],
            'jawatan'=> ['required', 'max:255', 'string'],
            'emel' => ['required', 'email', 'max:255', 'string'],
            'checkbox' => ['required', 'max:255', 'string'],
            'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
        ],[
        'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ]);

        $KehadiranLawatanTapak = new KehadiranLawatanTapak;
        $KehadiranLawatanTapak->iklan_perolehan_id = $request->id;
        $KehadiranLawatanTapak->tarikh_masa=$current = Carbon::now();
        $KehadiranLawatanTapak->name_syarikat = $request->name_syarikat;
        $KehadiranLawatanTapak->notel = $request->notel;
        $KehadiranLawatanTapak->no_syarikat = $request->no_syarikat;
        $KehadiranLawatanTapak->nofax = $request->nofax;
        $KehadiranLawatanTapak->no_siri = $request->no_siri;
        $KehadiranLawatanTapak->nama_pegawai_ditauliah = $request->nama_pegawai_ditauliah;
        $KehadiranLawatanTapak->alamat = $request->alamat;
        $KehadiranLawatanTapak->alamat2 = $request->alamat2;
        $KehadiranLawatanTapak->alamat3 = $request->alamat3;
        $KehadiranLawatanTapak->bandar = $request->bandar;
        $KehadiranLawatanTapak->poskod = $request->poskod;
        $KehadiranLawatanTapak->negeri = $request->negeri;
        $KehadiranLawatanTapak->jawatan = $request->jawatan;
        $KehadiranLawatanTapak->emel = $request->emel;
        $KehadiranLawatanTapak->save();

        $iklan = IklanPerolehan::where('id',$request->id)->first();
        $noperolehan = PermohonanNomborPerolehan::where('id_perolehan',$iklan->mohon_no_perolehan_id)->first();
        $kehadiranlawatantapak = KehadiranLawatanTapak::where('iklan_perolehan_id',$iklan->id)->first();
        $entireTable = RunningNumberLawatanTapak::where('iklan_perolehan_id',$iklan->id)->get();
        if (count($entireTable) != 0) {
            $runningnumberlawatantapak = RunningNumberLawatanTapak::where('iklan_perolehan_id',$iklan->id) -> update([
                'running_number'=> \DB::raw('running_number+1'),
            ]);
        }
        //if table runningnumberlawatantapak is null
        else {
            $runningnumberlawatantapak = new RunningNumberLawatanTapak;
            $runningnumberlawatantapak->running_number = '1';
            $runningnumberlawatantapak->iklan_perolehan_id = $iklan->id;
            $runningnumberlawatantapak->save();

        };
        $runningnumber = RunningNumberLawatanTapak::where('iklan_perolehan_id',$iklan->id)->first();

        //serial number
        $string = ($noperolehan->no_perolehan);
        $add = "/";
        $series = ($runningnumber->running_number);
        $num_padded = sprintf("%003d", $series);
        $newSeriesNo = $string.$add.$num_padded;

        $addseriesno = KehadiranLawatanTapak::where('id',$KehadiranLawatanTapak->id)->update([
            'no_siri' => $newSeriesNo]
        );
        $linkborangdaftar = config('app.url').'/'.$iklan->borang_daftar;
        $jenisLawatanTapak = $iklan->lawatan_tapak;
        if($iklan->taklimat_tender != "TIDAK_WAJIB") {
            $dateBukaIklanAddTwoDays = Carbon::parse($iklan->tarikh_taklimat_tender)->addDays(2)->format('d/m/Y');
        } else {
            $dateBukaIklanAddTwoDays = Carbon::parse($iklan->tarikh_keluar_iklan)->addDays(2)->format('d/m/Y');
        }

        //sent mail
        $to_name = $request->name_syarikat;
        $to_email = $request->emel;
        $data = array('no_perolehan' => $noperolehan->no_perolehan);
        Mail::to($to_email, $to_name)->send(new KehadiranLawatanTapakMail($data,$newSeriesNo,$linkborangdaftar,$jenisLawatanTapak,$dateBukaIklanAddTwoDays));

        if($jenisLawatanTapak != 'TIDAK_WAJIB')
            $donesuccess = "true";
        else
            $donesuccess = "trueTIDAKWAJIB";

        return view('tunas::kehadiranlawatantapak_success', compact('donesuccess'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function kehadiranlawatantapak($id)
    {
        $iklan = IklanPerolehan::where('id',$id)->where('status_iklan_id', '!=', 7)->first();

        if ($iklan == null){
            $donesuccess = "true";
            return view ('tunas::kehadiranlawatantapak_id', compact('donesuccess'));
        }
        $noperolehan = PermohonanNomborPerolehan::where('id_perolehan',$iklan->mohon_no_perolehan_id)->first();
        // $id = $noperolehan->id_perolehan;
        if ($iklan->tarikh_lawatan_tapak) { // lawatan tapak wajib/online
            $tarikhLawatanTapakDMY = \Carbon\Carbon::parse($iklan->tarikh_lawatan_tapak)->format('d/m/Y');
            $tarikhLawatanTapakMDY = \Carbon\Carbon::parse($iklan->tarikh_lawatan_tapak)->format('m/d/Y');
            $tarikhMula = '';
            $tarikhTutup = '';
        } else { // lawatan tapak tidak wajib
            $tarikhLawatanTapakDMY = '';
            $tarikhLawatanTapakMDY = '';
            if ($iklan->taklimat_tender != "TIDAK_WAJIB"){ // check if taklimat tender wajib/online
                $tarikhMula = Carbon::parse($iklan->tarikh_taklimat_tender)->format('d/m/Y');
                $tarikhTutup = Carbon::parse($iklan->tarikh_taklimat_tender)->addDays(2)->format('d/m/Y');
            } else {
                $tarikhMula = Carbon::parse($iklan->tarikh_keluar_iklan)->format('d/m/Y');
                $tarikhTutup = Carbon::parse($iklan->tarikh_keluar_iklan)->addDays(2)->format('d/m/Y');
            }
        }
        $date_now = Carbon::now()->format('m/d/Y');
        $today = Carbon::now()->format('d/m/Y H:i:s');
        $waktuLaporHIA = Carbon::parse($iklan->waktu_lapor)->format('h:i a');
        $endtime = Carbon::parse($iklan->waktu_lapor)->addHours(2)->format('h:i a' );
        $waktuLaporHIS = Carbon::parse($iklan->waktu_lapor)->format('H:i:s');
        $endtime1 = Carbon::parse($iklan->waktu_lapor)->addHours(2)->format('H:i:s');

        return view('tunas::kehadiranlawatantapak', compact('id','iklan','noperolehan','tarikhLawatanTapakDMY','waktuLaporHIA', 'tarikhLawatanTapakMDY','date_now', 'endtime','waktuLaporHIS', 'endtime1','today', 'tarikhMula','tarikhTutup'));
    }

    public function viewIklan($id)
    {
        //check role
        $user = auth()->user();
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "4"){
                $type = "PENGIKLAN";
            }
        }
        if(!$type == "PENGIKLAN") {
            return redirect('/dashboard');
        }

        $data = IklanPerolehan::with('caraBayar', 'pejabatPamer', 'pejabatLapor', 'bayarKepada', 'petiTender')->where('id', $id )->first();
        $borang_daftar = TemplatBorangDaftar::where('iklan_perolehan_id', $id )->first();

        // dd($data);
        $mohon = PermohonanNomborPerolehan::with('negeri', 'users.section', 'matrikIklan.jenisIklan', 'matrikIklan.KategoriPerolehan', 'matrikIklan.jenisTender')
                            ->where('id_perolehan', $data->mohon_no_perolehan_id)->first();
        $dokumen_tender = Tender::where('iklan_perolehan_id', $id)->get();
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

        // condition for butang Batal
        $tarikhJangkaIklan= date('Y-m-d', strtotime($mohon->tarikh_jangka_iklan));
        $tarikhJangkaIklanMinusSatu = date('Y-m-d', strtotime('-1 day', strtotime($mohon->tarikh_jangka_iklan)));
        $today = date('Y-m-d', strtotime("now"));
        if ($today < $tarikhJangkaIklan){
            $butangBatal = 2;
        } else {
            $butangBatal = 1;
        }

        return view('tunas::viewiklan', compact('data', 'mohon', 'negeri', 'jenis', 'tender', 'kategori', 'carabayar', 'senaraialamat', 'bayarkepada', 'alamat', 'petitender', 'bidang_sub', 'dokumen_tender', 'tablebidang', 'tableSubbidang', 'bidang_data', 'kelas_data', 'data_khusus', 'tablekelas', 'tableKhusus','grade', 'data_pukonsa', 'tablepukonsa', 'subkelaspukonsa', 'pukonsa_data', 'upkj_data', 'data_upkj', 'tableupkj', 'subkelasupkj', 'borang_daftar', 'butangBatal'));
    }

    public function saveIklan(Request $request)
    {
        if ($request->status != 'Batal') {
            $input = $request->all();
            $id = $request->iklan_perolehan_id;
            $bahagian_3 = $request->bahagian_PUKONSA;
            $bahagian_7 = $request->bahagian_UPKJ;

            $bahagian_1_value = $bahagian_2_value = $bahagian_3_value = $bahagian_4_value = $bahagian_5_value = $bahagian_6_value = $bahagian_7_value = false;


            $bahagian_1_value = true;
            $bahagian_2_value = true;
            $bahagian_5_value = true;
            $bahagian_6_value = true;

            if ($bahagian_3 == "on"){
                $bahagian_3_value = true;
            }

            if ($bahagian_7 == "on"){
                $bahagian_7_value = true;
            }

            $borang_daftar = TemplatBorangDaftar::where('iklan_perolehan_id', $id )->first();

            if($borang_daftar) {
                TemplatBorangDaftar::where('id',$borang_daftar->id)->update([
                    'iklan_perolehan_id' => $id,
                    'bahagian_1' => $bahagian_1_value,
                    'bahagian_2' => $bahagian_2_value,
                    'bahagian_3' => $bahagian_3_value,
                    'bahagian_4' => $bahagian_4_value,
                    'bahagian_5' => $bahagian_5_value,
                    'bahagian_6' => $bahagian_6_value,
                    'bahagian_7' => $bahagian_7_value,

                ]);

                $link = "saringanwajib/". $borang_daftar->id;

            } else {
                $data=array('iklan_perolehan_id' => $id, 'bahagian_1' => $bahagian_1_value, 'bahagian_2' => $bahagian_2_value, 'bahagian_3' => $bahagian_3_value, 'bahagian_4' => $bahagian_4_value, 'bahagian_5' => $bahagian_5_value, 'bahagian_6' => $bahagian_6_value, 'bahagian_7' => $bahagian_7_value);
                $add = new TemplatBorangDaftar();
                $add->fill($data);
                $add->save();

                $link = "saringanwajib/". $add->id;
            }

            $check = IklanPerolehan::where('id',$id)->first();
            $detailPerolehan = PermohonanNomborPerolehan::where('id_perolehan', $check->mohon_no_perolehan_id)->first();

            $lawatantapak = 'kehadiranlawatantapak/' . $id;
            $url = config('app.url').'/'.$lawatantapak;

            $masa_start = Carbon::parse($check->waktu_lapor)->format('h:i a');
            $masa_end = Carbon::parse($check->waktu_lapor)->addHours(2)->format('h:i a' );
            $headerSurat = HeaderSurat::first();

            if( $check->tarikh_lawatan_tapak) { // tarikh lawatan tapak wujud
                $date_asal = Carbon::createFromFormat('Y-m-d H:i:s', $check->tarikh_lawatan_tapak);
                $tarikh = Carbon::parse($date_asal)->format('d/m/Y');
                $tarikh_akhir = '';

            } else { // tarikh lawatan tapak tidak wujud
                if ($check->taklimat_tender != "TIDAK_WAJIB"){ // check if taklimat tender wajib/online
                    $date_asal = Carbon::createFromFormat('Y-m-d H:i:s', $check->tarikh_taklimat_tender);
                    $tarikh = Carbon::parse($date_asal)->format('d/m/Y');
                    $tarikh_akhir = Carbon::parse($date_asal)->addDays(2)->format('d/m/Y');
                } else {
                    $date_asal = Carbon::createFromFormat('Y-m-d H:i:s', $check->tarikh_keluar_iklan);
                    $tarikh = Carbon::parse($date_asal)->format('d/m/Y');
                    $tarikh_akhir = Carbon::parse($date_asal)->addDays(2)->format('d/m/Y');
                }
            }
            $data = [
                'nama_perolehan' => $request->tajuk,
                'no_perolehan' => $detailPerolehan->no_perolehan,
                'url' => $url,
                'tarikh' => $tarikh,
                'masa_start' => $masa_start,
                'masa_end' => $masa_end,
                'jata' => $headerSurat->path_jata_negara,
                'jenisLawatanTapak' => $check->lawatan_tapak,
                'tarikh_akhir' => $tarikh_akhir,
            ];

            $pdf = PDF::loadView('tunas::QRCode', $data);

            $noPerolehan = str_replace("/","_",$detailPerolehan->no_perolehan);
            $name_qr = 'QR_CODE_'.$noPerolehan.'.pdf';
            Storage::put('/public/qrcode/'.$name_qr, $pdf->output());
            
            if( $check->tarikh_lawatan_tapak) { // tarikh lawatan tapak wujud
                $path_qrcode = '/'.'storage/qrcode/'.$name_qr;
            } else {
                $path_qrcode = '';
            }
            // update tajuk projek
            PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_perolehan_id)->update([
                'tajuk_perolehan' => $request->tajuk
            ]);

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
            if ($check->status_kemaskini == null){
                $status_kemaskini = 1;
            } else {
                $status_kemaskini = $check->status_kemaskini + 1;
            }

            //set status iklan
            if($request->status == "draf") {
                $status_iklan_id = 3;
            } else {
                $status_iklan_id = 4;
            }

            //check cara bayar
            if ($request->cara_bayar == 1){
                $harga = 0;
                $bayar_kepada = 4;
            } else {
                $harga = $request->harga_dokumen;
                $bayar_kepada = $request->bayar_kepada;
            }

            // update iklan perolehan
            IklanPerolehan::where('id',$id)->update([
                'tarikh_mula_jual' => $request->tarikh_mula_jual,
                'tarikh_akhir_jual' => $request->tarikh_akhir_jual,
                'pejabat_pamer_jual' => $request->pejabat_pamer,
                'tarikh_lawatan_tapak' => $request->tarikh_lawatan_tapak,
                'lawatan_tapak' => $request->lawatan_tapak,
                'pejabat_lapor' => $request->pejabat_lapor,
                'waktu_lapor' => $request->waktu_lapor,
                'harga_dokumen' => $harga,
                'cara_bayaran_id' => $request->cara_bayar,
                'bayar_kepada_id' => $bayar_kepada,
                'lokasi_tapak' => $request->lokasi,
                'tarikh_keluar_iklan' => $request->tarikh_keluar_iklan,
                'tarikh_waktu_tutup' => $request->tarikh_tutup .' '. $request->waktu_tutup,
                'status_iklan_id' => $status_iklan_id,
                'status_kemaskini' => $status_kemaskini,
                'peti_tender' => $request->peti_tender,
                'borang_daftar'=> $link,
                'tarikh_taklimat_tender' => $request->tarikh_taklimat_tender,
                'taklimat_tender' => $request->taklimat_tender,
            ]);

            // save dokumen tender
            $file_tender = $request->file('fileTender');
            $path = $nama = "";
            if($file_tender) {
                // save file in folder storage

                $nama = $file_tender->getClientOriginalName();
                $tarikh_file = Carbon::now()->format('ymd_His');
                $explode_name = explode('.', $nama);

                $nama_fail = '';
                for ($i=0; $i < count($explode_name)-1; $i++) {
                    $nama_fail .= $explode_name[$i];
                }

                $nama = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];

                $file_tender->move(storage_path().'/app/public/tender/', $nama);
                $path ='storage/tender/'.$nama;

                $data_dokumen = array(
                    'iklan_perolehan_id' => $id,
                    'dokumen' => $path,
                    'status' => $status_kemaskini,
                    'nama' => $nama,
                );

                $tender = new Tender;
                $tender->fill($data_dokumen);
                $tender->save();
            }

            $getPelaksana = User::where('id', $check->user_id)->first();
            $getdata = PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_perolehan_id)->first();

            if($request->status == "hantar") {
                // email PELAKSANA
                $to_name = $getPelaksana->name;
                $to_email = $getPelaksana->email;
                $data = array('name'=> $to_name, 'no_perolehan' => $getdata->no_perolehan, 'link_lawatantapak' => $path_qrcode);
                Mail::to($to_email)->send(new PublishIklan($data));

                $msg = "Rekod Iklan Telah Diiklankan";
            } else {
                $msg = "Rekod Iklan Berjaya Disimpan";
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

            $check = IklanPerolehan::where('id',$id)->first();
            $getPelaksana = User::where('id', $check->user_id)->first();
            $getdata = PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_perolehan_id)->first();

            $to_name = $getPelaksana->name;
            $to_email = $getPelaksana->email;
            $data = array('name'=> $to_name, 'no_perolehan' => $getdata->no_perolehan);
            Mail::to($to_email)->send(new BatalIklan($data));

            $msg = "Rekod Iklan Telah Dibatalkan";
        }

        return redirect('/tunas')->with('status', $msg);
    }

    public function deletetender(Request $request){
        Tender::where('id', $request->id)->delete();

        $data = Tender::where('iklan_perolehan_id', $request->iklan_id)->get();

        return response()->json($data);
    }

    public function viewSaringanWajib($id)
    {
        $borang_daftar = TemplatBorangDaftar::where('id', $id )->first();
        // dd($borang_daftar);
        if($borang_daftar) {
            $iklan_perolehan = IklanPerolehan::where('id', $borang_daftar->iklan_perolehan_id )->first();
            if($iklan_perolehan) {
                if($iklan_perolehan->status_iklan_id == 4) {
                    $no_perolehan = PermohonanNomborPerolehan::where('id_perolehan', $iklan_perolehan->mohon_no_perolehan_id )->first();

                    // tarikh
                    $date_today = Carbon::now();
                    $date_asal = Carbon::createFromFormat('Y-m-d H:i:s', $iklan_perolehan->tarikh_waktu_tutup);
                    $date = Carbon::parse($date_asal)->format('d/m/Y');

                    // bidang dan sub bidang
                    $bidang = BidangSubbidang::select('sub_bidang_id')->where('iklan_perolehan_id', $borang_daftar->iklan_perolehan_id )->get();
                    $kelas = KelasPengkhususan::select('pengkhususan_id')->where('iklan_perolehan_id', $borang_daftar->iklan_perolehan_id )->get();
                    $pukonsa = IklanKelasPukonsa::select('tajukkecil_id')->where('iklan_perolehan_id', $borang_daftar->iklan_perolehan_id )->get();
                    $upkj = IklanKelasUpkj::select('tajukkecil_id')->where('iklan_perolehan_id', $borang_daftar->iklan_perolehan_id )->get();

                    $getPukonsa = SubkelasPukonsa::select('kelas_pukonsa.keterangan as tajuk_besar', 'subkelas_pukonsa.keterangan as tajuk_kecil', 'subkelas_pukonsa.id as id')->join('kelas_pukonsa', 'kelas_pukonsa.id', '=', 'subkelas_pukonsa.tajuk_id')->wherein('subkelas_pukonsa.id', $pukonsa)->get();
                    $getUpkj = SubkelasUpkj::select('kelas_upkj.keterangan as tajuk_besar', 'subkelas_upkj.keterangan as tajuk_kecil', 'subkelas_upkj.id as id')->join('kelas_upkj', 'kelas_upkj.id', '=', 'subkelas_upkj.tajuk_id')->wherein('subkelas_upkj.id', $upkj)->get();

                    $getbidang = Subbidang::whereIn('id', $bidang)->get();
                    $getkelas = Pengkhususan::whereIn('id', $kelas)->get();

                    $todayYmd = Carbon::parse($date_today)->format('d/m/Y');
                    $todayNow = Carbon::parse($date_today)->format('H:i');
                    if ($iklan_perolehan->tarikh_lawatan_tapak) { // lawatan tapak wajib/online
                        $tarikhLawatanTapak = Carbon::createFromFormat('Y-m-d H:i:s', $iklan_perolehan->tarikh_lawatan_tapak);
                        $tarikhLawatanTapak = Carbon::parse($tarikhLawatanTapak)->format('d/m/Y');
                        $tarikhMula = '';
                        $tarikhTutup = '';
                    } else { // lawatan tapak tidak wajib
                        $tarikhLawatanTapak ='';
                        if ($iklan_perolehan->taklimat_tender != "TIDAK_WAJIB"){ // check if taklimat tender wajib/online
                            $tarikhMula = Carbon::parse($iklan_perolehan->tarikh_taklimat_tender)->format('d/m/Y');
                            $tarikhTutup = Carbon::parse($iklan_perolehan->tarikh_taklimat_tender)->addDays(2)->format('d/m/Y');
                        } else {
                            $tarikhMula = Carbon::parse($iklan_perolehan->tarikh_keluar_iklan)->format('d/m/Y');
                            $tarikhTutup = Carbon::parse($iklan_perolehan->tarikh_keluar_iklan)->addDays(2)->format('d/m/Y');
                        }
                    }

                    $waktuLaporHI = Carbon::parse($iklan_perolehan->waktu_lapor)->format('H:i');
                    $grade = Grade::get();
                    return view('tunas::saringanwajib', compact('grade','borang_daftar', 'iklan_perolehan', 'no_perolehan', 'date', 'date_asal', 'date_today', 'getbidang', 'getkelas', 'tarikhLawatanTapak', 'todayYmd', 'todayNow', 'tarikhMula', 'tarikhTutup','waktuLaporHI','getPukonsa', 'getUpkj'));

                } else if ($iklan_perolehan->status_iklan_id == 6) {
                    $success = "iklanbatal";
                    return view('tunas::saringanwajib-succes', compact('success'));
                }
            } else {
                $success = "false";
                return view('tunas::saringanwajib-succes', compact('success'));
            }

        } else {
            $success = "false";
            return view('tunas::saringanwajib-succes', compact('success'));
        }
    }

    public function getNoSiri(Request $request)
    {
        $id_iklan = $request->id;
        $no_siri = $request->nosiri;
        $no_mof = $request->mof;

        $check = KehadiranLawatanTapak::where('no_siri', $no_siri)->where('iklan_perolehan_id', $id_iklan)->where('no_syarikat', $no_mof)->first();
        $check_status = BorangDaftarMinat::where('no_siri', $no_siri)->first();

        if( $check_status) {
            $status = "available";
            return response()->json([$status]);
        } else {

            if($check) {
                $status = true;
                return response()->json([$status, $check]);
            } else {
                $status = false;
                return response()->json([$status]);
            }

        }
    }

    public function saveSaringanWajib(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
        ],[
        'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ]);


        // bidang dan sub bidang
        $bidang = BidangSubbidang::select('sub_bidang_id')->where('iklan_perolehan_id', $request->iklan_perolehan_id )->count();
        $kelas = KelasPengkhususan::select('pengkhususan_id')->where('iklan_perolehan_id', $request->iklan_perolehan_id )->count();
        $pukonsa = IklanKelasPukonsa::select('tajukkecil_id')->where('iklan_perolehan_id', $request->iklan_perolehan_id )->count();
        $upkj = IklanKelasUpkj::select('tajukkecil_id')->where('iklan_perolehan_id', $request->iklan_perolehan_id )->count();
        $bidang_array = $kelas_array = $upkj_array = $pukonsa_array = [];

        for ($i=0; $i < $bidang; $i++) {
            $check_bidang = $request->input('subbidang'.$i);
            if($check_bidang) {
                array_push($bidang_array, $check_bidang);
            }
        }

        for ($i=0; $i < $kelas; $i++) {
            $check_kelas = $request->input('pengkhususan'.$i);
            if($check_kelas) {
                array_push($kelas_array, $check_kelas);
            }

        }

        for ($i=0; $i < $pukonsa; $i++) {
            $check_kelas = $request->input('pukonsa'.$i);
            if($check_kelas) {
                array_push($pukonsa_array, $check_kelas);
            }

        }

        for ($i=0; $i < $upkj; $i++) {
            $check_kelas = $request->input('upkj'.$i);
            if($check_kelas) {
                array_push($upkj_array, $check_kelas);
            }

        }

        $noPerolehan = str_replace("/","_",$request->no_siri);

        $upload_CIDB = $request->file('upload_CIDB');
        $path_CIDB = $name_CIDB = "";
        if($upload_CIDB) {
            $name_CIDB = $upload_CIDB->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name_CIDB);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name_CIDB = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $upload_CIDB->move(storage_path().'/app/public/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/', $name_CIDB);
            $path_CIDB ='storage/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/'.$name_CIDB;
        }

        $upload_KK = $request->file('upload_KK');
        $path_KK = $name_KK = "";
        if($upload_KK) {
            $name_KK = $upload_KK->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name_KK);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name_KK = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $upload_KK->move(storage_path().'/app/public/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/', $name_KK);
            $path_KK ='storage/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/'.$name_KK;
        }

        $upload_SPKK = $request->file('upload_SPKK');
        $path_SPKK = $name_SPKK = "";
        if($upload_SPKK) {
            $name_SPKK = $upload_SPKK->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name_SPKK);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name_SPKK = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $upload_SPKK->move(storage_path().'/app/public/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/', $name_SPKK);
            $path_SPKK ='storage/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/'.$name_SPKK;
        }

        $upload_PUKONSA = $request->file('upload_PUKONSA');
        $path_PUKONSA = $name_PUKONSA = "";
        if($upload_PUKONSA) {
            $name_PUKONSA = $upload_PUKONSA->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name_PUKONSA);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name_PUKONSA = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $upload_PUKONSA->move(storage_path().'/app/public/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/', $name_PUKONSA);
            $path_PUKONSA ='storage/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/'.$name_PUKONSA;
        }

        $upload_UPKJ = $request->file('upload_UPKJ');
        $path_UPKJ = $name_UPKJ = "";
        if($upload_UPKJ) {
            $name_UPKJ = $upload_UPKJ->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name_UPKJ);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name_UPKJ = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $upload_UPKJ->move(storage_path().'/app/public/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/', $name_UPKJ);
            $path_UPKJ ='storage/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/'.$name_UPKJ;
        }

        $upload_TB = $request->file('upload_TB');
        $path_TB = $name_TB = "";
        if($upload_TB) {
            $name_TB = $upload_TB->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name_TB);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name_TB = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $upload_TB->move(storage_path().'/app/public/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/', $name_TB);
            $path_TB ='storage/saringanwajib/'.$request->iklan_perolehan_id.'/'.$noPerolehan.'/'.$name_TB;
        }

        $data=array('iklan_perolehan_id'=>$request->iklan_perolehan_id, 'kehadiran_lawatan_tapak_id'=> $request->kehadiran_lawatan_tapak_id, 'nama_syarikat'=> $request->nama_syarikat ,'nama_pegawai'=> $request->nama_pegawai
                    ,'telno_fax'=> $request->nofaks_syarikat,'telno_fon'=> $request->notelefon_syarikat, 'alamat_syarikat'=> $request->alamat, 'emel_rasmi'=> $request->email_syarikat,'no_syarikat'=> $request->no_syarikat
                    // , 'no_mof'=> $request->no_MOF, 'tarikh_tamat_mof'=> $request->tarikh_MOF, 'kod_sub_bidang_mof'=> $bidang_array,'doc_sijil_mof_path'=> $path_MOF,'doc_sijil_mof_nama'=> $name_MOF
                    ,'no_cidb'=> $request->no_CIDB,'tarikh_tamat_cidb'=> $request->tarikh_CIDB,'kelas_pengkhususan_cidb' => $kelas_array,'doc_sijil_cidb_path' => $path_CIDB ,'doc_sijil_cidb_nama' => $name_CIDB
                    ,'doc_sijil_kebenaran_khas_path' => $path_KK ,'doc_sijil_kebenaran_khas_nama' => $name_KK
                    ,'no_sijil_spkk'=> $request->no_SPKK,'tarikh_tamat_spkk'=> $request->tarikh_SPKK,'doc_sijil_spkk_path'=> $path_SPKK,'doc_sijil_spkk_nama' => $name_SPKK
                    ,'no_sijil_pukonsa'=> $request->no_PUKONSA,'tarikh_tamat_pukonsa'=> $request->tarikh_PUKONSA,'doc_sijil_pukonsa_path'=> $path_PUKONSA,'doc_sijil_pukonsa_nama'=> $name_PUKONSA
                    ,'no_sijil_upkj'=> $request->no_UPKJ,'tarikh_tamat_upkj'=> $request->tarikh_UPKJ,'doc_sijil_upkj_path' => $path_UPKJ,'doc_sijil_upkj_nama' =>$name_UPKJ
                    ,'tarikh_tamat_sij_bumiputera'=> $request->tarikh_TB,'doc_sijil_sij_bumiputera_path' => $path_TB,'doc_sijil_sij_bumiputera_nama' => $name_TB
                    ,'status_petender' => "dalam proses" ,'no_siri' => $request->no_siri, 'grade_id' => $request->gred, 'no_sijil_sij_bumiputera' => $request->no_taraf
                    ,'gred_kontraktor_pukonsa'=>$pukonsa_array, 'gred_kontraktor_upkj'=> $upkj_array);
        $add = new BorangDaftarMinat();
        $add->fill($data);
        $add->save();

        // hantar emel ke pengiklan
        $maklumatpetender = config('app.url'). '/tunas/viewpetender/' . $request->iklan_perolehan_id .'/'. $add->id;
        $users_id = [];
        $checkrole = ModelHasRoles::where('role_id', 5)->get();  // get role pengiklan
        for ($i = 0; $i < count($checkrole); $i++){
            array_push($users_id, $checkrole[$i]->model_id);
        }
        $getPengiklan = User::whereIn('id', $users_id)->get(); // get user pengiklan
        for ($sah = 0; $sah < count($getPengiklan); $sah++){

            $to_nama = $getPengiklan[$sah]->name;
            $to_emel = $getPengiklan[$sah]->email;
            $data = array('name'=> $to_nama, 'nama_syarikat' => $request->nama_syarikat,
                                    'no_syarikat' => $request->no_syarikat,
                                    'tajuk_perolehan' => $request->tajuk_perolehan,
                                    'no_perolehan' => $request->no_perolehan,
                                    'link' => $maklumatpetender);
            Mail::to($to_emel)->send(new mailMaklumanBorangSaringanWajib($data));
        }

        $success = "true";

        return view('tunas::saringanwajib-succes', compact('success'));

    }

    public function iklanBelumTutupPublic()
    {

        return view('tunas::iklanBelumTutup-public');

    }

    public function viewIklanPublic($id)
    {
        //check role
        $data = IklanPerolehan::with('caraBayar', 'pejabatPamer', 'pejabatLapor', 'bayarKepada', 'petiTender','grade')->where('id', $id )->first();
        if(!$data){
            return view('tunas::iklanBelumTutup-public');
        }

        $mohon = PermohonanNomborPerolehan::with('negeri', 'users.section', 'matrikIklan.jenisIklan', 'matrikIklan.KategoriPerolehan', 'matrikIklan.jenisTender')
                            ->where('id_perolehan', $data->mohon_no_perolehan_id)->first();

        Carbon::setLocale('ms_MY');
        $tarikh_keluar_iklan_asal = Carbon::createFromFormat('Y-m-d H:i:s', $data->tarikh_keluar_iklan);
        $tarikh_keluar_iklan = Carbon::parse($tarikh_keluar_iklan_asal)->format('d/m/Y');
        $hari_keluar_iklan = Carbon::parse($tarikh_keluar_iklan_asal)->dayName;
        $tarikh_waktu_tutup_asal = Carbon::createFromFormat('Y-m-d H:i:s', $data->tarikh_waktu_tutup);
        $tarikh_waktu_tutup = Carbon::parse($tarikh_waktu_tutup_asal)->format('d/m/Y');
        $hari_waktu_tutup = Carbon::parse($tarikh_waktu_tutup_asal)->dayName;

        $bidang = KelasPengkhususan::select('kelas_id')->where('iklan_perolehan_id', $id )->distinct('kelas_id')->get();
        $kelas = KelasPengkhususan::select('pengkhususan_id')->where('iklan_perolehan_id', $id )->get();

        $getkelas = Pengkhususan::whereIn('id', $kelas)->get();
        $getPengkhususan = Kelas::whereIn('id', $bidang)->get();

        $getPukonsa = IklanKelasPukonsa::with('kelas')->where('iklan_perolehan_id', $data->id)->distinct('tajuk_id')->get();
        $getUpkj = IklanKelasUpkj::with('kelas')->where('iklan_perolehan_id', $data->id)->distinct('tajuk_id')->get();

        $data_pukonsa = [];
        for ($pk = 0; $pk < count($getPukonsa); $pk++) {
            $pukonsa = IklanKelasPukonsa::with('kelas','khusus')->where('iklan_perolehan_id', $getPukonsa[$pk]->iklan_perolehan_id)->where('tajuk_id', $getPukonsa[$pk]->tajuk_id)->get();
            array_push($data_pukonsa, $pukonsa);

        }
        $data_pukonsa = collect($data_pukonsa);

        //upkj
        $data_upkj = [];
        for ($pk = 0; $pk < count($getUpkj); $pk++) {
            $upkj = IklanKelasUpkj::with('khusus')->where('iklan_perolehan_id', $getUpkj[$pk]->iklan_perolehan_id)->where('tajuk_id', $getUpkj[$pk]->tajuk_id)->get();
            array_push($data_upkj, $upkj);

        }
        $data_upkj = collect($data_upkj);


        return view('tunas::viewiklan-public', compact('data', 'mohon', 'tarikh_waktu_tutup', 'tarikh_keluar_iklan', 'hari_keluar_iklan', 'hari_waktu_tutup', 'getPengkhususan', 'getkelas', 'data_pukonsa', 'data_upkj', 'getPukonsa', 'getUpkj' ));
    }

    public function laporanIklan()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $jenisiklan = JenisIklan::all();
        $negeri = Negeri::all();
        $sIklan = StatusIklan::where('id', '!=', 1)->get();
        $data = [];
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "6") {
                $type = "PENDAFTAR JADUAL HARGA";
            }
        }
        if( $type == "PENDAFTAR JADUAL HARGA") {
            return view('tunas::laporanIklanPerolehan',compact('jenisiklan','negeri','sIklan'));
        } else {
            return redirect('/dashboard');
        }
    }

    public function filterLaporan(Request $request)
    {   $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $jenisiklan = JenisIklan::all();
        $negeri = Negeri::all();
        $data = [];
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "6") {
                $type = "PENDAFTAR JADUAL HARGA";
            }
        }

        $tarikh = array();
        $tarikhmula = '';
        $tarikhakhir = '';

        if($request->batal)
        {
            array_push($status,$request->batal);
        }
        if($request->sah)
        {
            array_push($status,$request->sah);
        }
        if(!is_null($request->tarikh))
        {
            $tarikh = str_replace(' ', '', $request->tarikh);
            $tarikh = explode ("-", $tarikh);
            $tarikh = str_replace('/', '-', $tarikh);
            $tarikhmula = date('Y-m-d', strtotime($tarikh[0]));
            $tarikhakhir = date('Y-m-d', strtotime($tarikh[1]));
        }
        $data = '{"j_iklan":'.json_encode($request->jenisiklan)
            .',"kategoriperolehan":'.json_encode($request->kategoriperolehan)
            .',"jenisperolehan":'.json_encode($request->jenisperolehan)
            .',"negeri":'.json_encode($request->negeri)
            .',"status":'.json_encode($request->status)
            .',"tarikhmula":'.json_encode($tarikhmula)
            .',"tarikhakhir":'.json_encode($tarikhakhir)
            .'}';
        $data = json_decode($data);
        if( $type == "PENDAFTAR JADUAL HARGA") {
            return redirect()->route('laporanIklan.laporaniklan')->with( ['data' => $data] );
        } else {
            return redirect('/dashboard');
        }
    }
    public function getKategoriPerolehan(Request $request)
    {
        $jenisiklan = $request->result;
        $kategori = MatrikIklan::select('kategori_perolehan_id')->where('jenis_iklan_id', $jenisiklan)->distinct()->get();
        $perolehan = kategoriperolehan::select('id','nama')->whereIn('id', $kategori)->get();
        return response()->json($perolehan);
    }
    public function getJenisPerolehan(Request $request)
    {
        $jenisiklan = $request->jns_iklan;
        $kategoriperolehan = $request->kategori;
        $jenisPerolehan = MatrikIklan::select('jenis_tender_id')->where('jenis_iklan_id', $jenisiklan)->where('kategori_perolehan_id', $kategoriperolehan)->get();
        $listJenisPerolehan = JenisTender::select('id','nama')->whereIn('id', $jenisPerolehan)->get();
        return response()->json($listJenisPerolehan);
    }

    public function checkMof(Request $request) {
        $kehadiranlawatantapak = KehadiranLawatanTapak::where('no_syarikat', $request->mof)->where('iklan_perolehan_id',$request->iklan_id) ->get();
        $status="true";
        if($kehadiranlawatantapak-> isEmpty() ){
            $status="false";
        }
        return response()->json($status);
    }

    public function filterLaporanB(Request $request)
    {   $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $jenisiklan = JenisIklan::all();
        $negeri = Negeri::all();
        $data = [];
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "6") {
                $type = "PENDAFTAR JADUAL HARGA";
            }
        }

        $tarikh = array();
        $tarikhmula = '';
        $tarikhakhir = '';

        if(!is_null($request->tarikh2))
        {
            $tarikh = str_replace(' ', '', $request->tarikh2);
            $tarikh = explode ("-", $tarikh);
            $tarikh = str_replace('/', '-', $tarikh);
            $tarikhmula = date('Y-m-d', strtotime($tarikh[0]));
            $tarikhakhir = date('Y-m-d', strtotime($tarikh[1]));
        }

        $data = '{"negeri2":'.json_encode($request->negeri2)
            .',"bahagian2":'.json_encode($request->bahagian2)
            .',"tarikhmula2":'.json_encode($tarikhmula)
            .',"tarikhakhir2":'.json_encode($tarikhakhir)
            .'}';
        $data = json_decode($data);
        if( $type == "PENDAFTAR JADUAL HARGA") {
            return redirect()->route('laporanIklan.laporaniklan')->with( ['data2' => $data] );
        } else {
            return redirect('/dashboard');
        }
    }

    public function getMaklumatJustifikasiPadam($id)
    {
        $data = IklanPerolehan::where('id',$id)->get();
        return response()->json([$data]);
    }


}
