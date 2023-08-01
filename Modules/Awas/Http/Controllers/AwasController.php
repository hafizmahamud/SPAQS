<?php

namespace Modules\Awas\Http\Controllers;

use App\Models\ModelHasRoles;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Domains\Auth\Models\User;
use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Tunas\Models\TemplatBorangDaftar;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Sisdant\Models\JenisIklan;
use Modules\Sisdant\Models\KelasPengkhususan;
use Modules\Sisdant\Models\BidangSubbidang;
use Modules\Sisdant\Models\Pengkhususan;
use Modules\Sisdant\Models\IklanKelasUpkj;
use Modules\Sisdant\Models\IklanKelasPukonsa;
use Modules\Awas\Models\PenilaianPerolehan;
use Modules\Awas\Models\DrafPenilaianPerolehan;
use Modules\Awas\Models\Pengesyoran;
use Modules\Awas\Models\DokumenSST;
use Modules\Awas\Emails\MailMaklumatPenilaian1;
use Modules\Awas\Emails\MailMaklumatPenilaian2;
use Modules\Awas\Emails\MailMaklumatKetuaPenilai;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use App\Models\LantikanPenilai;
use App\Models\HeaderSurat;
use App\Models\Tandatangan;
use App\Models\Pelantikan;
use App\Models\SelesaiTugas;
use App\Models\HantarDokumen;
use App\Models\Negeri;
use App\Models\LanjutSahLaku;
use Barryvdh\DomPDF\Facade as PDF;
use Modules\Awas\Models\DokumenKontrak;
use Modules\Awas\Models\DrafDokumenKontrak;
use Modules\Tunas\Models\JadualHarga;
use Modules\Tunas\Models\BorangDaftarMinat;
use App\Models\TemplatSST;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Models\MemoEdarKeputusan;
use App\Models\SuratEdarKeputusan;
use App\Models\Pejabat;
use Modules\Awas\Emails\MailMemoEdaranKeputusan;
use Modules\Awas\Emails\MailSuratEdaranKeputusan;
use DB;

class AwasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        // role = Pendaftar Penilaian
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $role =[];

        for ($i=0; $i < count($checkrole); $i++) {
            array_push($role, $checkrole[$i]->role_id);
        }


        if(in_array(7, $role)) {

            return view('awas::index');

        } else {

            return redirect('/dashboard');
        }

    }

    public function indexKeputusan(Request $request)
    {
        // role = Pendaftar Penilaian
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $role =[];

        for ($i=0; $i < count($checkrole); $i++) {
            array_push($role, $checkrole[$i]->role_id);
        }

        if(in_array(7, $role)) {

            return view('awas::indexkeputusan');

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

        return view('awas::profile', compact('listnegeri', 'listpejabat', 'user'));
    }

    public function suratPerakuan(Request $request)
    {
        return view('awas::suratperakuan');

    }

    public function suratLanjutan(Request $request)
    {

        return view('awas::suratlanjutan');

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('awas::create');
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
        return view('awas::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('awas::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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

    public function petenderBerjaya()
    {
        return view('awas::senaraiPetenderBerjaya');
    }

    public function viewPetenderBerjayaPublic()
    {
        return view('awas::petenderberjayapublic');
    }

    public function dokumenKontrak($id)
    {
        $data  = PenilaianPerolehan::where('id', $id)
            ->with('iklanPerolehan.mohonNoPerolehan.negeri')
            ->with('iklanPerolehan.mohonNoPerolehan.matrikIklan.jenisTender')
            ->with('iklanPerolehan.dokumenKontrak')
            ->with('dokumenSST')
            ->with('borangDaftarMinat.jadualharga')
            ->with('borangDaftarMinat.lawatanTapak')
            ->first();

        $tarikh_sign_sst = dokumenKontrak::select('tarikh_sign_sst')->where('iklan_perolehan_id',$data->iklan_perolehan_id)->first();
        $tarikh_sign_dokumen_kontrak = dokumenKontrak::select('tarikh_sign_dokumen_kontrak')->where('iklan_perolehan_id',$data->iklan_perolehan_id)->first();

        $petender = JadualHarga::with('iklanPerolehan')
        ->with('syarikat')
        ->first();

        return view('awas::dokumenkontrak', compact('data','tarikh_sign_sst','tarikh_sign_dokumen_kontrak'));
    }


    public function saveDokumenKontrak(Request $request)
    {
        $dataPenilaianPerolehan = PenilaianPerolehan::with('iklanPerolehan.mohonNoPerolehan.section')->with('iklanPerolehan.dokumenKontrak')->first();
        $dokumenKontrak = dokumenKontrak::where('iklan_perolehan_id', $dataPenilaianPerolehan->iklan_perolehan_id)->first();
        
        if (!is_null($dokumenKontrak)){
            DB::table('dokumen_kontrak')->update([
                        'iklan_perolehan_id' => $dataPenilaianPerolehan->iklan_perolehan_id,
                        'tarikh_sah_laku' => $dataPenilaianPerolehan->tarikh_sah_laku,
                        'tarikh_sst' => $dataPenilaianPerolehan->tarikh_edar_result,
                        'nama_petender' => $request->input('nama'),
                        'harga' => $request->input('harga'),
                        'tempoh' => $request->input('tempoh'),
                        'tarikh_sign_sst' => $request->tarikh_sign_sst,
                        'tarikh_sign_dokumen_kontrak' => $request->tarikh_sign_dokumen_kontrak,
                        'user_id' =>$dataPenilaianPerolehan->user_id,
                        'pejabat_id' =>$dataPenilaianPerolehan->iklanPerolehan->mohonNoPerolehan->section_id,
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                        'status' => "hantar",
            ]);
        }

        if (is_null($dokumenKontrak) && $request->status == "draf") {
            $dokumenKontrak = dokumenKontrak::create([
                        'iklan_perolehan_id' => $dataPenilaianPerolehan->iklan_perolehan_id,
                        'tarikh_sah_laku' => $dataPenilaianPerolehan->tarikh_sah_laku,
                        'tarikh_sst' => $dataPenilaianPerolehan->tarikh_edar_result,
                        'nama_petender' => $request->input('nama'),
                        'harga' => $request->input('harga'),
                        'tempoh' => $request->input('tempoh'),
                        'tarikh_sign_sst' => $request->tarikh_sign_sst,
                        'tarikh_sign_dokumen_kontrak' => $request->tarikh_sign_dokumen_kontrak,
                        'user_id' =>$dataPenilaianPerolehan->user_id,
                        'pejabat_id' =>$dataPenilaianPerolehan->iklanPerolehan->mohonNoPerolehan->section_id,
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                        'status' => "draf",
            ]);
            } else if (is_null($dokumenKontrak) && $request->status == "hantar") {
            $dokumenKontrak = dokumenKontrak::create([
                        'iklan_perolehan_id' => $dataPenilaianPerolehan->iklan_perolehan_id,
                        'tarikh_sah_laku' => $dataPenilaianPerolehan->tarikh_sah_laku,
                        'tarikh_sst' => $dataPenilaianPerolehan->tarikh_edar_result,
                        'nama_petender' => $request->input('nama'),
                        'harga' => $request->input('harga'),
                        'tempoh' => $request->input('tempoh'),
                        'tarikh_sign_sst' => $request->tarikh_sign_sst,
                        'tarikh_sign_dokumen_kontrak' => $request->tarikh_sign_dokumen_kontrak,
                        'user_id' =>$dataPenilaianPerolehan->user_id,
                        'pejabat_id' =>$dataPenilaianPerolehan->iklanPerolehan->mohonNoPerolehan->section_id,
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                        'status' => "hantar",
                    ]);
            }

        //Update table penilaianPerolehan if status_iklan_id=7
        if($dataPenilaianPerolehan->iklanPerolehan->status_iklan_id == '7')
        {
        penilaianPerolehan::where('iklan_perolehan_id', $dataPenilaianPerolehan->iklan_perolehan_id)
        ->update(['tarikh_sah_laku' => $request->tarikh_sah_laku_tender_terkini]);

        //Update table iklanPerolehan if status_iklan_id=7
        iklanPerolehan::where('id', $dataPenilaianPerolehan->iklan_perolehan_id)
        ->update(['tarikh_akhir_jual' => $request->tarikh_tutup_tender]);
        }

        $msg = "Dokumen Kontrak berjaya disimpan";
        return redirect('/awas/senarai_petender_berjaya')->with('status', $msg);
    }

    public function laporanTender()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $jenisiklan = JenisIklan::all();
        $negeri = Negeri::all();
        $data = [];


        return view('awas::laporanPemantauanTender',compact('jenisiklan','negeri'));
    }

    public function Penilaian($id) {

        $user = auth()->user();

        $no_perolehan = PermohonanNomborPerolehan::where('id_perolehan', $id )->first();
        $data = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();

        $ketuaPenilai = [];
        $pegPenilai1 = [];
        $pegPenilai2 = [];
        $penyedia = [];

        // get default tarikh serah dt 90 days
        $tarikhSerahDT = Carbon::parse($data->tarikh_waktu_tutup)->addDays(90);

        $removeSlah = explode(" ", $tarikhSerahDT);
        $getDateSDT = $removeSlah[0];

        $removedashSDT = explode("-", $getDateSDT);
        $yearSDT = $removedashSDT[0];
        $monthSDT = $removedashSDT[1];
        $daySDT = $removedashSDT[2];

        $checkroleKP = ModelHasRoles::where('role_id', 13)->get();
        for ($i = 0; $i < count($checkroleKP); $i++){
            array_push($ketuaPenilai, $checkroleKP[$i]->model_id);
        }

        $checkrolePegPen1 = ModelHasRoles::where('role_id', 8)->get();
        for ($i = 0; $i < count($checkrolePegPen1); $i++){
            array_push($pegPenilai1, $checkrolePegPen1[$i]->model_id);
        }

        $checkrolePegPen2 = ModelHasRoles::where('role_id', 9)->get();
        for ($i = 0; $i < count($checkrolePegPen2); $i++){
            array_push($pegPenilai2, $checkrolePegPen2[$i]->model_id);
        }

        $checkrolePenyedia = ModelHasRoles::where('role_id', 11)->get();
        for ($i = 0; $i < count($checkrolePenyedia); $i++){
            array_push($penyedia, $checkrolePenyedia[$i]->model_id);
        }

        $getListKP = User::whereIn('id', $ketuaPenilai)->get();
        $getListPP1 = User::whereIn('id', $pegPenilai1)->get();
        $getListPP2 = User::whereIn('id', $pegPenilai2)->get();
        $getListPenyedia = User::whereIn('id', $penyedia)->get();

        // split tarikh tamat untuk input date Tarikh Pelantikan AJK
        $iklanTamatdate = $data->tarikh_waktu_tutup;
        $splitTime = explode(" ", $iklanTamatdate);
        $getDate = $splitTime[0];

        $removedash = explode("-", $getDate);
        $year = $removedash[0];
        $month = $removedash[1];
        $day = $removedash[2];

        return view('awas::penilaian', compact( 'no_perolehan', 'getListKP', 'getListPP1', 'getListPP2', 'getListPenyedia', 'year', 'month', 'day', 'yearSDT', 'monthSDT', 'daySDT'));


    }
    public function penilaianPerolehan($id) {

        $user = auth()->user();

        $no_perolehan = PermohonanNomborPerolehan::where('id_perolehan', $id )->first();
        $data = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();

        return view('awas::penilaianperolehan', compact( 'no_perolehan'));
    }

    public function keputusanPerolehan($id) {

        $user = auth()->user();

        $no_perolehan = PermohonanNomborPerolehan::where('id_perolehan', $id )->first();
        $data = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();

        return view('awas::keputusanPerolehan', compact( 'no_perolehan'));



    }

    public function savePenilaianTender(Request $request)
    {
        $user = auth()->user();
        $status = $request->status;
        $id = $request->id_perolehan;

        // get tarikh akhir tutup tender
        $IklanPerolehan = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();
        $getwaktututuptender = $IklanPerolehan->tarikh_waktu_tutup;

        // get info for memo
        $no_rujukan1 = $request->no_rujukan;
        $no_rujukan2 = $request->no_rujukan1;
        $mergeNR =  '(' . $no_rujukan1 . ')' . ' P.P.S (s) 15/2011 Jld.' . ' ' . $no_rujukan2;
        $hari = $request->tempoh_sedia_lt;

        if ($hari == '14') {
            $daytext = 'empat belas';
        } else {
            $daytext = 'tiga puluh';
        }

        $tarikhsahlaku = $request->tarikh_sah_laku;
        $tarikhsahlakuFormat = Carbon::parse($tarikhsahlaku)->format('d/m/Y');
        $splitBulan = explode("/", $tarikhsahlakuFormat);

        // get nama bulan
        if ($splitBulan[1] == "01") {
            $bulan = "JANUARI";
        } elseif ($splitBulan[1] == "02") {
            $bulan = "FEBRUARI";
        } elseif ($splitBulan[1] == "03") {
            $bulan = "MAC";
        } elseif ($splitBulan[1] == "04") {
            $bulan = "APRIL";
        } elseif ($splitBulan[1] == "05") {
            $bulan = "MEI";
        } elseif ($splitBulan[1] == "06") {
            $bulan = "JUN";
        } elseif ($splitBulan[1] == "07") {
            $bulan = "JULAI";
        } elseif ($splitBulan[1] == "08") {
            $bulan = "OGOS";
        } elseif ($splitBulan[1] == "09") {
            $bulan = "SEPTEMBER";
        } elseif($splitBulan[1] == "10") {
            $bulan = "OKTOBER";
        } elseif ($splitBulan[1] == "11") {
            $bulan = "NOVEMBER";
        } else {
            $bulan = "DISEMBER";
        }

        $tarikhBaru = $splitBulan[0].' '.$bulan.' '.$splitBulan[2];

        $tarikhakhir = Carbon::parse($tarikhsahlaku)->addDays($hari)->format('d/m/Y');

        if($status == "hantar") {

            // save data into table penilaian perolehan
            $data=array(
                'iklan_perolehan_id' => $IklanPerolehan->id,
                'user_id' => $user->id,
                'tarikh_laporan_tender' => $request->tarikh_sah_laku,
                'tempoh_sah_laku' => $request->tempoh_sah_laku,
                'tarikh_sah_laku' => $request->tarikh_sah_laku,
                'tarikh_serah_dokumen_penilaian' => $request->tarikh_serah_dokumen,
                'ketua_penilai' => $request->ketua_penilai,
                'pegawai_penilai_1' => $request->peg_penilai_1,
                'pegawai_penilai_2' => $request->peg_penilai_2,
                'penyedia' => $request->penyedia,
                'no_rujukan' => $mergeNR,
                'tempoh_sedia_lt' => $request->tempoh_sedia_lt,
            );

            IklanPerolehan::where('id', $IklanPerolehan->id)->update(['tarikh_kemaskini_penilaian' => Carbon::now()->toDateTimeString(), 'status_kemaskini_penilaian' => '1',]);
            DrafPenilaianPerolehan::where('iklan_perolehan_id', $IklanPerolehan->id)->delete();
            $penilaian = new PenilaianPerolehan();
            $penilaian->fill($data);
            $penilaian->save();

            // generate memo pelantikan penilai
            $detailIklan = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();
            $detailPerolehan = PermohonanNomborPerolehan::where('id_perolehan', $id)->first();
            $detail = LantikanPenilai::first();
            $header = HeaderSurat::first();
            $ttangan = Tandatangan::first();
            $checkroleKP = PenilaianPerolehan::select('ketua_penilai')->where('id', $penilaian->id)->first();
            $checkroleP1 = PenilaianPerolehan::select('pegawai_penilai_1')->where('id', $penilaian->id)->first();
            $checkroleP2 = PenilaianPerolehan::select('pegawai_penilai_2')->where('id', $penilaian->id)->first();
            $userInfoKP = User::select('name', 'ic_no', 'id', 'jawatan')->whereIn('id', $checkroleKP)->first();
            $userInfoP1 = User::select('name', 'ic_no', 'id', 'jawatan')->whereIn('id', $checkroleP1)->first();
            $userInfoP2 = User::select('name', 'ic_no', 'id', 'jawatan')->whereIn('id', $checkroleP2)->first();
            $akuanPelantikan = Pelantikan::first();
            $akuanSelesaiTugas = SelesaiTugas::first();

            // split header jabatan
            $getJabatan = $header->jabatan;
            $splitJabatan = explode('(', $getJabatan);
            $jabatanBm = $splitJabatan[0];
            $jabatanEn = '(' . $splitJabatan[1];

            // get jata negara , memo, tanda tangan
            $jata = config('app.url'). $header->path_jata_negara;
            $memo = config('app.url'). $header->path_img_memo;
            $tt = config('app.url'). $ttangan->path_tandatangan;

            // split header kementerian
            $getKementerian = $header->kementerian;
            $splitKementerian = explode('(', $getKementerian);
            $kementerianBm = $splitKementerian[0];
            $kementerianEn = '(' . $splitKementerian[1];

            // split moto text into two
            $getMoto = $detail->moto_1;
            $splitopenbracket = explode('"', $getMoto);
            $moto1 = $splitopenbracket[1];
            $moto2 = $splitopenbracket[3];

            // split tajuk besar surat akuan pelantikan
            $getTajuk = $akuanPelantikan->tajuk;
            $splitTajuk = explode(' ', $getTajuk);
            $tajuk = $splitTajuk[0];
            $tajuk1 = $splitTajuk[1];
            $tajuk2 = $splitTajuk[2];
            $tajuk3 = $splitTajuk[3];
            $tajuk4 = $splitTajuk[4];
            $tajuk5 = $splitTajuk[5];
            $tajuk6 = $splitTajuk[6];

            $tajukSAP1 = $tajuk . ' ' . $tajuk1 . ' ' . $tajuk2 . ' ' . $tajuk3 . ' ' . $tajuk4;
            $tajukSAP2 = $tajuk5 . ' ' . $tajuk6;

            // split tajuk besar surat selesai tugas
            $getTajukST = $akuanSelesaiTugas->tajuk;
            $splitTajukST = explode(' ', $getTajukST);
            $tajukST = $splitTajukST[0];
            $tajukST1 = $splitTajukST[1];
            $tajukST2 = $splitTajukST[2];
            $tajukST3 = $splitTajukST[3];
            $tajukST4 = $splitTajukST[4];
            $tajukST5 = $splitTajukST[5];
            $tajukST6 = $splitTajukST[6];
            $tajukST7 = $splitTajukST[7];

            $tajukSST1 = $tajukST . ' ' . $tajukST1 . ' ' . $tajukST2 . ' ' . $tajukST3 . ' ' . $tajukST4 . ' ' . $tajukST5;
            $tajukSST2 = $tajukST6 . ' ' . $tajukST7;


            $datapdfMPP = [
                'jata_negara' => $jata,
                'memo_surat' => $memo,
                'tanda_tangan' => $tt,
                'no_perolehan' => $detailPerolehan->no_perolehan,
                'nama_tender' => $detailPerolehan->tajuk_perolehan,
                'tarikh_akhir_jual' => Carbon::parse($detailIklan->tarikh_akhir_jual)->format('d/m/Y'),
                'tarikh_waktu_tutup' => Carbon::parse($detailIklan->tarikh_waktu_tutup)->format('d/m/Y'),
                'tarikh_serah_dokumen_penilaian' => Carbon::parse($penilaian->tarikh_serah_dokumen_penilaian)->format('d/m/Y'),
                'penilai_1' => Str::upper($userInfoP1->name),
                'penilai_2' => Str::upper($userInfoP2->name),
                'jata' => $header->path_jata_negara,
                'memo' => $header->path_img_memo,
                'jabatanBM' => $jabatanBm,
                'jabatanEN' => $jabatanEn,
                'kementerianBM' => $kementerianBm,
                'kementerianEN' => $kementerianEn,
                'alamat' => $header->alamat,
                'no_tel' => $header->no_tel,
                'no_fax' => $header->no_fax,
                'email' => $header->email,
                'laman_web' => $header->laman_web,
                'hari' => $hari,
                'daytext' => $daytext,
                'no_rujukan' => $mergeNR,
                'tarikh_mula_memo' => $tarikhBaru,
                'tarikhmula' => $tarikhsahlakuFormat,
                'tarikhakhir' => $tarikhakhir,
                'text_1' => $detail->text_1,
                'text_2' => $detail->text_2,
                'text_3' => $detail->text_3,
                'text_4' => $detail->text_4,
                'moto_1' => $moto1,
                'moto_2' => $moto2,
                'sym' => $detail->sym,
                'nama' => $ttangan->nama,
                'tarikh' => Carbon::now()->format('d/m/Y'),
                'tarikh_akhir' => Carbon::now()->addDays(30)->format('d/m/Y'),
            ];

            $pdf = PDF::loadView('pdf_pelantikanajkpenilaian', $datapdfMPP);
            $noTenderMPP = str_replace('/', '_', $detailPerolehan->no_perolehan);
            $nameMemo = 'MEMO_PELANTIKAN_PENILAI_'.$noTenderMPP.'.pdf';
            Storage::put('/public/dokumenPenilaian/'.$nameMemo, $pdf->output());

            // generate borang tindakan
            $datapdfBT = [
                'nama_tender' => $detailPerolehan->tajuk_perolehan,
                'no_perolehan' => $detailPerolehan->no_perolehan,
                'tarikh_iklan' => Carbon::parse($detailIklan->tarikh_keluar_iklan)->format('d/m/Y'),
                'tarikh_tutup' => Carbon::parse($detailIklan->tarikh_waktu_tutup)->format('d/m/Y'),
                'tarikh_surat_lantikan_penilaian' => Carbon::parse($penilaian->tarikh_pelantikan_ajk)->format('d/m/Y'),
                'tarikh_sah_laku' => Carbon::parse($request->tarikh_sah_laku)->addDays(1)->format('d/m/Y'),
                'sedia_lt' => $penilaian->tempoh_sah_laku,
                'hari' => $hari,
            ];

            $pdfBT = PDF::loadView('pdf_borangtindakan', $datapdfBT);
            $noTenderBT = str_replace('/', '_', $detailPerolehan->no_perolehan);
            $nameBT = 'BORANG_TINDAKAN_'.$noTenderBT.'.pdf';
            Storage::put('/public/dokumenPenilaian/'.$nameBT, $pdfBT->output());

            // generate surat akuan pelantikan ketua penilai
            $datapdfKP = [
                'tajukSAP1' => $tajukSAP1,
                'tajukSAP2' => $tajukSAP2,
                'nama' => Str::upper($userInfoKP->name),
                'no_ic' => $userInfoKP->ic_no,
                'no_perolehan' => $detailPerolehan->no_perolehan,
                'nama_tender' => $detailPerolehan->tajuk_perolehan,
                'pengenalan' => $akuanPelantikan->text_1,
                'isi_1' => $akuanPelantikan->text_2,
                'isi_2' => $akuanPelantikan->text_3,
                'isi_3' => $akuanPelantikan->text_4,
                'isi_4' => $akuanPelantikan->text_5,
                'isi_5' => $akuanPelantikan->text_6,
                'isi_6' => $akuanPelantikan->text_7,
                'isi_7' => $akuanPelantikan->text_8,
                'jawatan' => $userInfoKP->jawatan,
            ];

            $pdfKP = PDF::loadView('pdf_SuratAkuanPelantikanAJK_PP', $datapdfKP);
            $noTenderKP = str_replace('/', '_', $detailPerolehan->no_perolehan);
            $icKP = $userInfoKP->ic_no;
            $nameSAKP = 'SURAT_AKUAN_PELANTIKAN_'.$noTenderKP.'_'.$icKP.'.pdf';
            Storage::put('/public/dokumenPenilaian/'.$nameSAKP, $pdfKP->output());

            // generate surat akuan pelantikan pegawai penilai 1
            $datapdfPP1 = [
                'tajukSAP1' => $tajukSAP1,
                'tajukSAP2' => $tajukSAP2,
                'nama' => Str::upper($userInfoP1->name),
                'no_ic' => $userInfoP1->ic_no,
                'no_perolehan' => $detailPerolehan->no_perolehan,
                'nama_tender' => $detailPerolehan->tajuk_perolehan,
                'pengenalan' => $akuanPelantikan->text_1,
                'isi_1' => $akuanPelantikan->text_2,
                'isi_2' => $akuanPelantikan->text_3,
                'isi_3' => $akuanPelantikan->text_4,
                'isi_4' => $akuanPelantikan->text_5,
                'isi_5' => $akuanPelantikan->text_6,
                'isi_6' => $akuanPelantikan->text_7,
                'isi_7' => $akuanPelantikan->text_8,
                'jawatan' => $userInfoP1->jawatan,
            ];

            $pdfPP1 = PDF::loadView('pdf_SuratAkuanPelantikanAJK_PP', $datapdfPP1);
            $noTenderPP1 = str_replace('/', '_', $detailPerolehan->no_perolehan);
            $icPP1 = $userInfoP1->ic_no;
            $nameSAP1 = 'SURAT_AKUAN_PELANTIKAN_'.$noTenderPP1.'_'.$icPP1.'.pdf';
            Storage::put('/public/dokumenPenilaian/'.$nameSAP1, $pdfPP1->output());

            // generate surat akuan pelantikan pegawai penilai 2
             $datapdfPP2 = [
                'tajukSAP1' => $tajukSAP1,
                'tajukSAP2' => $tajukSAP2,
                'nama' => Str::upper($userInfoP2->name),
                'no_ic' => $userInfoP2->ic_no,
                'no_perolehan' => $detailPerolehan->no_perolehan,
                'nama_tender' => $detailPerolehan->tajuk_perolehan,
                'pengenalan' => $akuanPelantikan->text_1,
                'isi_1' => $akuanPelantikan->text_2,
                'isi_2' => $akuanPelantikan->text_3,
                'isi_3' => $akuanPelantikan->text_4,
                'isi_4' => $akuanPelantikan->text_5,
                'isi_5' => $akuanPelantikan->text_6,
                'isi_6' => $akuanPelantikan->text_7,
                'isi_7' => $akuanPelantikan->text_8,
                'jawatan' => $userInfoP2->jawatan,
            ];

            $pdfPP2 = PDF::loadView('pdf_SuratAkuanPelantikanAJK_PP', $datapdfPP2);
            $noTenderPP2 = str_replace('/', '_', $detailPerolehan->no_perolehan);
            $icPP2 = $userInfoP2->ic_no;
            $nameSAP2 = 'SURAT_AKUAN_PELANTIKAN_'.$noTenderPP2.'_'.$icPP2.'.pdf';
            Storage::put('/public/dokumenPenilaian/'.$nameSAP2, $pdfPP2->output());

             // generate surat akuan selesai tugas ketua penilai
             $datapdfSTKP = [
                'tajukSST1' => $tajukSST1,
                'tajukSST2' => $tajukSST2,
                'nama' => Str::upper($userInfoKP->name),
                'no_ic' => $userInfoKP->ic_no,
                'no_perolehan' => $detailPerolehan->no_perolehan,
                'nama_tender' => $detailPerolehan->tajuk_perolehan,
                'pengenalan' => $akuanSelesaiTugas->text_1,
                'isi_1' => $akuanSelesaiTugas->text_2,
                'isi_2' => $akuanSelesaiTugas->text_3,
                'isi_3' => $akuanSelesaiTugas->text_4,
                'isi_4' => $akuanSelesaiTugas->text_5,
                'isi_5' => $akuanSelesaiTugas->text_6,
                'isi_6' => $akuanSelesaiTugas->text_7,
                'jawatan' => $userInfoKP->jawatan,
            ];

            $pdfSTKP = PDF::loadView('pdf_SuratAkuanSelesaiTugasAJK_PP', $datapdfSTKP);
            $noTenderSTKP = str_replace('/', '_', $detailPerolehan->no_perolehan);
            $icSTKP = $userInfoKP->ic_no;
            $nameSASTKP = 'SURAT_AKUAN_SELESAI_TUGAS_'.$noTenderSTKP.'_'.$icSTKP.'.pdf';
            Storage::put('/public/dokumenPenilaian/'.$nameSASTKP, $pdfSTKP->output());

            // generate surat akuan selesai tugas pegawai penilai 1
            $datapdfSTPP1 = [
                'tajukSST1' => $tajukSST1,
                'tajukSST2' => $tajukSST2,
                'nama' => Str::upper($userInfoP1->name),
                'no_ic' => $userInfoP1->ic_no,
                'no_perolehan' => $detailPerolehan->no_perolehan,
                'nama_tender' => $detailPerolehan->tajuk_perolehan,
                'pengenalan' => $akuanSelesaiTugas->text_1,
                'isi_1' => $akuanSelesaiTugas->text_2,
                'isi_2' => $akuanSelesaiTugas->text_3,
                'isi_3' => $akuanSelesaiTugas->text_4,
                'isi_4' => $akuanSelesaiTugas->text_5,
                'isi_5' => $akuanSelesaiTugas->text_6,
                'isi_6' => $akuanSelesaiTugas->text_7,
                'jawatan' => $userInfoP1->jawatan,
            ];

            $pdfSTPP1 = PDF::loadView('pdf_SuratAkuanSelesaiTugasAJK_PP', $datapdfSTPP1);
            $noTenderSTPP1 = str_replace('/', '_', $detailPerolehan->no_perolehan);
            $icSTPP1 = $userInfoP1->ic_no;
            $nameSAST1 = 'SURAT_AKUAN_SELESAI_TUGAS_'.$noTenderSTPP1.'_'.$icSTPP1.'.pdf';
            Storage::put('/public/dokumenPenilaian/'.$nameSAST1, $pdfSTPP1->output());

            // generate surat akuan selesai tugas pegawai penilai 2
            $datapdfSTPP2 = [
                'tajukSST1' => $tajukSST1,
                'tajukSST2' => $tajukSST2,
                'nama' => Str::upper($userInfoP2->name),
                'no_ic' => $userInfoP2->ic_no,
                'no_perolehan' => $detailPerolehan->no_perolehan,
                'nama_tender' => $detailPerolehan->tajuk_perolehan,
                'pengenalan' => $akuanSelesaiTugas->text_1,
                'isi_1' => $akuanSelesaiTugas->text_2,
                'isi_2' => $akuanSelesaiTugas->text_3,
                'isi_3' => $akuanSelesaiTugas->text_4,
                'isi_4' => $akuanSelesaiTugas->text_5,
                'isi_5' => $akuanSelesaiTugas->text_6,
                'isi_6' => $akuanSelesaiTugas->text_7,
                'jawatan' => $userInfoP2->jawatan,
            ];

            $pdfSTPP2 = PDF::loadView('pdf_SuratAkuanSelesaiTugasAJK_PP', $datapdfSTPP2);
            $noTenderSTPP2 = str_replace('/', '_', $detailPerolehan->no_perolehan);
            $icSTPP2 = $userInfoP2->ic_no;
            $nameSAST2 = 'SURAT_AKUAN_SELESAI_TUGAS_'.$noTenderSTPP2.'_'.$icSTPP2.'.pdf';
            Storage::put('/public/dokumenPenilaian/'.$nameSAST2, $pdfSTPP2->output());

            PenilaianPerolehan::where('iklan_perolehan_id', $id)->update([
                'memo_pelantikan_path' => 'storage/dokumenPenilaian/'.$nameMemo,
                'memo_pelantikan' => $nameMemo,
                'borang_tindakan_path' => 'storage/dokumenPenilaian/'.$nameBT,
                'borang_tindakan' => $nameBT,
                'surat_akuan_pelantikan_kp_path' => 'storage/dokumenPenilaian/'.$nameSAKP,
                'surat_akuan_pelantikan_kp' => $nameSAKP,
                'surat_akuan_pelantikan_p1_path' => 'storage/dokumenPenilaian/'.$nameSAP1,
                'surat_akuan_pelantikan_p1' => $nameSAP1,
                'surat_akuan_pelantikan_p2_path' => 'storage/dokumenPenilaian/'.$nameSAP2,
                'surat_akuan_pelantikan_p2' => $nameSAP2,
                'surat_akuan_selesai_tugas_kp_path' => 'storage/dokumenPenilaian/'.$nameSASTKP,
                'surat_akuan_selesai_tugas_kp' => $nameSASTKP,
                'surat_akuan_selesai_tugas_p1_path' => 'storage/dokumenPenilaian/'.$nameSAST1,
                'surat_akuan_selesai_tugas_p1' => $nameSAST1,
                'surat_akuan_selesai_tugas_p2_path' => 'storage/dokumenPenilaian/'.$nameSAST2,
                'surat_akuan_selesai_tugas_p2' => $nameSAST2,
            ]);

            $msg = "Penilaian berjaya dihantar";

            // get file path
            $failMemoLantikan = config('app.url').'/'.'storage/dokumenPenilaian/'.$nameMemo;
            $failBorangTindakan = config('app.url').'/'.'storage/dokumenPenilaian/'.$nameBT;
            $failSAPKP = config('app.url').'/'.'storage/dokumenPenilaian/'.$nameSAKP;
            $failSAP1 = config('app.url').'/'.'storage/dokumenPenilaian/'.$nameSAP1;
            $failSAP2 = config('app.url').'/'.'storage/dokumenPenilaian/'.$nameSAP2;
            $failSASTKP = config('app.url').'/'.'storage/dokumenPenilaian/'.$nameSASTKP;
            $failSAST1 = config('app.url').'/'.'storage/dokumenPenilaian/'.$nameSAST1;
            $failSAST2 = config('app.url').'/'.'storage/dokumenPenilaian/'.$nameSAST2;

            $dataP1 = array(
                'memo_lantikan' => $failMemoLantikan,
                'borang_tindakan' => $failBorangTindakan,
                'surat_akuan_pelantikan' => $failSAP1,
                'surat_akuan_selesai_tugas' => $failSAST1,
                'no_perolehan' => $detailPerolehan->no_perolehan,
            );

            $dataP2 = array(
                'memo_lantikan' => $failMemoLantikan,
                'borang_tindakan' => $failBorangTindakan,
                'surat_akuan_pelantikan' => $failSAP2,
                'surat_akuan_selesai_tugas' => $failSAST2,
                'no_perolehan' => $detailPerolehan->no_perolehan,
            );

            $dataKP = array(
                'memo_lantikan' => $failMemoLantikan,
                'surat_akuan_pelantikan' => $failSAPKP,
                'surat_akuan_selesai_tugas' => $failSASTKP,
                'no_perolehan' => $detailPerolehan->no_perolehan,
            );

            $to_emelKP = User::select('email')->where('id', $userInfoKP->id)->first();
            $to_emelP1 = User::select('email')->where('id', $userInfoP1->id)->first();
            $to_emelP2 = User::select('email')->where('id', $userInfoP2->id)->first();

            Mail::to($to_emelKP)->send(new MailMaklumatKetuaPenilai($dataKP));
            Mail::to($to_emelP1)->send(new MailMaklumatPenilaian1($dataP1));
            Mail::to($to_emelP2)->send(new MailMaklumatPenilaian2($dataP2));

        } else {

            $data=array(
                'iklan_perolehan_id' => $IklanPerolehan->id,
                'user_id' => $user->id,
                'tarikh_laporan_tender' => $request->tarikh_sah_laku,
                'tempoh_sah_laku' => $request->tempoh_sah_laku,
                'tarikh_sah_laku' => $request->tarikh_sah_laku,
                'tarikh_lantik_penilai' => $request->tarikh_sah_laku,
                'tarikh_serah_dokumen_penilaian' => $request->tarikh_serah_dokumen,
                'ketua_penilai' => $request->ketua_penilai,
                'pegawai_penilai_1' => $request->peg_penilai_1,
                'pegawai_penilai_2' => $request->peg_penilai_2,
                'penyedia' => $request->penyedia,
            );

            IklanPerolehan::where('id', $IklanPerolehan->id)->update(['tarikh_kemaskini_penilaian' => Carbon::now()->toDateTimeString()]);
            $penilaian = new DrafPenilaianPerolehan();
            $penilaian->fill($data);
            $penilaian->save();
            $msg = "Penilaian berjaya disimpan.";
        }
        return redirect('/awas')->with('status', $msg);
    }


    public function viewPenilaian($id) {

        $data = PermohonanNomborPerolehan::where('id_perolehan', $id )->first();
        $dataIklan = IklanPerolehan::where('mohon_no_perolehan_id', $data->id_perolehan)->first();
        $dataPenilaian = PenilaianPerolehan::where('iklan_perolehan_id', $dataIklan->id)->first();

        $idKP = $dataPenilaian->ketua_penilai;
        $idP1 = $dataPenilaian->pegawai_penilai_1;
        $idP2 = $dataPenilaian->pegawai_penilai_2;
        $idP = $dataPenilaian->penyedia;
        $tempohsah = $dataPenilaian->tempoh_sah_laku;
        $tarikhserahdokumen = Carbon::parse($dataIklan->tarikh_waktu_tutup)->addDays($tempohsah)->format('d/m/Y');

        $getuserKP = User::where('id', $idKP)->first();
        $getuserP1 = User::where('id', $idP1)->first();
        $getuserP2 = User::where('id', $idP2)->first();
        $getuserP = User::where('id', $idP)->first();
        $jadualHarga = JadualHarga::where('iklan_perolehan_id', $dataIklan->id)->with('syarikat')->get();

        return view('awas::viewpenilaian', compact('data', 'dataPenilaian', 'getuserKP', 'getuserP1', 'getuserP2', 'getuserP', 'tarikhserahdokumen', 'dataIklan', 'jadualHarga'));
    }

    public function editPenilaian($id) {

        $data = PermohonanNomborPerolehan::where('id_perolehan', $id )->first();
        $dataIklan = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();
        $dataPenilaian = DrafPenilaianPerolehan::where('iklan_perolehan_id', $dataIklan->id)->first();
        // $no_perolehan = PermohonanNomborPerolehan::where('id_perolehan', $id)->first();

        // split date tarikh_waktu_tutup
        $iklanTamatdate = $dataIklan->tarikh_waktu_tutup;
        $splitTime = explode(" ", $iklanTamatdate);
        $getDate = $splitTime[0];

        $removedash = explode("-", $getDate);
        $year = $removedash[0];
        $month = $removedash[1];
        $day = $removedash[2];


        // split date tarikh_serah_dokumen_penilaian
        $tsdp = $dataPenilaian->tarikh_serah_dokumen_penilaian;
        $removetimetsdp = explode(" ", $tsdp);
        $newtsdp = $removetimetsdp[0];

        $removedashtsdp = explode("-", $newtsdp);
        $yeartsdp = $removedashtsdp[0];
        $monthtsdp = $removedashtsdp[1];
        $daytsdp = $removedashtsdp[2];

        // define array kp, p1, p2
        $ketuaPenilai = [];
        $pegPenilai1 = [];
        $pegPenilai2 = [];
        $penyedia = [];

        $checkroleKP = ModelHasRoles::where('role_id', 13)->get();
        for ($i = 0; $i < count($checkroleKP); $i++){
            array_push($ketuaPenilai, $checkroleKP[$i]->model_id);
        }

        $checkrolePegPen1 = ModelHasRoles::where('role_id', 8)->get();
        for ($i = 0; $i < count($checkrolePegPen1); $i++){
            array_push($pegPenilai1, $checkrolePegPen1[$i]->model_id);
        }

        $checkrolePegPen2 = ModelHasRoles::where('role_id', 9)->get();
        for ($i = 0; $i < count($checkrolePegPen2); $i++){
            array_push($pegPenilai2, $checkrolePegPen2[$i]->model_id);
        }

        $checkrolePenyedia = ModelHasRoles::where('role_id', 11)->get();
        for ($i = 0; $i < count($checkrolePenyedia); $i++){
            array_push($penyedia, $checkrolePenyedia[$i]->model_id);
        }

        $getListKP = User::whereIn('id', $ketuaPenilai)->get();
        $getListPP1 = User::whereIn('id', $pegPenilai1)->get();
        $getListPP2 = User::whereIn('id', $pegPenilai2)->get();
        $getListPenyedia = User::whereIn('id', $penyedia)->get();

        $tempohsah = $dataPenilaian->tempoh_sah_laku;
        $tarikhserahdokumen = Carbon::parse($dataIklan->tarikh_waktu_tutup)->addDays($tempohsah)->format('d/m/Y');

        return view('awas::editpenilaian', compact('data', 'dataPenilaian', 'tarikhserahdokumen', 'dataIklan', 'getListKP', 'getListPP1', 'getListPP2', 'getListPenyedia', 'year', 'month', 'day', 'yeartsdp', 'monthtsdp', 'daytsdp'));
    }

    public function checkSyarikat($id)
    {
        $check = JadualHarga::where('syarikat_id', $id)->get(['harga','bulan_minggu','tempoh']);
        $syarikat = JadualHarga::where('syarikat_id', $id)->with('syarikat')->get();

        return response()->json([$check, $syarikat]);
    }

    public function saveKeputusanPortal(Request $request)
    {
        // simpan lain lain
        $check_syor = Pengesyoran::where('penilaian_perolehan_id', $request->id_penilaian)->first();
        if ($check_syor) {
            Pengesyoran::where('penilaian_perolehan_id', $request->id_penilaian)->delete(); // delete data
        }
        if($request->status == "draf") { //draf
            if($request->keputusan == "-1") {
                PenilaianPerolehan::where('id', $request->id_penilaian)->update([
                    'tarikh_laporan_tender' => $request->tarikh_laporan,
                    'tarikh_mesy_lembaga' => $request->tarikh_mesyuarat,
                    'bil_mesy' => $request->bil_mesyuarat,
                    'tarikh_result' => $request->tarikh_keputusan,
                    'tarikh_terima_result' => $request->tarikh_terima,
                    'tarikh_edar_result' => $request->tarikh_edar,
                    'catatan' => $request->catatan,
                    'harga' => "",
                    'tempoh' => "",
                    'keputusan_akhir' => $request->keputusan,
                    'status_penilaian' => "draf",
                ]);
            } else {
                PenilaianPerolehan::where('id', $request->id_penilaian)->update([
                    'tarikh_laporan_tender' => $request->tarikh_laporan,
                    'tarikh_mesy_lembaga' => $request->tarikh_mesyuarat,
                    'bil_mesy' => $request->bil_mesyuarat,
                    'tarikh_result' => $request->tarikh_keputusan,
                    'tarikh_terima_result' => $request->tarikh_terima,
                    'tarikh_edar_result' => $request->tarikh_edar,
                    'keputusan_akhir' => $request->keputusan,
                    'harga' => $request->harga,
                    'tempoh' => $request->tempoh." ".$request->bulan_minggu,
                    'catatan' => $request->catatan,
                    'status_penilaian' => "draf",
                ]);
            }
        } else { // hantar
            if($request->keputusan == "-1") {
                PenilaianPerolehan::where('id', $request->id_penilaian)->update([
                    'tarikh_laporan_tender' => $request->tarikh_laporan,
                    'tarikh_mesy_lembaga' => $request->tarikh_mesyuarat,
                    'bil_mesy' => $request->bil_mesyuarat,
                    'tarikh_result' => $request->tarikh_keputusan,
                    'tarikh_terima_result' => $request->tarikh_terima,
                    'tarikh_edar_result' => $request->tarikh_edar,
                    'catatan' => $request->catatan,
                    'keputusan_akhir' => $request->keputusan,
                    'status_penilaian' => "syor_selesai",
                ]);
            } else {
                PenilaianPerolehan::where('id', $request->id_penilaian)->update([
                    'tarikh_laporan_tender' => $request->tarikh_laporan,
                    'tarikh_mesy_lembaga' => $request->tarikh_mesyuarat,
                    'bil_mesy' => $request->bil_mesyuarat,
                    'tarikh_result' => $request->tarikh_keputusan,
                    'tarikh_terima_result' => $request->tarikh_terima,
                    'tarikh_edar_result' => $request->tarikh_edar,
                    'keputusan_akhir' => $request->keputusan,
                    'harga' => $request->harga,
                    'tempoh' => $request->tempoh." ".$request->bulan_minggu,
                    'catatan' => $request->catatan,
                    'status_penilaian' => "syor_tamat",
                ]);

                $dataPenilaian = PenilaianPerolehan::where('id', $request->id_penilaian)->first();
                $iklan = IklanPerolehan::where('id', $dataPenilaian->iklan_perolehan_id)->first();
                $mohon = PermohonanNomborPerolehan::where('id_perolehan', $iklan->mohon_no_perolehan_id )->first();
                // dd($mohon->negeri_id);
                if($mohon->negeri_id == '16') {
                    $pukonsa_data = IklanKelasPukonsa::with('kelas')->where('iklan_perolehan_id', $iklan->id)->distinct('tajuk_id')->get();
                    $upkj_data = IklanKelasUpkj::with('kelas')->where('iklan_perolehan_id', $iklan->id)->distinct('tajuk_id')->get();
                    if( $pukonsa_data == "0" || $upkj_data == "0" ){
                        $this->generate_surat($dataPenilaian->id);
                    } else {
                        $this->generate_memo($dataPenilaian->id);
                    }
                } else{
                    $this->generate_surat($dataPenilaian->id);
                }
            }
        }

        // simpan pengesyoran
        if($request->pengesyoran_array){
            $syor = explode(",", $request->pengesyoran_array);
            for ($i=0; $i < count($syor); $i++) {
                Pengesyoran::create([
                    'penilaian_perolehan_id' => $request->id_penilaian,
                    'syarikat' => $syor[$i] ,
                    'no_pengesyoran' => $i+1
                ]);
            }
        }
        $msg = "Keputusan berjaya disimpan.";
        return redirect('/awas/keputusan')->with('status', $msg);
    }

    public function viewDrafkeputusan($id) {

        $dataIklan = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();
        $data = PermohonanNomborPerolehan::where('id_perolehan', $id )->first();
        $dataPenilaian = PenilaianPerolehan::where('iklan_perolehan_id', $dataIklan->id)->first();
        $syor = Pengesyoran::where('penilaian_perolehan_id', $dataPenilaian->id )->with('syrikt')->get();
        $syor1 = Pengesyoran::where('penilaian_perolehan_id', $dataPenilaian->id )->with('syrikt')->get();
        $syor_array = Pengesyoran::where('penilaian_perolehan_id', $dataPenilaian->id )->with('syrikt')->get();

        $tempohsah = $dataPenilaian->tempoh_sah_laku;
        $tarikhserahdokumen = Carbon::parse($dataIklan->tarikh_waktu_tutup)->addDays($tempohsah)->format('d/m/Y');

        $getuserKP = User::where('id', $dataPenilaian->ketua_penilai)->first();
        $getuserP1 = User::where('id', $dataPenilaian->pegawai_penilai_1)->first();
        $getuserP2 = User::where('id', $dataPenilaian->pegawai_penilai_2)->first();
        $getuserP = User::where('id', $dataPenilaian->penyedia)->first();
        $jadualHarga = JadualHarga::where('iklan_perolehan_id', $dataIklan->id)->with('syarikat')->get();

        return view('awas::viewdrafkeputusan', compact('data', 'dataPenilaian', 'getuserKP', 'getuserP1', 'getuserP2', 'getuserP', 'tarikhserahdokumen', 'dataIklan', 'jadualHarga', 'syor', 'syor1', 'syor_array'));
    }

    public function viewKeputusan($id) {

        $dataIklan = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();
        $data = PermohonanNomborPerolehan::where('id_perolehan', $id )->first();
        $dataPenilaian = PenilaianPerolehan::where('iklan_perolehan_id', $dataIklan->id)->first();
        $syor = Pengesyoran::where('penilaian_perolehan_id', $dataPenilaian->id )->with('syrikt')->get();
        $syarikat = BorangDaftarMinat::where('id', $dataPenilaian->keputusan_akhir)->first();

        $tempohsah = $dataPenilaian->tempoh_sah_laku;
        $tarikhserahdokumen = Carbon::parse($dataIklan->tarikh_waktu_tutup)->addDays($tempohsah)->format('d/m/Y');

        $getuserKP = User::where('id', $dataPenilaian->ketua_penilai)->first();
        $getuserP1 = User::where('id', $dataPenilaian->pegawai_penilai_1)->first();
        $getuserP2 = User::where('id', $dataPenilaian->pegawai_penilai_2)->first();
        $getuserP = User::where('id', $dataPenilaian->penyedia)->first();
        $jadualHarga = JadualHarga::where('iklan_perolehan_id', $id)->with('syarikat')->get();

        return view('awas::viewkeputusan', compact('data', 'dataPenilaian', 'getuserKP', 'getuserP1', 'getuserP2', 'getuserP', 'tarikhserahdokumen', 'dataIklan', 'jadualHarga', 'syor', 'syarikat'));
    }

    public function saveKeputusanPerolehan(Request $request)
    {
        $mergeNR = "";
        // dd('masuk');
        if($request->no_rujukan_ep && $request->no_rujukan_ep1 ){
            $mergeNR =  '(' . $request->no_rujukan_ep. ')' . ' P.P.S (s) 15/2011 Jld.' . ' ' . $request->no_rujukan_ep1;
        }
        $mohon = PermohonanNomborPerolehan::where('id_perolehan', $request->id )->first();
        $iklan = IklanPerolehan::where('mohon_no_perolehan_id', $request->id )->first();
        if($request->status_perolehan == "draf") { //draf
            PenilaianPerolehan::create([
                'tarikh_laporan_tender' => $request->tarikh_laporan,
                'tarikh_mesy_lembaga' => $request->tarikh_mesyuarat,
                'bil_mesy' => $request->bil_mesyuarat,
                'tarikh_result' => $request->tarikh_keputusan,
                'tarikh_terima_result' => $request->tarikh_terima,
                'tarikh_edar_result' => $request->tarikh_edar,
                'nama_syarikat' => $request->keputusan,
                'harga' => $request->harga,
                'tempoh' => $request->tempoh." ".$request->bulan_minggu,
                'catatan' => $request->catatan,
                'iklan_perolehan_id' =>$iklan->id,
                'no_rujukan' => $mergeNR,
                'status_penilaian' => "draf",
                'alamat' => $request->alamat,
                'alamat2' => $request->alamat2,
                'alamat3' => $request->alamat3,
                'bandar' => $request->bandar,
                'poskod' => $request->poskod,
                'negeri' => $request->negeri,
            ]);
        } else { // hantar
            $penilaian = PenilaianPerolehan::create([
                'tarikh_laporan_tender' => $request->tarikh_laporan,
                'tarikh_mesy_lembaga' => $request->tarikh_mesyuarat,
                'bil_mesy' => $request->bil_mesyuarat,
                'tarikh_result' => $request->tarikh_keputusan,
                'tarikh_terima_result' => $request->tarikh_terima,
                'tarikh_edar_result' => $request->tarikh_edar,
                'nama_syarikat' => $request->keputusan,
                'harga' => $request->harga,
                'tempoh' => $request->tempoh." ".$request->bulan_minggu,
                'catatan' => $request->catatan,
                'iklan_perolehan_id' =>$iklan->id,
                'no_rujukan' => $mergeNR,
                'status_penilaian' => "syor_tamat",
                'alamat' => $request->alamat,
                'alamat2' => $request->alamat2,
                'alamat3' => $request->alamat3,
                'bandar' => $request->bandar,
                'poskod' => $request->poskod,
                'negeri' => $request->negeri,
            ]);

            $dataPenilaian = PenilaianPerolehan::where('id', $penilaian->id)->first();
            $iklan = IklanPerolehan::where('id', $dataPenilaian->iklan_perolehan_id)->first();
            $mohon = PermohonanNomborPerolehan::where('id_perolehan', $iklan->mohon_no_perolehan_id )->first();
            if($mohon->negeri_id == '16') {
                $pukonsa_data = IklanKelasPukonsa::with('kelas')->where('iklan_perolehan_id', $iklan->id)->distinct('tajuk_id')->get();
                $upkj_data = IklanKelasUpkj::with('kelas')->where('iklan_perolehan_id', $iklan->id)->distinct('tajuk_id')->get();
                if($pukonsa_data == "0" || $upkj_data == "0" ){
                    $this->generate_surat($dataPenilaian->id);
                } else {
                    $this->generate_memo($dataPenilaian->id);
                }
            } else{
                $this->generate_surat($dataPenilaian->id);
            }
        }
        $msg = "Keputusan berjaya disimpan.";
        return redirect('/awas/keputusan')->with('status', $msg);
    }

    public function viewKeputusanPerolehan($id) {

        $dataIklan = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();
        $data = PermohonanNomborPerolehan::where('id_perolehan', $id )->first();
        $dataPenilaian = PenilaianPerolehan::where('iklan_perolehan_id', $dataIklan->id)->first();

        return view('awas::viewkeputusanperolehan', compact('data', 'dataPenilaian' ));
    }

    public function viewDrafKeputusanPerolehan($id) {

        $dataIklan = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();
        $data = PermohonanNomborPerolehan::where('id_perolehan', $id )->first();
        $dataPenilaian = PenilaianPerolehan::where('iklan_perolehan_id', $dataIklan->id)->first();

        return view('awas::viewdrafkeputusanPerolehan', compact('data', 'dataPenilaian', 'dataIklan'));
    }

    public function saveKeputusanPerolehanDraf(Request $request)
    {
        // simpan lain lain
        $mergeNR = "";
        if($request->no_rujukan_ep && $request->no_rujukan_ep1 ){
            $mergeNR =  '(' . $request->no_rujukan_ep. ')' . ' P.P.S (s) 15/2011 Jld.' . ' ' . $request->no_rujukan_ep1;
        }
        if($request->status == "draf") { //draf
            PenilaianPerolehan::where('id', $request->id_penilaian)->update([
                'tarikh_laporan_tender' => $request->tarikh_laporan,
                'tarikh_mesy_lembaga' => $request->tarikh_mesyuarat,
                'bil_mesy' => $request->bil_mesyuarat,
                'tarikh_result' => $request->tarikh_keputusan,
                'tarikh_terima_result' => $request->tarikh_terima,
                'tarikh_edar_result' => $request->tarikh_edar,
                'nama_syarikat' => $request->keputusan,
                'harga' => $request->harga,
                'tempoh' => $request->tempoh." ".$request->bulan_minggu,
                'catatan' => $request->catatan,
                'no_rujukan' => $mergeNR,
                'status_penilaian' => "draf",
                'alamat' => $request->alamat,
                'alamat2' => $request->alamat2,
                'alamat3' => $request->alamat3,
                'bandar' => $request->bandar,
                'poskod' => $request->poskod,
                'negeri' => $request->negeri,
            ]);
        } else { // hantar
            PenilaianPerolehan::where('id', $request->id_penilaian)->update([
                'tarikh_laporan_tender' => $request->tarikh_laporan,
                'tarikh_mesy_lembaga' => $request->tarikh_mesyuarat,
                'bil_mesy' => $request->bil_mesyuarat,
                'tarikh_result' => $request->tarikh_keputusan,
                'tarikh_terima_result' => $request->tarikh_terima,
                'tarikh_edar_result' => $request->tarikh_edar,
                'nama_syarikat' => $request->keputusan,
                'harga' => $request->harga,
                'tempoh' => $request->tempoh." ".$request->bulan_minggu,
                'catatan' => $request->catatan,
                'no_rujukan' => $mergeNR,
                'status_penilaian' => "syor_tamat",
                'alamat' => $request->alamat,
                'alamat2' => $request->alamat2,
                'alamat3' => $request->alamat3,
                'bandar' => $request->bandar,
                'poskod' => $request->poskod,
                'negeri' => $request->negeri,
            ]);

            $dataPenilaian = PenilaianPerolehan::where('id', $request->id_penilaian)->first();
            $iklan = IklanPerolehan::where('id', $dataPenilaian->iklan_perolehan_id)->first();
            $mohon = PermohonanNomborPerolehan::where('id_perolehan', $iklan->mohon_no_perolehan_id )->first();
            if($mohon->negeri_id == '16') {
                $pukonsa_data = IklanKelasPukonsa::with('kelas')->where('iklan_perolehan_id', $iklan->id)->distinct('tajuk_id')->get();
                $upkj_data = IklanKelasUpkj::with('kelas')->where('iklan_perolehan_id', $iklan->id)->distinct('tajuk_id')->get();
                if($pukonsa_data == "0" || $upkj_data == "0" ){
                    $this->generate_surat($dataPenilaian->id);
                } else {
                    $this->generate_memo($dataPenilaian->id);
                }
            } else{
                $this->generate_surat($dataPenilaian->id);
            }
        }
        $msg = "Keputusan berjaya disimpan.";

        return redirect('/awas/keputusan')->with('status', $msg);

    }

    public function generate_memo($id)
    {
        $data_penilaian = PenilaianPerolehan::where('id', $id)->first();
        $data_iklan = IklanPerolehan::where('id', $data_penilaian->iklan_perolehan_id)->first();
        $data_perolehan = PermohonanNomborPerolehan::where('id_perolehan', $data_iklan->mohon_no_perolehan_id )->first();
        $noPerolehan = str_replace("/","_",$data_perolehan->no_perolehan);
        $pejabat = Pejabat::where('id', $data_perolehan->section_id )->first();
        $filename = 'Memo_Edaran_Keputusan_MLP_'.$noPerolehan.'.pdf';

        $header = HeaderSurat::first();
        $data = MemoEdarKeputusan::first();

        $jabatan = explode("(", $header->jabatan);
        $jabatanBM = $jabatan[0];
        $jabatanEN = '(' . $jabatan[1];

        $kementerian = explode("(", $header->kementerian);
        $kementerianBM = $kementerian[0];
        $kementerianEN = '(' . $kementerian[1];

        $alamat = preg_split("/\,/", $header->alamat);

        $moto = preg_split("/\n/", $data->moto);

        $info_pengarah = Tandatangan::first();
        Carbon::setLocale('ms_MY');

        $data = [
                'jata_negara' => config('app.url'). $header->path_jata_negara,
                'memo' => config('app.url'). $header->path_img_memo,
                'jabatanBM' => $jabatanBM,
                'jabatanEN' => $jabatanEN,
                'kementerianBM' => $kementerianBM,
                'kementerianEN' => $kementerianEN,
                'alamats' => $alamat,
                'laman_web' => $header->laman_web,
                'no_tel' => $header->no_tel,
                'no_fax' => $header->no_fax,
                'email' => $header->email,
                'rujukan' => $data_penilaian->no_rujukan,
                'tarikh' => Carbon::parse($data_penilaian->tarikh_edar_result)->translatedFormat('d F Y') ,
                'perkara' => $data->perkara,
                'kementerian' => $data->kementerian,
                'kementerian1' => $data->kementerian1,
                'text_1' => $data->text_1,
                'title' => $data->title,
                'text_3' => $data->text_3,
                'moto' => $moto,
                'sym' => $data->sym,
                'nama' => $info_pengarah->nama,
                'bil'=> $data_penilaian->bil_mesy,
                'tajuk_perolehan'=> $data_perolehan->tajuk_perolehan,
                'no_perolehan'=> $data_perolehan->no_perolehan,
                'bahagian' => $pejabat->bahagian,
                'tanda_tangan' => config('app.url'). $info_pengarah->path_tandatangan,
        ];

        $view = \View::make('pdf_memoKeputusan', $data);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Memo Edaran Keputusan MLP');
        $pdf::SetMargins(20, 10, 15, true); //left bottom right
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        try {
            mkdir(base_path('/storage/app/public/keputusan'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $path = storage_path().'/app/public/keputusan/'. $filename;
        $pdf::Output($path, 'F');

        $user_penyedia = User::where('id', $data_perolehan->user_id)->first();
        $file = config('app.url').'/'.'storage/keputusan/'. $filename;
        $data = array('no_perolehan' => $data_perolehan->no_perolehan);
        Mail::to($user_penyedia->email)->send(new MailMemoEdaranKeputusan($file, $data));

        PenilaianPerolehan::where('id', $id)->update([
            'storage_memo_keputusan' => 'storage/keputusan/'.$filename,
            'nama_memo_keputusan' => $filename,
        ]);

    }

    public function generate_surat($id){
        $data_penilaian = PenilaianPerolehan::where('id', $id)->first();
        $data_iklan = IklanPerolehan::where('id', $data_penilaian->iklan_perolehan_id)->first();
        $data_perolehan = PermohonanNomborPerolehan::where('id_perolehan', $data_iklan->mohon_no_perolehan_id )->first();
        $noPerolehan = str_replace("/","_",$data_perolehan->no_perolehan);


        $filename = 'Surat_Edaran_Keputusan_MLP_'.$noPerolehan.'.pdf';

        $header = HeaderSurat::first();
        $data = SuratEdarKeputusan::first();

        $jabatan = explode("(", $header->jabatan);
        $jabatanBM = $jabatan[0];
        $jabatanEN = '(' . $jabatan[1];

        $kementerian = explode("(", $header->kementerian);
        $kementerianBM = $kementerian[0];
        $kementerianEN = '(' . $kementerian[1];

        $alamat = preg_split("/\,/", $header->alamat);

        $moto = preg_split("/\n/", $data->moto);

        $info_pengarah = Tandatangan::first();
        Carbon::setLocale('ms_MY');

        $pukonsa_data = IklanKelasPukonsa::with('kelas')->where('iklan_perolehan_id', $data_iklan->id)->distinct('tajuk_id')->get();
        $upkj_data = IklanKelasUpkj::with('kelas')->where('iklan_perolehan_id', $data_iklan->id)->distinct('tajuk_id')->get();

        if($upkj_data){
            $ngr = Negeri::where('id', '10')->first();
        } else if($pukonsa_data){
            $ngr = Negeri::where('id', '11')->first();
        } else {
            $ngr = Negeri::where('id', $data_perolehan->negeri_id)->first();
        }
        $alamatnegeri = preg_split("/\,/", $ngr->alamat);

        $data = [
                'jata_negara' => config('app.url'). $header->path_jata_negara,
                'jabatanBM' => $jabatanBM,
                'jabatanEN' => $jabatanEN,
                'kementerianBM' => $kementerianBM,
                'kementerianEN' => $kementerianEN,
                'alamats' => $alamat,
                'laman_web' => $header->laman_web,
                'no_tel' => $header->no_tel,
                'no_fax' => $header->no_fax,
                'email' => $header->email,
                'rujukan' => $data_penilaian->rujukan,
                'title' => $data->title,
                'kementerian' => $data->kementerian,
                'text_1' => $data->text_1,
                'text_2' => $data->text_2,
                'text_3' => $data->text_3,
                'moto' => $moto,
                'sym' => $data->sym,
                'nama' => $info_pengarah->nama,
                'jawatan' => $info_pengarah->jawatan,
                'tanda_tangan' => config('app.url'). $info_pengarah->path_tandatangan,
                'tajuk_perolehan'=> $data_perolehan->tajuk_perolehan,
                'no_perolehan'=> $data_perolehan->no_perolehan,
                'tarikh' => Carbon::parse($data_penilaian->tarikh_edar_result)->translatedFormat('d F Y') ,
                'alamat_negeri' =>$alamatnegeri,
                'bil'=> $data_penilaian->bil_mesy,
        ];

        $view = \View::make('pdf_suratEdarKeputusan', $data);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::reset();
        $pdf::SetTitle('Surat Edaran Keputusan MLP');
        $pdf::SetMargins(20, 10, 15, true); //left bottom right
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $ruj = '<label style="font-size:11px; font-family: Arial;">'.$data_penilaian->no_rujukan.'</label><br>';
        $date = '<label style="font-size:11px; font-family: Arial;">'.Carbon::parse($data_penilaian->tarikh_edar_result)->translatedFormat('d F Y').'</label><br>';
        $pdf::writeHTMLCell(0, 0, 135, -250, $ruj); //width  height x y
        $pdf::writeHTMLCell(0, 0, 155, -245, $date);

        try {
            mkdir(base_path('/storage/app/public/keputusan'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $path = storage_path().'/app/public/keputusan/'. $filename;
        $pdf::Output($path, 'F');

        $user = auth()->user();
        $user_penyedia = User::where('id', $user->id)->first();
        $file = config('app.url').'/'.'storage/keputusan/'. $filename;
        $data = array('no_perolehan' => $data_perolehan->no_perolehan);
        Mail::to($user_penyedia->email)->send(new MailSuratEdaranKeputusan($file, $data));

        PenilaianPerolehan::where('id', $id)->update([
            'storage_surat_keputusan' => 'storage/keputusan/'.$filename,
            'nama_surat_keputusan' => $filename,
        ]);

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getiklan($id)
    {
        $iklan  = PenilaianPerolehan::where('id', $id)
            ->with('iklanPerolehan.mohonNoPerolehan.negeri')
            ->with('iklanPerolehan.mohonNoPerolehan.matrikIklan.jenisTender')
            ->with('iklanPerolehan.dokumenKontrak')
            ->with('dokumenSST')
            ->with('borangDaftarMinat.jadualharga')
            ->with('borangDaftarMinat.lawatanTapak')
            ->first();

        return response()->json([$iklan]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function butiranSST($id)
    {
        $iklan  = PenilaianPerolehan::where('id', $id)
            ->with('iklanPerolehan.mohonNoPerolehan.negeri')
            ->with('iklanPerolehan.mohonNoPerolehan.matrikIklan.jenisTender')
            ->with('iklanPerolehan.grade')
            ->with('dokumenSST')
            ->with('borangDaftarMinat.jadualharga')
            ->with('borangDaftarMinat.lawatanTapak')
            ->with('borangDaftarMinat.grade')
            ->first();

            $bidang = BidangSubbidang::where('iklan_perolehan_id', $iklan->iklan_perolehan_id)
                ->distinct('bidang_id')->get();

            $subbidang = BidangSubbidang::where('iklan_perolehan_id', $iklan->iklan_perolehan_id)
                ->get();

            $kelas = KelasPengkhususan::where('iklan_perolehan_id', $iklan->iklan_perolehan_id)
                ->distinct('kelas_id')->get();

            $pengkhususan = KelasPengkhususan::where('iklan_perolehan_id', $iklan->iklan_perolehan_id)
                ->get();

            $tajuk_upkj = IklanKelasUpkj::where('iklan_perolehan_id', $iklan->iklan_perolehan_id)
                        ->with('kelas')->with('khusus')
                        ->distinct('tajuk_id')->get();

            $tajuk_subtajuk_upkj = IklanKelasUpkj::where('iklan_perolehan_id', $iklan->iklan_perolehan_id)
                        ->with('kelas')->with('khusus')
                        ->get();

            $tajuk_pukonsa = IklanKelasPukonsa::where('iklan_perolehan_id', $iklan->iklan_perolehan_id)
                        ->with('kelas')->with('khusus')
                        ->distinct('tajuk_id')->get();

            $tajuk_subtajuk_pukonsa = IklanKelasPukonsa::where('iklan_perolehan_id', $iklan->iklan_perolehan_id)
                        ->with('kelas')->with('khusus')
                        ->get();

        $harga = $iklan->harga;
        $h = (str_replace('.', '-', $harga));
        $h = preg_replace('/[^A-Za-z0-9\-]/','', $h);
        $h = str_replace('-', '.', $h);
        $protege = (int)((0.01* (int)$h) / 24000);

        if ( $h <= 10000000 ) {
            $sah_laku = 12;
        } else if ( $h > 10000000) {
            $sah_laku = 24;
        }

        $tempoh = $iklan->tempoh;

        $tempoh_kontrak = (int)(preg_replace('/[^0-9]/','',$tempoh));
        $hari = 14;

        if (str_contains($tempoh, 'bulan') or str_contains($tempoh, 'BULAN') or str_contains($tempoh, 'Bulan')) {
            $bulan = $tempoh_kontrak + $sah_laku + 3 ;
            $minggu = 0;
        } else if (str_contains($tempoh, 'minggu') or str_contains($tempoh, 'MINGGU') or str_contains($tempoh, 'Minggu')) {
            $bulan = $sah_laku + 3 ;
            $minggu = $tempoh_kontrak;
        }

        $tempoh_perlindungan;

        $nilai_bon = number_format((0.05*$h) , 2 );
        $nilai_bon = explode(",", $nilai_bon);
        $nilai_bon = implode(', ', $nilai_bon);

        if ($h <= 50000 ) {
            $nilai_polisi = 10000;
        } else if ($h >= 50001 && $h <= 100000) {
            $nilai_polisi = 25000;
        } else if ($h >= 100001 && $h <= 200000) {
            $nilai_polisi = 50000;
        } else if ($h >= 200001 && $h <= 500000){
            $nilai_polisi = 100000;
        } else if ($h >= 500001 && $h <= 5000000){
            $nilai_polisi = 200000;
        } else if ($h > 5000000 && $h <= 20000000){
            $nilai_polisi = 500000;
        } else if ($h > 20000000 && $h <= 50000000){
            $nilai_polisi = 1000000;
        } else if ($h > 50000000 ){
            $nilai_polisi = 2000000;
        }

        $nilai_polisi = number_format($nilai_polisi , 2 );
        $nilai_polisi = explode(",", $nilai_polisi);
        $nilai_polisi = implode(', ', $nilai_polisi);

        $template = TemplatSST::first();

        return view('awas::butiranSST', compact('iklan', 'kelas', 'pengkhususan', 'protege', 'sah_laku', 'nilai_bon', 'nilai_polisi', 'tajuk_upkj', 'tajuk_subtajuk_upkj', 'tajuk_pukonsa', 'tajuk_subtajuk_pukonsa', 'template', 'bulan', 'minggu', 'hari', 'bidang', 'subbidang'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dokumenSST(Request $request)
    {
        $dokumen_sst = $request->file('file_upload');
        $id_penilaian = $request->penilaian_id;
        $path = $nama = "";
        if($dokumen_sst) {

            $nama = $dokumen_sst->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $nama);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $nama = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $dokumen_sst->move(storage_path().'/app/public/sst/'.$id_penilaian, $nama);
            $path ='storage/sst/'.$id_penilaian.'/'.$nama;

            $dokumen = DokumenSST::where('penilaian_perolehan_id', $id_penilaian)->first();

            if($dokumen) {
                DokumenSST::where('penilaian_perolehan_id', $id_penilaian)->update(
                    [
                        'fail' => $path,
                        'nama_fail' => $nama,
                    ]
                );

            } else {

                $data_dokumen_sst = array(
                    'penilaian_perolehan_id' => $id_penilaian,
                    'fail' => $path,
                    'nama_fail' => $nama,
                );

                $sst = new DokumenSST;
                $sst->fill($data_dokumen_sst);
                $sst->save();

            }

        }

        return redirect('/awas/senarai_petender_berjaya');
    }

    public function filterPenilai(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $tarikh = array();
        $tarikhmula = '';
        $tarikhakhir = '';
        if(!is_null($request->tarikh))
        {
            $tarikh = str_replace(' ', '', $request->tarikh);
            $tarikh = explode ("-", $tarikh);
            $tarikh = str_replace('/', '-', $tarikh);
            $tarikhmula = date('Y-m-d', strtotime($tarikh[0]));
            $tarikhakhir = date('Y-m-d', strtotime($tarikh[1]));
        }

        $data = [];
        $data = '{"tarikhmula":'.json_encode($tarikhmula)
            .',"tarikhakhir":'.json_encode($tarikhakhir)
            .'}';
        $data = json_decode($data);

        return redirect()->route('laporantender')->with( ['data2' => $data] );
    }

    public function generateSuratPerakuan(Request $request) {

        $id = $request->dataID;
        $tempoh = $request->naskah;
        $tarikh = $request->fulldate;

        $header = HeaderSurat::first();
        $ttangan = Tandatangan::first();
        $hantarDokumen = HantarDokumen::first();
        $dataNoPerolehan = PermohonanNomborPerolehan::whereIn('id_perolehan', $id )->get();
        $dataPenilaian = PenilaianPerolehan::whereIn('iklan_perolehan_id', $id)->get();
        $dataIklan = IklanPerolehan::whereIn('mohon_no_perolehan_id', $id)->get();

        $maklumatTenderKerja = DB::table('mohon_no_perolehan')
        ->join('penilaian_perolehan', 'penilaian_perolehan.iklan_perolehan_id', '=', 'mohon_no_perolehan.id_perolehan')
        ->join('iklan_perolehan', 'iklan_perolehan.mohon_no_perolehan_id', '=', 'penilaian_perolehan.iklan_perolehan_id')
        ->whereIn('mohon_no_perolehan.id_perolehan', $id)
        ->get();

        // update status untuk generate senarai surat lanjutan
        PenilaianPerolehan::whereIn('iklan_perolehan_id', $id)->update(['status_penilaian' => 1]);

        $bil = 0;

        $today = Carbon::now()->format('d.m.Y');
        $splitBulan = explode(".", $today);

        // get nama bulan
        if ($splitBulan[1] == "01") {
            $bulan = "Januari";
        } elseif ($splitBulan[1] == "02") {
            $bulan = "Februari";
        } elseif ($splitBulan[1] == "03") {
            $bulan = "Mac";
        } elseif ($splitBulan[1] == "04") {
            $bulan = "April";
        } elseif ($splitBulan[1] == "05") {
            $bulan = "Mei";
        } elseif ($splitBulan[1] == "06") {
            $bulan = "Jun";
        } elseif ($splitBulan[1] == "07") {
            $bulan = "Julai";
        } elseif ($splitBulan[1] == "08") {
            $bulan = "Ogos";
        } elseif ($splitBulan[1] == "09") {
            $bulan = "September";
        } elseif($splitBulan[1] == "10") {
            $bulan = "Oktober";
        } elseif ($splitBulan[1] == "11") {
            $bulan = "November";
        } else {
            $bulan = "Disember";
        }

        // get bulan tahun
        $bulanTahun = $bulan.' '.$splitBulan[2];

        // count naskah
        if ($tempoh == "1") {
            $naskah = "satu";
        } elseif ($tempoh == "2") {
            $naskah = "dua";
        } elseif ($tempoh == "3") {
            $naskah = "tiga";
        } elseif ($tempoh == "4") {
            $naskah = "empat";
        } elseif ($tempoh == "5") {
            $naskah = "lima";
        } elseif ($tempoh == "6") {
            $naskah = "enam";
        } elseif ($tempoh == "7") {
            $naskah = "tujuh";
        } elseif ($tempoh == "8") {
            $naskah = "lapan";
        } elseif ($tempoh == "9") {
            $naskah = "sembilan";
        } elseif ($tempoh == "10") {
            $naskah = "sepuluh";
        } elseif ($tempoh == "11") {
            $naskah = "sebelas";
        } elseif ($tempoh == "12") {
            $naskah = "dua belas";
        } elseif ($tempoh == "13") {
            $naskah = "tiga belas";
        } elseif ($tempoh == "14") {
            $naskah = "empat belas";
        } elseif ($tempoh == "15") {
            $naskah = "lima belas";
        } elseif ($tempoh == "16") {
            $naskah = "enam belas";
        } elseif ($tempoh == "17") {
            $naskah = "tujuh belas";
        } elseif ($tempoh == "18") {
            $naskah = "lapan belas";
        } elseif ($tempoh == "19") {
            $naskah = "sembilan belas";
        } else {
            $naskah = "dua puluh";
        }

        // full ayat naskah
        $jumlahNaskah = $naskah.' ('.$tempoh.')';

        // split header jabatan
        $getJabatan = $header->jabatan;
        $splitJabatan = explode('(', $getJabatan);
        $jabatanBm = $splitJabatan[0];
        $jabatanEn = '(' . $splitJabatan[1];

        // split header kementerian
        $getKementerian = $header->kementerian;
        $splitKementerian = explode('(', $getKementerian);
        $kementerianBm = $splitKementerian[0];
        $kementerianEn = '(' . $splitKementerian[1];

        // split alamat header surat
        $alamatHeader = preg_split("/\,/", $header->alamat);

        // split alamat SHK
        $alamatSU = preg_split("/\n/", $hantarDokumen->alamat);

        // split moto
        $moto = $hantarDokumen->moto;
        $splitMoto = explode("\n", $moto);
        $moto1 = $splitMoto[0];
        $moto2 = $splitMoto[1];

        // get jata negara , memo, tanda tangan
        $jata = config('app.url'). $header->path_jata_negara;
        $memo = config('app.url'). $header->path_img_memo;
        $tt = config('app.url'). $ttangan->path_tandatangan;

        // generate surat hantar dokumen KASA
        $datapdfSHDKasa = [
            'bil' => $bil,
            'jata_negara' => $jata,
            'memo_surat' => $memo,
            'jabatan_Bm' => $jabatanBm,
            'jabatan_En' => $jabatanEn,
            'kementerian_Bm' => $kementerianBm,
            'kementerian_En' => $kementerianEn,
            'alamatH' => $alamatHeader,
            'laman_web' => $header->laman_web,
            'no_tel' => $header->no_tel,
            'no_fax' => $header->no_fax,
            'email' => $header->email,
            'rujukan' => $hantarDokumen->rujukan,
            'bulan_tahun' => $bulanTahun,
            'alamatSU' => $alamatSU,
            'up' => $hantarDokumen->up,
            'gelaran' => $hantarDokumen->title,
            'naskah_kp' => $jumlahNaskah,
            'tajuk' => $hantarDokumen->tajuk,
            'teks_1' => $hantarDokumen->text_1,
            'teks_2' => $hantarDokumen->text_2,
            'teks_3' => $hantarDokumen->text_3,
            'moto_1' => $moto1,
            'moto_2' => $moto2,
            'frasa_akhir' => $hantarDokumen->sym,
            'nama_pegawai' => $ttangan->nama,
            'data_tender' => $maklumatTenderKerja,
            'jawatan_pegawai' => $ttangan->jawatan,
            'tanda_tangan' => $tt,
        ];

        // start surat hantar dokumen
        $filename = 'Surat Hantar Dokumen Ke KASA - '.$tarikh.'.pdf';

        $ruj = '<label style="font-size:11px; font-family: Arial;">(&nbsp;&nbsp;&nbsp;&nbsp;) ' . $datapdfSHDKasa['rujukan'] .' </label><br>';
        $date = '<label style="font-size:11px; font-family: Arial;">' . $datapdfSHDKasa['bulan_tahun'] .' </label><br>';

        $view = \View::make('pdf_suratperakuan', $datapdfSHDKasa);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Surat Hantar Dokumen Ke KASA');
        $pdf::SetMargins(20, 10, 15, true); //left bottom right
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::writeHTMLCell(0, 0, 145, -250, $ruj); //width  height x y
        $pdf::writeHTMLCell(0, 0, 173, -245, $date);


        // start kertas pertimbangan
        $lampiran = '<label style="font-size:11px; font-family: Arial; color: grey; font-weight: bold;">LAMPIRAN A</label><br>';
        $today = '<label style="font-size:11px; font-family: Arial; color: grey;">' . $datapdfSHDKasa['bulan_tahun'] .' </label><br>';

        $view_borang = \View::make('pdf_suratperakuancontent', $datapdfSHDKasa);
        $html_borang = $view_borang->render();

        $pdf::SetMargins(10, 20, 15, true); //left bottom right
        $pdf::AddPage('L');
        $pdf::writeHTML($html_borang, true, false, true, false, '');

        $pdf::setFooterCallback(
            function ( $pdf) use ( $view_borang, $lampiran, $today) {

                $pdf->writeHTMLCell(0, 0, 255, 5, $lampiran); //width height x y
                $pdf->writeHTMLCell(0, 0, 260, 10, $today); //width height x y

            }
        );

        try {
            mkdir(base_path('/storage/app/public/dokumenKASA'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $path = storage_path().'/app/public/dokumenKASA/'. $filename;
        $pdf::Output($path, 'F');

        return response()->json(['status' => 'Done']);
    }

    public function generateSuratLanjutan(Request $request) {

        $id = $request->dataID;
        $tarikh = $request->fulldate;

        $header = HeaderSurat::first();
        $ttangan = Tandatangan::first();
        $lanjutsl = LanjutSahLaku::first();
        $dataNoPerolehan = PermohonanNomborPerolehan::where('id_perolehan', $id )->first();
        $dataPenilaian = PenilaianPerolehan::where('iklan_perolehan_id', $id)->first();
        $dataIklan = IklanPerolehan::where('mohon_no_perolehan_id', $id)->first();

        $maklumatTenderKerja = DB::table('mohon_no_perolehan')
        ->join('penilaian_perolehan', 'penilaian_perolehan.iklan_perolehan_id', '=', 'mohon_no_perolehan.id_perolehan')
        ->join('iklan_perolehan', 'iklan_perolehan.mohon_no_perolehan_id', '=', 'penilaian_perolehan.iklan_perolehan_id')
        ->whereIn('mohon_no_perolehan.id_perolehan', $id)
        ->get();

        // update status selepas generate surat lanjutan
        PenilaianPerolehan::whereIn('iklan_perolehan_id', $id)->update(['status_penilaian' => 2]);

        $bil = 0;

        $today = Carbon::now()->format('d.m.Y');
        $splitBulan = explode(".", $today);

        // get nama bulan
        if ($splitBulan[1] == "01") {
            $bulan = "JANUARI";
        } elseif ($splitBulan[1] == "02") {
            $bulan = "FEBRUARI";
        } elseif ($splitBulan[1] == "03") {
            $bulan = "MAC";
        } elseif ($splitBulan[1] == "04") {
            $bulan = "APRIL";
        } elseif ($splitBulan[1] == "05") {
            $bulan = "MEI";
        } elseif ($splitBulan[1] == "06") {
            $bulan = "JUN";
        } elseif ($splitBulan[1] == "07") {
            $bulan = "JULAI";
        } elseif ($splitBulan[1] == "08") {
            $bulan = "OGOS";
        } elseif ($splitBulan[1] == "09") {
            $bulan = "SEPTEMBER";
        } elseif($splitBulan[1] == "10") {
            $bulan = "OKTOBER";
        } elseif ($splitBulan[1] == "11") {
            $bulan = "NOVEMBER";
        } else {
            $bulan = "DISEMBER";
        }

        // get bulan tahun
        $bulanTahun = $bulan.' '.$splitBulan[2];

        // split header jabatan
        $getJabatan = $header->jabatan;
        $splitJabatan = explode('(', $getJabatan);
        $jabatanBm = $splitJabatan[0];
        $jabatanEn = '(' . $splitJabatan[1];

        // split header kementerian
        $getKementerian = $header->kementerian;
        $splitKementerian = explode('(', $getKementerian);
        $kementerianBm = $splitKementerian[0];
        $kementerianEn = '(' . $splitKementerian[1];

        // split alamat header surat
        $alamat = preg_split("/\,/", $header->alamat);

        // split alamat KSU
        $alamatsl = preg_split("/\n/", $lanjutsl->alamat);

        // split moto
        $moto = preg_split("/\n/", $lanjutsl->moto);

        // get jata negara , memo, tanda tangan
        $jata = config('app.url'). $header->path_jata_negara;
        $memo = config('app.url'). $header->path_img_memo;
        $tt = config('app.url'). $ttangan->path_tandatangan;

        // get tarikh Serah Dokumen Untuk Penilaian
        $tarikhMulaSerahDokumen = Carbon::parse($dataPenilaian->tarikh_serah_dokumen_penilaian)->format('d/m/Y');
        $splitTarikhMulaSerahDokumen = str_replace('/', '.', $tarikhMulaSerahDokumen);

        $tarikhAkhirSerahDokumen = Carbon::parse($dataPenilaian->tarikh_serah_dokumen_penilaian)->addDays(90)->format('d/m/Y');
        $splitTarikhAkhirSerahDokumen = str_replace('/', '.', $tarikhAkhirSerahDokumen);

        // generate surat hantar dokumen KASA
        $datapdfSHDKasa = [
            'bil' => $bil,
            'jata_negara' => $jata,
            'memo_surat' => $memo,
            'jabatan_Bm' => $jabatanBm,
            'jabatan_En' => $jabatanEn,
            'kementerian_Bm' => $kementerianBm,
            'kementerian_En' => $kementerianEn,
            'alamatH' => $alamat,
            'laman_web' => $header->laman_web,
            'no_tel' => $header->no_tel,
            'no_fax' => $header->no_fax,
            'email' => $header->email,
            'alamatsl' => $alamatsl,
            'rujukan' => $lanjutsl->rujukan,
            'bulan_tahun' => $bulanTahun,
            'alamat' => $alamatsl,
            'up' => $lanjutsl->up,
            'gelaran' => $lanjutsl->title,
            'tajuk' => $lanjutsl->tajuk,
            'teks_1' => $lanjutsl->text_1,
            'teks_2' => $lanjutsl->text_2,
            'moto' => $moto,
            'frasa_akhir' => $lanjutsl->sym,
            'tanda_tangan' => $tt,
            'nama_pegawai' => $ttangan->nama,
            'jawatan_pegawai' => $ttangan->jawatan,
            'maklumat_tender' => $maklumatTenderKerja,
            'nama_pelulus' => $lanjutsl->nama,
            'jawatan' => $lanjutsl->jawatan,
            'kementerian' => $lanjutsl->kementerian,
        ];

        $filename = 'Surat Mohon Lanjut Sah Laku Tender - '.$tarikh.'.pdf';

        $ruj = '<label style="font-size:11px; font-family: Arial;">Rujukan :  (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) ' . $datapdfSHDKasa['rujukan'] .' </label><br>';
        $date = '<label style="font-size:11px; font-family: Arial;">Tarikh &nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . date('F Y') .' </label><br>';

        $view = \View::make('pdf_suratlanjutan', $datapdfSHDKasa);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Surat Mohon Lanjut Sah Laku Tender');
        $pdf::SetMargins(20, 10, 15, true); //left bottom right
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::writeHTMLCell(0, 0, 130, -250, $ruj); //width  height x y
        $pdf::writeHTMLCell(0, 0, 130, -245, $date);

        $sulit = '<label style="font-size:11px; font-family: Arial; color: grey; font-weight: bold;">SULIT</label><br>';

        $view_borang = \View::make('pdf_suratlanjutancontent', $datapdfSHDKasa);
        $html_borang = $view_borang->render();

        $pdf::SetMargins(10, 20, 15, true); //left bottom right
        $pdf::AddPage('L');
        $pdf::writeHTML($html_borang, true, false, true, false, '');

        $pdf::setFooterCallback(
            function ( $pdf) use ( $view_borang, $sulit) {

                $pdf->writeHTMLCell(0, 0, 10, 8, $sulit); //width height x y

            }
        );

        try {
            mkdir(base_path('/storage/app/public/dokumenKASA'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $path = storage_path().'/app/public/dokumenKASA/'. $filename;
        $pdf::Output($path, 'F');


        return response()->json(['status' => 'Done']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function senaraiPetenderBerjayaPublic()
    {
        return view('awas::SenaraiPetenderBerjayaPublic');
    }


}
