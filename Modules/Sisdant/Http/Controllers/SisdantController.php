<?php

namespace Modules\Sisdant\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sisdant\Models\JenisIklan;
use Modules\Sisdant\Models\KategoriPerolehan;
use Modules\Sisdant\Models\MatrikIklan;
use Modules\Sisdant\Models\JenisTender;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Sisdant\Models\PermohonanNomborPerolehanDraf;
use App\Models\Pejabat;
use App\Models\ModelHasRoles;
use Modules\Sisdant\Models\RunningNoPerolehan;
use Carbon\Carbon;
use Modules\Sisdant\Models\Bidang;
use Modules\Sisdant\Models\SubBidang;
use Modules\Sisdant\Models\Kelas;
use Modules\Sisdant\Models\Pengkhususan;
use Modules\Sisdant\Models\CaraBayar;
use App\Models\SenaraiAlamat;
use Modules\Sisdant\Models\BayarKepada;
use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Sisdant\Models\BidangSubbidang;
use Modules\Sisdant\Models\KelasPengkhususan;
use Modules\Tunas\Models\TemplatBorangDaftar;
use App\Models\Negeri;
use App\Domains\Auth\Models\User;
use Modules\Sisdant\Emails\MailPermohonan;
use Modules\Sisdant\Emails\MailMaklumanPermohonan;
use Modules\Sisdant\Emails\MailPermohonanBatal;
use Modules\Sisdant\Emails\MailPermohonanSah;
use Modules\Sisdant\Emails\MailMaklumKemaskiniPermohonanSah;
use Modules\Sisdant\Emails\MailKemasPermohonanSah;
use Modules\Sisdant\Emails\MailUpdateEP;
use Illuminate\Support\Facades\Mail;
use Modules\Sisdant\Models\Grade;
use Modules\Sisdant\Models\SubKelasPukonsa;
use Modules\Sisdant\Models\KelasPukonsa;
use Modules\Sisdant\Models\SubKelasUpkj;
use Modules\Sisdant\Models\KelasUpkj;
use Modules\Sisdant\Models\IklanKelasUpkj;
use Modules\Sisdant\Models\IklanKelasPukonsa;
use Modules\Tunas\Models\Tender;
use Modules\Sisdant\Models\KategoriIklan;


class SisdantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "12"){
                $type = "PELAKSANA";
            } else if ($checkrole[$i]->role_id  == "3") {
                $type = "PENGESAH NOMBOR PEROLEHAN";
            }
        }
        return view('sisdant::index', compact( 'user'));
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

        return view('sisdant::profile', compact('listnegeri', 'listpejabat', 'user'));
    }

    public function indexPengesah()
    {
        return view('sisdant::indexPengesah');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sisdant::create');
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
        return view('sisdant::show');
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

/**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function permohonanbaru()
    {
        $jenisiklan = jenisiklan::get();
        $kategoriIklan = KategoriIklan::get();

        return view('sisdant::permohonanbaru', compact('jenisiklan','kategoriIklan'));
    }

    public function getKategoriPerolehan($id)
    {
        $kategoriperolehan= MatrikIklan::select('kategori_perolehan_id')->where('jenis_iklan_id',$id)->distinct()->get();
        $perolehan = kategoriperolehan::whereIn('id', $kategoriperolehan)->get();

        return response()->json([$perolehan]);
    }

    public function getKategoriTender(Request $request)
    {
        $perolehan = $request->jenisperolehan;
        $iklan = $request->jenisiklan;
        $kategoritender= MatrikIklan::select('jenis_tender_id')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->get();
        $upload_iklan= MatrikIklan::select('upload_iklan')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->get();
        $tender = JenisTender::whereIn('id', $kategoritender)->get();

        return response()->json([$tender, $upload_iklan]);
    }

    public function getJenisTender(Request $request)
    {
        $perolehan = $request->jenisperolehan;
        $iklan = $request->jenisiklan;
        $tender = $request->jenistender;
        $check= MatrikIklan::select('upload_iklan')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->where('jenis_tender_id',$tender)->get();

        return response()->json([$check]);
    }

    public function savePermohonanNombor(Request $request)
    {
        $user = auth()->user();
        $iklan = $request->jenis_iklan;
        $tahun = $request->tahun;
        $perolehan = $request->perolehan;
        $tender = $request->tender;
        $tarikh_iklan = $request->tarikh_iklan;
        $tajuk = $request->tajuk;
        $status = $request->status;
        $kategori_iklan = $request->kat_iklan;
        $file_upload = $request->file('file_upload');
        $pathimg = $name = "";

        try {
            mkdir(base_path('/storage/app/public/permohonan'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        if($file_upload) {
            $name = $file_upload->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];

            $file_upload->move(storage_path().'/app/public/permohonan/', $name);

            $pathimg ='storage/permohonan/'.$name;
        }

        if( $tender){
            $kategoritender= MatrikIklan::select('id')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->where('jenis_tender_id', $tender)->get();
        }
        else {
            $kategoritender= MatrikIklan::select('id')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->get();
        }

        if($status == "hantar") {
            $data=array('matrik_iklan_id' => $kategoritender[0]->id, 'tahun_perolehan'=> $tahun,'tajuk_perolehan'=>$tajuk,'tarikh_jangka_iklan'=>$tarikh_iklan,'dokumen_muatnaik'=>$pathimg, 'user_id'=>$user->id, "status"=>"belum sah", "section_id"=> $user->section_id, "negeri_id"=> $user->negeri_id, "nama_dokumen"=> $name, "kategori_iklan_id"=>$kategori_iklan);

            $mohon = new PermohonanNomborPerolehan();
            $mohon->fill($data);
            $mohon->save();
            $msg = "Permohonan Berjaya Dihantar";

            $to_email = $user->email;
            Mail::to($to_email)->send(new MailPermohonan());

            // email kepada semua pengesah
            $getPengesah =  User::join(
                'model_has_roles',
                'users.id','=','model_has_roles.model_id'
            )->where('model_has_roles.role_id', 3)->get();
            for ($sah = 0; $sah < count($getPengesah); $sah++){

                $to_emel = $getPengesah[$sah]->email;
                $url = "/sisdant";

                Mail::to($to_emel)->send(new MailMaklumanPermohonan($url));

            }

        } else {
            $data=array('matrik_iklan_id' => $kategoritender[0]->id, 'tahun_perolehan'=> $tahun,'tajuk_perolehan'=>$tajuk,'tarikh_jangka_iklan'=>$tarikh_iklan,'dokumen_muatnaik'=>$pathimg, 'user_id'=>$user->id, "status"=>"draf", "section_id"=> $user->section_id, "negeri_id"=> $user->negeri_id, "nama_dokumen"=> $name,"kategori_iklan_id"=>$kategori_iklan);
            $mohon = new PermohonanNomborPerolehanDraf();
            $mohon->fill($data);
            $mohon->save();
            $msg = "Permohonan Berjaya Disimpan";
        }



        return redirect('/sisdant')->with('status', $msg);
    }

    public function deletePermohonan($id)
    {
        $user = auth()->user();
        //delete file lama
        $data = PermohonanNomborPerolehan::where('id_perolehan', $id)->first();
        if($data->nama_dokumen) {
            unlink(storage_path().'/app/public/permohonan/'.$data->nama_dokumen);
        }

        PermohonanNomborPerolehan::where('id_perolehan', $id)->delete();

        $msg = "Permohonan Berjaya Dipadam";

        return redirect('/sisdant')->with('status', $msg);

    }

    public function deletePermohonanDraf($id)
    {
        $user = auth()->user();

        $data = PermohonanNomborPerolehanDraf::where('id_perolehan', $id)->first();
        if($data->nama_dokumen) {
            unlink(storage_path().'/app/public/permohonan/'.$data->nama_dokumen);
        }
        PermohonanNomborPerolehanDraf::where('id_perolehan', $id)->delete();

        $msg = "Draf Permohonan Berjaya Dipadam";

        return redirect('/sisdant')->with('status', $msg);

    }

    public function editPermohonanDraf($id)
    {
        $user = auth()->user();
        $pejabat = Pejabat::where('id',$user->section_id)->first();
        $data = PermohonanNomborPerolehanDraf::where('draf_mohon_no_perolehan.id_perolehan',$id)
                            ->join(
                                'matrik_iklan',
                                'matrik_iklan.id','=','draf_mohon_no_perolehan.matrik_iklan_id'
                            )
                            ->first();
        $jenisiklan = jenisiklan::get();
        $kategoriperolehan= MatrikIklan::select('kategori_perolehan_id')->where('jenis_iklan_id',$data->jenis_iklan_id)->distinct()->get();
        $perolehan = kategoriperolehan::whereIn('id', $kategoriperolehan)->get();

        if($data->jenis_tender_id) {
            $kategoritender= MatrikIklan::select('jenis_tender_id')->where('jenis_iklan_id',$data->jenis_iklan_id)->where('kategori_perolehan_id',$data->kategori_perolehan_id)->get();
            $tender = JenisTender::whereIn('id', $kategoritender)->get();

            return view('sisdant::editPermohonanDrafwithTender', compact('data', 'jenisiklan', 'perolehan', 'tender'));
        } else {
            return view('sisdant::editPermohonanDraf', compact('data', 'jenisiklan', 'perolehan'));

        }

    }

    public function savePermohonanNomborDraf(Request $request)
    {
        $user = auth()->user();
        $iklan = $request->jenis_iklan;
        $tahun = $request->tahun;
        $perolehan = $request->perolehan;
        $tender = $request->tender;
        $tarikh_iklan = $request->tarikh_iklan;
        $tajuk = $request->tajuk;
        $status = $request->status;
        $file_upload = $request->file('file_upload');
        $pathimg = $name = "";
        $id = $request->id_perolehan;
        $kat_iklan = $request->kat_iklan;
        if($file_upload) {
            $name = $file_upload->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $file_upload->move(storage_path().'/app/public/permohonan/', $name);
            $pathimg ='storage/permohonan/'.$name;
        } else {
            $draf = PermohonanNomborPerolehanDraf::where('id_perolehan', $id)->first();
            $name = $draf -> nama_dokumen;
            $pathimg = $draf -> dokumen_muatnaik;
        }

        if( $tender){
            $kategoritender= MatrikIklan::select('id')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->where('jenis_tender_id', $tender)->get();
        }
        else {
            $kategoritender= MatrikIklan::select('id')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->get();
        }


        if($status == "hantar") {
            $data=array('matrik_iklan_id' => $kategoritender[0]->id, 'tahun_perolehan'=> $tahun,'tajuk_perolehan'=>$tajuk,'tarikh_jangka_iklan'=>$tarikh_iklan,'dokumen_muatnaik'=>$pathimg, 'user_id'=>$user->id, "status"=>"belum sah", "section_id"=>$user->section_id, "negeri_id"=> $user->negeri_id,"nama_dokumen"=> $name, "kategori_iklan_id"=> $kat_iklan);
            PermohonanNomborPerolehanDraf::where('id_perolehan', $id)->delete();
            $mohon = new PermohonanNomborPerolehan();
            $mohon->fill($data);
            $mohon->save();
            $msg = "Permohonan Berjaya Dihantar";

            // email kepada semua pengesah
            $getPengesah =  User::join(
                    'model_has_roles',
                    'users.id','=','model_has_roles.model_id'
                )->where('model_has_roles.role_id', 3)->get();
            for ($sah = 0; $sah < count($getPengesah); $sah++){
                $to_emel = $getPengesah[$sah]->email;
                $url = "/sisdant";
                Mail::to($to_emel)->send(new MailMaklumanPermohonan($url));
            }
        } else {
            $data=array('matrik_iklan_id' => $kategoritender[0]->id, 'tahun_perolehan'=> $tahun,'tajuk_perolehan'=>$tajuk,'tarikh_jangka_iklan'=>$tarikh_iklan,'dokumen_muatnaik'=>$pathimg, 'user_id'=>$user->id, "status"=>"draf", "section_id"=>$user->section_id, "negeri_id"=> $user->negeri_id,"nama_dokumen"=> $name, "kategori_iklan_id"=> $kat_iklan);
            PermohonanNomborPerolehanDraf::where('id_perolehan', $id) -> update($data);
            $msg = "Permohonan Berjaya Disimpan";
        }



        return redirect('/sisdant')->with('status', $msg);
    }

    public function viewPermohonan($id)
    {
        $user = auth()->user();
        $data = PermohonanNomborPerolehan::with('kategoriIklan')->where('mohon_no_perolehan.id_perolehan',$id)
        ->join(
            'matrik_iklan',
            'matrik_iklan.id','=','mohon_no_perolehan.matrik_iklan_id'
        )
        ->first();
        $dataKategoriIklan = KategoriIklan::all();
        $jenisiklan = jenisiklan::get();


        $kategoriperolehan= MatrikIklan::select('kategori_perolehan_id')->where('jenis_iklan_id',$data->jenis_iklan_id)->distinct()->get();
        $perolehan = kategoriperolehan::whereIn('id', $kategoriperolehan)->get();

        $getperolehan = MatrikIklan::where('id', $data->matrik_iklan_id)->first();
        $negeri_code = Negeri::select('singkatan')->where('id', $data->negeri_id)->first();
        // check running no
        if($data->section_id) { // kalau ibu pejabat
            $section_code = Pejabat::select('singkatan')->where('id', $data->section_id)->first();
            if( $getperolehan->kategori_perolehan_id == '5'){
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$data->jenis_iklan_id)
                                            ->where('kategori_perolehan_id',$data->kategori_perolehan_id)
                                            ->where('negeri_id',$data->negeri_id)
                                            ->where('bahagian_id',$data->section_id)
                                            ->where('year',$data->tahun_perolehan)
                                            ->first();
            }else {
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$data->jenis_iklan_id)
                                            ->whereNull('kategori_perolehan_id')
                                            ->where('negeri_id',$data->negeri_id)
                                            ->where('bahagian_id',$data->section_id)
                                            ->where('year',$data->tahun_perolehan)
                                            ->first();
            }
        } else { // kalau negeri
            if( $getperolehan->kategori_perolehan_id == '5'){
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$data->jenis_iklan_id)
                                            ->where('kategori_perolehan_id',$data->kategori_perolehan_id)
                                            ->where('negeri_id',$data->negeri_id)
                                            ->where('year',$data->tahun_perolehan)
                                            ->first();
            }else {
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$data->jenis_iklan_id)
                                            ->whereNull('kategori_perolehan_id')
                                            ->where('negeri_id',$data->negeri_id)
                                            ->where('year',$data->tahun_perolehan)
                                            ->first();
            }
        }

        if(!$runno){ // if nombor perolehan not exist in table or searching based on above - create new data based ontahun perolehan
            if($data->section_id) { // kalau ibu pejabat
                if( $data->jenis_iklan_id == '1'){ // jenis iklan sebut harga
                    if( $getperolehan->kategori_perolehan_id == '5'){ //kategori perolehan 5 perkhidmatan perunding
                        $code ="JPS/".$negeri_code->singkatan."/SH/C/".$section_code->singkatan."/";
                        $dt=array('jenis_iklan_id' =>$data->jenis_iklan_id, 'kategori_perolehan_id'=> $data->kategori_perolehan_id,'negeri_id'=>$data->negeri_id,'bahagian_id'=>$data->section_id,'year'=>$data->tahun_perolehan, 'running_no' => 0, 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }else {
                        $code ="JPS/".$negeri_code->singkatan."/SH/".$section_code->singkatan."/";
                        $dt=array('jenis_iklan_id' =>$data->jenis_iklan_id, 'negeri_id'=>$data->negeri_id,'bahagian_id'=>$data->section_id,'year'=>$data->tahun_perolehan, 'running_no' => 0, 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }
                } else {
                    if( $getperolehan->kategori_perolehan_id == '5'){ //kategori perolehan 5 perkhidmatan perunding
                        $code ="JPS/".$negeri_code->singkatan."/C/".$section_code->singkatan."/";
                        $dt=array('jenis_iklan_id' =>$data->jenis_iklan_id, 'kategori_perolehan_id'=> $data->kategori_perolehan_id,'negeri_id'=>$data->negeri_id,'bahagian_id'=>$data->section_id,'year'=>$data->tahun_perolehan, 'running_no' => 0, 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }else {
                        $code ="JPS/".$negeri_code->singkatan."/".$section_code->singkatan."/";
                        $dt=array('jenis_iklan_id' =>$data->jenis_iklan_id, 'negeri_id'=>$data->negeri_id,'bahagian_id'=>$data->section_id,'year'=>$data->tahun_perolehan, 'running_no' => 0, 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();

                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }
                }

            } else { // kalau negeri
                if( $data->jenis_iklan_id == '1'){ // jenis iklan sebut harga
                    if( $getperolehan->kategori_perolehan_id == '5'){ //kategori perolehan 5 perkhidmatan perunding
                        $code ="JPS/".$negeri_code->singkatan."/SH/C/";
                        $dt=array('jenis_iklan_id' =>$data->jenis_iklan_id, 'kategori_perolehan_id'=> $data->kategori_perolehan_id,'negeri_id'=>$data->negeri_id,'year'=>$data->tahun_perolehan, 'running_no' => "0", 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }else {
                        $code ="JPS/".$negeri_code->singkatan."/SH"."/";
                        $dt=array('jenis_iklan_id' =>$data->jenis_iklan_id,'negeri_id'=>$data->negeri_id,'year'=>$data->tahun_perolehan, 'running_no' => "0", 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }
                } else {
                    if( $getperolehan->kategori_perolehan_id == '5'){ //kategori perolehan 5 perkhidmatan perunding
                        $code ="JPS/".$negeri_code->singkatan."/C"."/";
                        $dt=array('jenis_iklan_id' =>$data->jenis_iklan_id, 'kategori_perolehan_id'=> $data->kategori_perolehan_id,'negeri_id'=>$data->negeri_id,'year'=>$data->tahun_perolehan, 'running_no' => "0", 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }else {
                        $code ="JPS/".$negeri_code->singkatan."/";
                        $dt=array('jenis_iklan_id' =>$data->jenis_iklan_id, 'negeri_id'=>$data->negeri_id,'year'=>$data->tahun_perolehan, 'running_no' => "0", 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }
                }
            }
        }


        if($data->jenis_tender_id) {
            $kategoritender= MatrikIklan::select('jenis_tender_id')->where('jenis_iklan_id',$data->jenis_iklan_id)->where('kategori_perolehan_id',$data->kategori_perolehan_id)->get();
            $tender = JenisTender::whereIn('id', $kategoritender)->get();

            return view('sisdant::sahPermohonanwithTender', compact('data', 'jenisiklan', 'perolehan', 'tender', 'dataKategoriIklan'));
        } else {

            return view('sisdant::sahPermohonan', compact('data', 'jenisiklan', 'perolehan', 'dataKategoriIklan'));
        }
    }

    public function sahPermohonan(Request $request)
    {
        $data = PermohonanNomborPerolehan::where('id_perolehan',$request->id_perolehan)
                                ->join(
                                    'users',
                                    'users.id','=','mohon_no_perolehan.user_id'
                                )
                                ->first();

        $iklan = $request->jenis_iklan;
        $tahun = $request->tahun;
        $perolehan = $request->perolehan;
        $tender = $request->tender;
        $file_upload = $request->file('file_upload');

        if( $tender){
            $kategoritender= MatrikIklan::select('id')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->where('jenis_tender_id', $tender)->first();
        }
        else {
            $kategoritender= MatrikIklan::select('id')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->first();
        }

        if ($request->status == "hantar"){

            PermohonanNomborPerolehan::where('id_perolehan',$request->id_perolehan)->update([
                'status'=> 'sah',
                'no_perolehan'=> $request->noperolehan,
                'tahun_perolehan'=> $request->tahun,
                'tajuk_perolehan'=>$request->tajuk,
                'tarikh_jangka_iklan'=>$request->tarikh_iklan,
                'matrik_iklan_id' => $kategoritender->id,
                'kategori_iklan_id' => $request->kategori_iklan
            ]);

            if($file_upload) {
                $name = $file_upload->getClientOriginalName();
                $tarikh_file = Carbon::now()->format('ymd_His');
                $explode_name = explode('.', $name);

                $nama_fail = '';
                for ($i=0; $i < count($explode_name)-1; $i++) {
                    $nama_fail .= $explode_name[$i];
                }

                $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
                $file_upload->move(storage_path().'/app/public/permohonan/', $name);
                $pathimg ='storage/permohonan/'.$name;

                PermohonanNomborPerolehan::where('id_perolehan',$request->id_perolehan)->update([
                    'dokumen_muatnaik'=>$pathimg,
                    'nama_dokumen'=> $name
                ]);
            }

            $updat_runnumber = RunningNoPerolehan::where('id',$request->id_running_no)->first();
            $run_no = $updat_runnumber->running_no+1;

            RunningNoPerolehan::where('id',$request->id_running_no)->update([
                'running_no'=> $run_no,
            ]);

            $data_per = PermohonanNomborPerolehan::where('id_perolehan',$request->id_perolehan)->first();
            // email
            $to_name = $data->name;
            $to_email = $data->email;
            $data = array('no_perolehan' => $data_per->no_perolehan);
            Mail::to($to_email)->send(new MailPermohonanSah($data));

            $msg = "Permohonan Berjaya Disahkan";

        } else {

            $file_upload = $request->file('dokumen');
            $pathimg = "";
            if($file_upload) {
                $name = $file_upload->getClientOriginalName();
                $tarikh_file = Carbon::now()->format('ymd_His');
                $explode_name = explode('.', $name);

                $nama_fail = '';
                for ($i=0; $i < count($explode_name)-1; $i++) {
                    $nama_fail .= $explode_name[$i];
                }

                $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
                $file_upload->move(storage_path().'/app/public/batalpermohonan/', $name);
                $pathimg ='storage/batalpermohonan/'.$name;
            }

            PermohonanNomborPerolehan::where('id_perolehan',$request->id_perolehan)->update([
                'status'=> 'batal',
                'justifikasi_batal' => $request->justifikasi,
                'dokumen_batal' => $pathimg,
            ]);

            // email
            $to_name = $data->name;
            $to_email = $data->email;
            Mail::to($to_email)->send(new MailPermohonanBatal());

            $msg = "Permohonan Berjaya Dibatalkan";

        }

        return redirect('/sisdant/pengesah')->with('status', $msg);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function senaraiPerolehan()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "3") {
                $type = "PENGESAH NOMBOR PEROLEHAN";
            }
        }
        if( $type == "PENGESAH NOMBOR PEROLEHAN") {
            return view('sisdant::senaraiNomborPerolehan');
        } else {
            return redirect('/dashboard');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $user = auth()->user();
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "12"){
                $type = "PELAKSANA";
            }
        }
        if(!$type == "PELAKSANA") {
            return redirect('/dashboard');
        }
        $data = PermohonanNomborPerolehan::where('mohon_no_perolehan.id_perolehan', $id)->first();
        $negeri = Negeri::select('singkatan')->where('id', $data->negeri_id)->first();
        $negeri = $negeri->singkatan;
        $matrik_iklan = MatrikIklan::where('id', $data->matrik_iklan_id)->first();
        $jenisiklan = JenisIklan::where('id', $matrik_iklan->jenis_iklan_id)->first();
        $perolehan = KategoriPerolehan::where('id', $matrik_iklan->kategori_perolehan_id)->first();
        $nama_perolehan = $perolehan->nama;
        $tender = JenisTender::where('id', $matrik_iklan->jenis_tender_id)->first();
        $bidang = Bidang::all();
        $tablebidang = Bidang::all();
        $kelas = Kelas::get();
        $tablekelas = Kelas::get();
        $iklan = jenisiklan::get();
        $cara_bayar = CaraBayar::where('id', '!=', 5)->get();
        $senaraialamat = SenaraiAlamat::get();
        $bayar_kepada = BayarKepada::where('id', '!=', 4)->get();
        $grade = Grade::get();
        $tablepukonsa = KelasPukonsa::get();
        $kelaspukonsa = KelasPukonsa::get();
        $subkelaspukonsa = SubKelasPukonsa::get();
        $tableupkj = KelasUpkj::get();
        $kelasupkj = KelasUpkj::get();
        $subkelasupkj = SubKelasUpkj::get();

        return view('sisdant::editPermohonanSah', compact('data', 'jenisiklan', 'perolehan', 'tender', 'bidang', 'tablebidang', 'kelas', 'tablekelas', 'iklan', 'cara_bayar', 'senaraialamat', 'bayar_kepada', 'grade', 'kelaspukonsa', 'subkelaspukonsa', 'tablepukonsa', 'kelasupkj', 'subkelasupkj', 'tableupkj', 'negeri', 'nama_perolehan'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function viewPermohonanBelumSah($id)
    {
        $data = PermohonanNomborPerolehan::with('kategoriIklan')->where('mohon_no_perolehan.id_perolehan', $id)->first();
        $matrik_iklan = MatrikIklan::where('id', $data->matrik_iklan_id)->first();
        $jenisiklan = JenisIklan::where('id', $matrik_iklan->jenis_iklan_id)->first();
        $perolehan = KategoriPerolehan::where('id', $matrik_iklan->kategori_perolehan_id)->first();
        $tender = JenisTender::where('id', $matrik_iklan->jenis_tender_id)->first();
        $kategoriIklan = KategoriIklan::all();

        return view('sisdant::editPermohonanBelumSah', compact('data', 'jenisiklan', 'perolehan', 'tender', 'kategoriIklan'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function viewPermohonanStatusBatal($id)
    {
        $data = PermohonanNomborPerolehan::with('kategoriIklan')->where('mohon_no_perolehan.id_perolehan', $id)->first();
        $matrik_iklan = MatrikIklan::where('id', $data->matrik_iklan_id)->first();
        $jenisiklan = JenisIklan::where('id', $matrik_iklan->jenis_iklan_id)->first();
        $perolehan = KategoriPerolehan::where('id', $matrik_iklan->kategori_perolehan_id)->first();
        $tender = JenisTender::where('id', $matrik_iklan->jenis_tender_id)->first();
        $dataKategoriIklan  = KategoriIklan::get();

        return view('sisdant::viewPermohonanBatal', compact('data', 'jenisiklan', 'perolehan', 'tender', 'dataKategoriIklan'));

    }

    public function deletefile($id){
        $data = array('dokumen_muatnaik'=>'');
        PermohonanNomborPerolehan::where('id_perolehan', $id) -> update($data);
    }

    public function deletefileDraf($id){
        $data = array('dokumen_muatnaik'=>'');
        PermohonanNomborPerolehanDraf::where('id_perolehan', $id) -> update($data);
    }

    public function getSubBidang($id)
    {
        $subbidang = SubBidang::where('bidang_id',$id)->get();

        return response()->json([$subbidang]);
    }

    public function getkhusus($id)
    {
        $khusus = Pengkhususan::where('kelas_id',$id)->get();

        return response()->json([$khusus]);
    }

    //kemaskini atau simpan permohonan selepas disahkan
    public function updatePermohonanSah(Request $request)
    {

        $dataperolehan = PermohonanNomborPerolehan::where('id_perolehan', $request->id_perolehan)->first();
        $negeri = Negeri::select('singkatan')->where('id', $dataperolehan->negeri_id)->first();
        $negeri = $negeri->singkatan;
        $fileIklan = $request->file('upload'); //get dokumen iklan
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
            PermohonanNomborPerolehan::where('id_perolehan', $request->id_perolehan)->update([
                'dokumen_muatnaik' =>$pathing,
                'nama_dokumen' => $name,
            ]);
        }

        PermohonanNomborPerolehan::where('id_perolehan',$request->id_perolehan)->update(['tajuk_perolehan'=>$request->tajuk]);

        if ($request->cara_bayar == 1){
            $harga = 0;
            $bayar_kepada = 4;
        } else {
            $harga = $request->harga;
            $bayar_kepada = $request->bayar_kepada;
        }

        if($request->status == "hantar") {
            if ($request->kategori_iklan_id != 1) { // portal
                $dataIklanPerolehan = array(
                    'user_id' => auth()->user()->id,
                    'mohon_no_perolehan_id' => $request->id_perolehan,
                    'tarikh_mula_jual' => $request->tarikh_mula_jual,
                    'tarikh_akhir_jual' => $request->tarikh_akhir_jual,
                    'pejabat_pamer_jual' => $request->pejabat_pamer,
                    'tarikh_lawatan_tapak' => $request->tarikh_lawatan,
                    'lawatan_tapak' => $request->lawatan_tapak,
                    'pejabat_lapor' => $request->pejabat_lapor,
                    'waktu_lapor' => $request->waktu_lapor,
                    'harga_dokumen' => $harga,
                    'cara_bayaran_id' => $request->cara_bayar,
                    'bayar_kepada_id' => $bayar_kepada,
                    'lokasi_tapak' => $request->lokasi,
                    'tarikh_keluar_iklan' => $dataperolehan->tarikh_jangka_iklan,
                    'tarikh_waktu_tutup' => $request->tarikh_akhir_jual,
                    'tarikh_tutup_list' => Carbon::parse($request->tarikh_akhir_jual)->addMonths(3)->format('Y-m-d'),
                    'grade_id' => $request->gred,
                    'status_iklan_id' => 2,
                    'tarikh_taklimat_tender' => $request->tarikh_taklimat_tender,
                    'taklimat_tender' => $request->taklimat_tender,
                );

                PermohonanNomborPerolehan::where('id_perolehan', $request->id_perolehan) -> update(['status' => "iklan"]);

            } else { //ePerolehan
                $dataIklanPerolehan = array(
                    'user_id' => auth()->user()->id,
                    'mohon_no_perolehan_id' => $request->id_perolehan,
                    'tarikh_mula_jual' => $request->tarikh_mula_jual,
                    'tarikh_akhir_jual' => $request->tarikh_akhir_jual,
                    'pejabat_pamer_jual' => $request->pejabat_pamer,
                    'tarikh_lawatan_tapak' => $request->tarikh_lawatan,
                    'lawatan_tapak' => $request->lawatan_tapak,
                    'pejabat_lapor' => $request->pejabat_lapor,
                    'waktu_lapor' => $request->waktu_lapor,
                    'harga_dokumen' => $harga,
                    'cara_bayaran_id' => 5,
                    'bayar_kepada_id' => 4,
                    'lokasi_tapak' => $request->lokasi,
                    'tarikh_keluar_iklan' => $dataperolehan->tarikh_jangka_iklan,
                    'tarikh_waktu_tutup' => $request->tarikh_akhir_jual,
                    'tarikh_tutup_list' => Carbon::parse($request->tarikh_akhir_jual)->addMonths(3)->format('Y-m-d'),
                    'grade_id' => $request->gred,
                    'status_iklan_id' => 7,
                    'tarikh_taklimat_tender' => $request->tarikh_taklimat_tender,
                    'taklimat_tender' => $request->taklimat_tender,
                );
                PermohonanNomborPerolehan::where('id_perolehan', $request->id_perolehan) -> update(['status' => "selesai"]);
            }

        } else {
            // dd($dataperolehan->tarikh_jangka_iklan);
            if ($request->kategori_iklan_id != 1) { // portal
                $dataIklanPerolehan = array(
                    'user_id' => auth()->user()->id,
                    'mohon_no_perolehan_id' => $request->id_perolehan,
                    'tarikh_mula_jual' => $request->tarikh_mula_jual,
                    'tarikh_akhir_jual' => $request->tarikh_akhir_jual,
                    'pejabat_pamer_jual' => $request->pejabat_pamer,
                    'tarikh_lawatan_tapak' => $request->tarikh_lawatan,
                    'lawatan_tapak' => $request->lawatan_tapak,
                    'pejabat_lapor' => $request->pejabat_lapor,
                    'waktu_lapor' => $request->waktu_lapor,
                    'harga_dokumen' => $harga,
                    'cara_bayaran_id' => $request->cara_bayar,
                    'bayar_kepada_id' => $bayar_kepada,
                    'lokasi_tapak' => $request->lokasi,
                    'tarikh_keluar_iklan' => $dataperolehan->tarikh_jangka_iklan,
                    'tarikh_waktu_tutup' => $dataperolehan->tarikh_jangka_iklan,
                    'tarikh_tutup_list' => Carbon::parse($dataperolehan->tarikh_jangka_iklan)->addMonths(3)->format('Y-m-d'),
                    'grade_id' => $request->gred,
                    'status_iklan_id' => 1,
                    'tarikh_taklimat_tender' => $request->tarikh_taklimat_tender,
                    'taklimat_tender' => $request->taklimat_tender,
                );

            } else { // ePerolehan
                $dataIklanPerolehan = array(
                    'user_id' => auth()->user()->id,
                    'mohon_no_perolehan_id' => $request->id_perolehan,
                    'tarikh_mula_jual' => $request->tarikh_mula_jual,
                    'tarikh_akhir_jual' => $request->tarikh_akhir_jual,
                    'pejabat_pamer_jual' => $request->pejabat_pamer,
                    'tarikh_lawatan_tapak' => $request->tarikh_lawatan,
                    'lawatan_tapak' => $request->lawatan_tapak,
                    'pejabat_lapor' => $request->pejabat_lapor,
                    'waktu_lapor' => $request->waktu_lapor,
                    'harga_dokumen' => $harga,
                    'cara_bayaran_id' => 5,
                    'bayar_kepada_id' => 4,
                    'lokasi_tapak' => $request->lokasi,
                    'tarikh_keluar_iklan' => $dataperolehan->tarikh_jangka_iklan,
                    'tarikh_waktu_tutup' => $dataperolehan->tarikh_jangka_iklan,
                    'tarikh_tutup_list' => Carbon::parse($dataperolehan->tarikh_jangka_iklan)->addMonths(3)->format('Y-m-d'),
                    'grade_id' => $request->gred,
                    'status_iklan_id' => 1,
                    'tarikh_taklimat_tender' => $request->tarikh_taklimat_tender,
                    'taklimat_tender' => $request->taklimat_tender,
                );

            }
            PermohonanNomborPerolehan::where('id_perolehan', $request->id_perolehan) -> update(['status' => "draf-iklan"]);

        }

        $iklan_perolehan = new IklanPerolehan();
        $iklan_perolehan->fill($dataIklanPerolehan);
        $iklan_perolehan->save();

        // BidangSubbidang
        for ($counter = 0; $counter < ((int)$request->counterbidang + 1); $counter++){
            $bidang = "bidang". $counter;
            $subbidang = "subbidang". $counter;

            //loop subbidang
            for ($sub = 0; $sub < count((array)$request->$subbidang); $sub++) {

                $data_sub = array(
                    'iklan_perolehan_id' => $iklan_perolehan->id,
                    'bidang_id' => $request->$bidang,
                    'sub_bidang_id' => $request->$subbidang[$sub],
                );

                //save bidang subbidang
                $create_bidang_sub = new BidangSubbidang();
                $create_bidang_sub->fill($data_sub);
                $create_bidang_sub->save();
            }
        }
        // Kelas + Pengkhususan
        for ($kira = 0; $kira < ((int)$request->counterkelas + 1); $kira++){
            $kelas = "kelas". $kira;
            $khusus = "khusus". $kira;

            // loop khusus
            for ($sub_khusus = 0; $sub_khusus < count((array)$request->$khusus); $sub_khusus++) {

                $data_khusus = array(
                    'iklan_perolehan_id' => $iklan_perolehan->id,
                    'kelas_id' => $request->$kelas,
                    'pengkhususan_id' => $request->$khusus[$sub_khusus],
                );

                $create_kelas_khusus = new KelasPengkhususan();
                $create_kelas_khusus->fill($data_khusus);
                $create_kelas_khusus->save();
            }
        }

        // pukonsa
        if (($negeri == 'IP' && $request->syarat == 'pukonsa') || $negeri != 'IP') {
            for ($kira = 0; $kira < ((int)$request->counterPukonsa + 1); $kira++){
                $tajuk = "tajukpukonsa". $kira;
                $sub_tajuk = "subtajuk". $kira;

                // loop khusus
                for ($i = 0; $i < count((array)$request->$sub_tajuk); $i++) {

                    $data = array(
                        'iklan_perolehan_id' => $iklan_perolehan->id,
                        'tajuk_id' => $request->$tajuk,
                        'tajukkecil_id' => $request->$sub_tajuk[$i],
                    );

                    $create_kelas_pukonsa = new IklanKelasPukonsa();
                    $create_kelas_pukonsa->fill($data);
                    $create_kelas_pukonsa->save();
                }
            }
        }

        // upkj
        if (($negeri == 'IP' && $request->syarat == 'upkj') || $negeri != 'IP') {
            for ($kira = 0; $kira < ((int)$request->counterUpkj + 1); $kira++){
                $tajuk = "tajukupkj". $kira;
                $sub_tajuk = "subtajukupkj". $kira;

                // loop khusus
                for ($i = 0; $i < count((array)$request->$sub_tajuk); $i++) {

                    $data = array(
                        'iklan_perolehan_id' => $iklan_perolehan->id,
                        'tajuk_id' => $request->$tajuk,
                        'tajukkecil_id' => $request->$sub_tajuk[$i],
                    );

                    $create_kelas_upkj = new IklanKelasUpkj();
                    $create_kelas_upkj->fill($data);
                    $create_kelas_upkj->save();
                }
            }
        }

        if($request->status == "hantar") {

            if ($request->kategori_iklan_id != 1) { //portal
                // email PELAKSANA
                $to_email = auth()->user()->email;
                $data = array('no_perolehan' => $dataperolehan->no_perolehan);
                Mail::to($to_email)->send(new MailKemasPermohonanSah($data));

                // email kepada Pentadbir
                $getPengesah =  User::join(
                    'model_has_roles',
                    'users.id','=','model_has_roles.model_id'
                )->where('model_has_roles.role_id', 3)->get();
                for ($sah = 0; $sah < count($getPengesah); $sah++){

                    $to_emel = $getPengesah[$sah]->email;
                    $data = array('no_perolehan' => $dataperolehan->no_perolehan);
                    Mail::to($to_emel)->send(new MailMaklumKemaskiniPermohonanSah($data));

                }
            } else { //ePerolehan
                // email PELAKSANA
                $to_email = auth()->user()->email;
                $data = array('no_perolehan' => $dataperolehan->no_perolehan);
                Mail::to($to_email)->send(new MailUpdateEP($data));
            }
            $msg = "Permohonan Berjaya Dikemaskini";
        } else {
            $msg = "Permohonan Berjaya Disimpan";
        }
        return redirect('/sisdant')->with('status', $msg);
    }

    public function getKategoriTenderPerolehan(Request $request)
    {
        $perolehan = $request->jenisperolehan;
        $iklan = $request->jenisiklan;
        $kategoritender= MatrikIklan::select('jenis_tender_id')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->get();
        $upload_iklan= MatrikIklan::select('upload_iklan')->where('jenis_iklan_id',$iklan)->where('kategori_perolehan_id',$perolehan)->get();
        $tender = JenisTender::whereIn('id', $kategoritender)->get();
        $section = $request->section;
        $negeri = $request->negeri;
        $tahun_perolehan = $request->tahun;
        $negeri_code = Negeri::select('singkatan')->where('id', $negeri)->first();

        if($section) { // kalau ibu pejabat
            $section_code = Pejabat::select('singkatan')->where('id', $section)->first();
            if( $perolehan == '5'){
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$iklan)
                                            ->where('kategori_perolehan_id',$perolehan)
                                            ->where('negeri_id',$negeri)
                                            ->where('bahagian_id',$section)
                                            ->where('year',$tahun_perolehan)
                                            ->first();
            }else {
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$iklan)
                                                ->whereNull('kategori_perolehan_id')
                                                ->where('negeri_id',$negeri)
                                                ->where('bahagian_id',$section)
                                                ->where('year',$tahun_perolehan)
                                                ->first();
            }
        } else { // kalau negeri
            if( $perolehan== '5'){
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$iklan)
                                            ->where('kategori_perolehan_id',$perolehan)
                                            ->where('negeri_id',$negeri)
                                            ->where('year',$tahun_perolehan)
                                            ->first();
            }else {
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$iklan)
                                                ->whereNull('kategori_perolehan_id')
                                                ->where('negeri_id',$negeri)
                                                ->where('year',$tahun_perolehan)
                                                ->first();
            }
        }

        if(!$runno){ // if nombor perolehan not exist in table or searching based on above - create new data based ontahun perolehan
            if($section) { // kalau ibu pejabat
                if( $iklan == '1'){ // jenis iklan sebut harga
                    if( $perolehan == '5'){ //kategori perolehan 5 perkhidmatan perunding
                        $code ="JPS/".$negeri_code->singkatan."/SH/C/".$section_code->singkatan."/";
                        $dt=array('jenis_iklan_id' =>$iklan, 'kategori_perolehan_id'=> $perolehan,'negeri_id'=>$negeri,'bahagian_id'=>$section,'year'=>$tahun_perolehan, 'running_no' => 0, 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }else {
                        $code ="JPS/".$negeri_code->singkatan."/SH/".$section_code->singkatan."/";
                        $dt=array('jenis_iklan_id' =>$iklan, 'negeri_id'=>$negeri,'bahagian_id'=>$section,'year'=>$tahun_perolehan, 'running_no' => 0, 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }
                } else {
                    if( $perolehan == '5'){ //kategori perolehan 5 perkhidmatan perunding
                        $code ="JPS/".$negeri_code->singkatan."/C/".$section_code->singkatan."/";
                        $dt=array('jenis_iklan_id' =>$iklan, 'kategori_perolehan_id'=> $perolehan,'negeri_id'=>$negeri,'bahagian_id'=>$section,'year'=>$tahun_perolehan, 'running_no' => 0, 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }else {
                        $code ="JPS/".$negeri_code->singkatan."/".$section_code->singkatan."/";

                        $dt=array('jenis_iklan_id' =>$iklan, 'negeri_id'=>$negeri,'bahagian_id'=>$section,'year'=>$tahun_perolehan, 'running_no' => 0, 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();

                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }
                }

            } else { // kalau negeri
                if( $iklan == '1'){ // jenis iklan sebut harga
                    if( $perolehan == '5'){ //kategori perolehan 5 perkhidmatan perunding
                        $code ="JPS/".$negeri_code->singkatan."/SH/C/";
                        $dt=array('jenis_iklan_id' =>$iklan, 'kategori_perolehan_id'=> $perolehan,'negeri_id'=>$negeri,'year'=>$tahun_perolehan, 'running_no' => "0", 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }else {
                        $code ="JPS/".$negeri_code->singkatan."/SH"."/";
                        $dt=array('jenis_iklan_id' =>$iklan,'negeri_id'=>$negeri,'year'=>$tahun_perolehan, 'running_no' => "0", 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }
                } else {
                    if( $perolehan == '5'){ //kategori perolehan 5 perkhidmatan perunding
                        $code ="JPS/".$negeri_code->singkatan."/C"."/";
                        $dt=array('jenis_iklan_id' =>$iklan, 'kategori_perolehan_id'=> $perolehan,'negeri_id'=>$negeri,'year'=>$tahun_perolehan, 'running_no' => "0", 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }else {
                        $code ="JPS/".$negeri_code->singkatan."/";
                        $dt=array('jenis_iklan_id' =>$iklan, 'negeri_id'=>$negeri,'year'=>$tahun_perolehan, 'running_no' => "0", 'code'=>$code);
                        $rnp = new RunningNoPerolehan();
                        $rnp->fill($dt);
                        $rnp->save();


                        $runno = RunningNoPerolehan::where('id',$rnp->ll_id)->get();

                    }
                }
            }
        }

        $run_number = $runno->running_no + 1;
        $num_padded = sprintf("%02d", $run_number);

        $no_perolehan = $runno->code.$num_padded."/".$runno->year;
        $id_running_no = $runno->id;

        return response()->json([$tender, $upload_iklan, $no_perolehan, $id_running_no]);
    }

    public function getNoPerolehan(Request $request)
    {
        // check running no
        if($request->section_id) { // kalau ibu pejabat
            $section_code = Pejabat::select('singkatan')->where('id', $request->section_id)->first();
            if( $request->kategori_perolehan_id == '5'){
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$request->jenis_iklan_id)
                                            ->where('kategori_perolehan_id',$request->kategori_perolehan_id)
                                            ->where('negeri_id',$request->negeri_id)
                                            ->where('bahagian_id',$request->section_id)
                                            ->where('year',$request->tahun_perolehan)
                                            ->first();
            }else {
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$request->jenis_iklan_id)
                                            ->whereNull('kategori_perolehan_id')
                                            ->where('negeri_id',$request->negeri_id)
                                            ->where('bahagian_id',$request->section_id)
                                            ->where('year',$request->tahun_perolehan)
                                            ->first();
            }
        } else { // kalau negeri
            if( $request->kategori_perolehan_id == '5'){
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$request->jenis_iklan_id)
                                            ->where('kategori_perolehan_id',$request->kategori_perolehan_id)
                                            ->where('negeri_id',$request->negeri_id)
                                            ->where('year',$request->tahun_perolehan)
                                            ->first();
            }else {
                $runno = RunningNoPerolehan::where('jenis_iklan_id',$request->jenis_iklan_id)
                                            ->whereNull('kategori_perolehan_id')
                                            ->where('negeri_id',$request->negeri_id)
                                            ->where('year',$request->tahun_perolehan)
                                            ->first();
            }
        }
        $run_number = $runno->running_no + 1;
        $num_padded = sprintf("%02d", $run_number);

        $no_perolehan = $runno->code.$num_padded."/".$runno->year;
        $id_running_no = $runno->id;

        return response()->json([$no_perolehan, $id_running_no]);
    }

    public function getMaklumatPadam($id)
    {
        $data = PermohonanNomborPerolehan::where('id_perolehan',$id)->get();
        return response()->json([$data]);
    }

    public function laporanPerolehan()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $jenisiklan = JenisIklan::all();
        $negeri = Negeri::all();
        $data = [];
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "3") {
                $type = "PENGESAH NOMBOR PEROLEHAN";
            }
        }
        if( $type == "PENGESAH NOMBOR PEROLEHAN") {
            return view('sisdant::laporanDaftarPerolehan',compact('jenisiklan','negeri'));
        } else {
            return redirect('/dashboard');
        }
    }

    public function getBahagian(Request $request)
    {
        $selectednegeri = $request->result;
        $pejabat = Pejabat::select('id','bahagian')->whereIn('negeri_id', $selectednegeri)->get();
        return response()->json($pejabat);
    }

    public function filterLaporan(Request $request)
    {   $user = auth()->user();
        if (!$user) {
            return redirect('/dashboard');
        }
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "3") {
                $type = "PENGESAH NOMBOR PEROLEHAN";
            }
        }

        $jenisiklan = JenisIklan::all();
        $negeri = Negeri::all();
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
        $data = '{"status":'.json_encode($request->status)
            .',"j_iklan":'.json_encode($request->jenisiklan)
            .',"k_perolehan":'.json_encode($request->kategoriperolehan)
            .',"j_perolehan":'.json_encode($request->jenisperolehan)
            .',"negeri":'.json_encode($request->negeri)
            .',"bahagian":'.json_encode($request->bahagian)
            .',"tarikhmula":'.json_encode($tarikhmula)
            .',"tarikhakhir":'.json_encode($tarikhakhir)
            .'}';
        $data = json_decode($data);
        if( $type == "PENGESAH NOMBOR PEROLEHAN") {
            return redirect()->route('laporanPerolehan.laporanperolehan')->with( ['data' => $data] );
        } else {
            return redirect('/dashboard');
        }
    }
    public function getSubTajuk($id)
    {
        $subtajuk = SubKelasPukonsa::where('tajuk_id',$id)->get();

        return response()->json([$subtajuk]);
    }

    public function getSubTajukUpkj($id)
    {
        $subtajuk = SubKelasUpkj::where('tajuk_id',$id)->get();

        return response()->json([$subtajuk]);
    }

    public function viewIklan($id)
    {
        //check role
        $user = auth()->user();
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "12"){
                $type = "PELAKSANA";
            }
        }
        if(!$type == "PELAKSANA") {
            return redirect('/dashboard');
        }

        $mohon = PermohonanNomborPerolehan::with('negeri', 'users.section', 'matrikIklan.jenisIklan', 'matrikIklan.KategoriPerolehan', 'matrikIklan.jenisTender')
                            ->where('id_perolehan', $id)->first();
        $data = IklanPerolehan::with('caraBayar', 'pejabatPamer', 'pejabatLapor', 'bayarKepada', 'petiTender')->where('mohon_no_perolehan_id', $mohon->id_perolehan )->first();

        $borang_daftar = TemplatBorangDaftar::where('iklan_perolehan_id', $id )->first();

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
        $carabayar = CaraBayar::where('id', '!=', $data->cara_bayaran)->where('id', '!=', 5)->get();

        if ($data->peti_tender == null){
            $petitender = SenaraiAlamat::get();
        } else {
            $petitender = SenaraiAlamat::where('id', '!=', $data->petitender['id'])->get();
        }

        if ($data->pejabat_pamer_jual != null){
            $senaraialamat = SenaraiAlamat::where('id', '!=', $data->pejabat_pamer_jual)->get();
        } else {
            $senaraialamat = SenaraiAlamat::get();
        }

        if ($data->pejabatlapor != null){
            $alamat = SenaraiAlamat::where('id', '!=', $data->pejabatlapor['id'])->get();
        } else {
            $alamat = SenaraiAlamat::get();
        }

        $bayarkepada = BayarKepada::where('id', '!=', $data->bayar_kepada)->where('id', '!=', 4)->get();
        $tablebidang = Bidang::all();
        $tableSubbidang = SubBidang::all();
        $tablekelas = Kelas::all();
        $tableKhusus = Pengkhususan::all();
        $tablepukonsa = KelasPukonsa::get();
        $subkelaspukonsa = SubKelasPukonsa::get();
        $tableupkj = KelasUpkj::get();
        $subkelasupkj = SubKelasUpkj::get();
        $grade = Grade::get();
        $negeri_permohonan = Negeri::select('singkatan')->where('id', $mohon->negeri_id)->first();
        $negeri_singkatan = $negeri_permohonan->singkatan;
        $matrik_iklan = MatrikIklan::where('id', $mohon->matrik_iklan_id)->first();
        $perolehan = KategoriPerolehan::where('id', $matrik_iklan->kategori_perolehan_id)->first();
        $nama_perolehan = $perolehan->nama;
        $tablepukonsa = KelasPukonsa::get();
        $kelaspukonsa = KelasPukonsa::get();
        $subkelaspukonsa = SubKelasPukonsa::get();
        $tableupkj = KelasUpkj::get();
        $kelasupkj = KelasUpkj::get();
        $subkelasupkj = SubKelasUpkj::get();

        return view('sisdant::viewiklan', compact('data', 'mohon', 'negeri', 'jenis', 'tender', 'kategori', 'carabayar', 'senaraialamat', 'bayarkepada', 'alamat', 'petitender', 'bidang_sub', 'dokumen_tender', 'tablebidang', 'tableSubbidang', 'bidang_data', 'kelas_data', 'data_khusus', 'tablekelas', 'tableKhusus','grade', 'data_pukonsa', 'tablepukonsa', 'subkelaspukonsa', 'pukonsa_data', 'upkj_data', 'data_upkj', 'tableupkj', 'subkelasupkj', 'borang_daftar', 'negeri_singkatan', 'nama_perolehan', 'kelaspukonsa', 'subkelaspukonsa', 'tablepukonsa', 'kelasupkj', 'subkelasupkj', 'tableupkj' ));
    }

    public function saveIklan(Request $request)
    {
        $input = $request->all();
        $id = $request->iklan_perolehan_id;
        $dataperolehan = PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_perolehan_id)->first();
        $negeri = Negeri::select('singkatan')->where('id', $dataperolehan->negeri_id)->first();
        $negeri = $negeri->singkatan;

        $fileIklan = $request->file('upload'); //get dokumen iklan
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
        PermohonanNomborPerolehan::where('id_perolehan',$request->mohon_perolehan_id)->update(['tajuk_perolehan'=>$request->tajuk]);

        //set status iklan
        if($request->status == "hantar") {
            if ($request->kategori_iklan_id != 1) { //portal
                $status_iklan_id = 2;
                PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_perolehan_id) -> update(['status' => "iklan"]);
            } else { // ePerolehan
                $status_iklan_id = 7;
                PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_perolehan_id) -> update(['status' => "selesai"]);
            }

        } else {
            $status_iklan_id = 1;
            PermohonanNomborPerolehan::where('id_perolehan', $request->mohon_perolehan_id) -> update(['status' => "draf-iklan"]);
        }

        //checking status kemaskini
        $check = IklanPerolehan::where('id',$id)->first();
        if ($check->status_kemaskini == null){
            $status_kemaskini = 1;
        } else {
            $status_kemaskini = $check->status_kemaskini + 1;
        }
        if ($request->cara_bayar == 1){
            $harga = 0;
            $bayar_kepada = 4;
        } else {
            $harga = $request->harga_dokumen;
            $bayar_kepada = $request->bayar_kepada;
        }

        // update iklan perolehan
        if ($request->kategori_iklan_id != 1) { //portal
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
                'status_iklan_id' => $status_iklan_id,
                'grade_id' => $request->gred,
                'status_kemaskini' => $status_kemaskini,
            ]);
        } else { // ePerolehan
            IklanPerolehan::where('id',$id)->update([
                'tarikh_mula_jual' => $request->tarikh_mula_jual,
                'tarikh_akhir_jual' => $request->tarikh_akhir_jual,
                'pejabat_pamer_jual' => $request->pejabat_pamer,
                'tarikh_lawatan_tapak' => $request->tarikh_lawatan_tapak,
                'lawatan_tapak' => $request->lawatan_tapak,
                'pejabat_lapor' => $request->pejabat_lapor,
                'waktu_lapor' => $request->waktu_lapor,
                'harga_dokumen' => $harga,
                'cara_bayaran_id' => 5,
                'bayar_kepada_id' => 4,
                'lokasi_tapak' => $request->lokasi,
                'status_iklan_id' => $status_iklan_id,
                'grade_id' => $request->gred,
                'status_kemaskini' => $status_kemaskini,
            ]);
        }


        //update bidang and subbidang
        if($request->counterbidang) {
            $bidangsubidang = BidangSubbidang::select('bidang_id')->where('iklan_perolehan_id', $id)->distinct()->get(); // get data
            $bidang_id = [];

            for ($i = 0 ; $i<count($bidangsubidang); $i++){
                array_push($bidang_id, $bidangsubidang[$i]->bidang_id);
            }

            BidangSubbidang::where('iklan_perolehan_id', $id)->delete(); // delete data

            for ($counter = 0; $counter < ((int)$request->counterbidang + 1); $counter++){
                $bidang = "bidang". $counter;
                $subbidang = "subbidang". $counter;

                //loop subbidang
                for ($sub = 0; $sub < count((array)$request->$subbidang); $sub++) {

                    if ($request->$bidang) {
                        $bidang = $request->$bidang;
                    } else {
                        $bidang = $bidang_id[$counter];
                    }

                    $data_sub = array(
                        'iklan_perolehan_id' => $id,
                        'bidang_id' => $bidang,
                        'sub_bidang_id' => $request->$subbidang[$sub],
                    );

                    //save bidang subbidang
                    $create_bidang_sub = new BidangSubbidang();
                    $create_bidang_sub->fill($data_sub);
                    $create_bidang_sub->save();
                }
            }
        }

        //update kelas and pengkhususan
        if($request->counterkelas) {

            $kelasp = KelasPengkhususan::select('kelas_id')->where('iklan_perolehan_id', $id)->distinct()->get(); // get data
            $kelas_id = [];

            for ($i = 0 ; $i<count($kelasp); $i++){
                array_push($kelas_id, $kelasp[$i]->kelas_id);
            }

            KelasPengkhususan::where('iklan_perolehan_id', $id)->delete(); // delete data

            for ($kira = 0; $kira < ((int)$request->counterkelas + 1); $kira++){
                $kelas = "kelas". $kira;
                $khusus = "khusus". $kira;


                // loop khusus
                for ($sub_khusus = 0; $sub_khusus < count((array)$request->$khusus); $sub_khusus++) {

                    if ($request->$kelas) {
                        $kelas = $request->$kelas;
                    } else {
                        $kelas = $kelas_id[$kira];
                    }

                    $data_khusus = array(
                        'iklan_perolehan_id' => $id,
                        'kelas_id' => $kelas,
                        'pengkhususan_id' => $request->$khusus[$sub_khusus],
                    );

                    $create_kelas_khusus = new KelasPengkhususan();
                    $create_kelas_khusus->fill($data_khusus);
                    $create_kelas_khusus->save();
                }
            }
        }

         //pukonsa

        if ($negeri == 'IP') {
            if ($request->syarat == 'pukonsa') {

                $upkjp = IklanKelasUpkj::select('tajuk_id')->where('iklan_perolehan_id', $id)->distinct()->get(); // get data

                if ($upkjp) {
                    IklanKelasUpkj::where('iklan_perolehan_id', $id)->delete();
                }

                if($request->counterpukonsa) {

                    $pukonsa = IklanKelasPukonsa::select('tajuk_id')->where('iklan_perolehan_id', $id)->distinct()->get(); // get data
                    $tajuk_id = [];

                    for ($i = 0 ; $i<count($pukonsa); $i++){
                        array_push($tajuk_id, $pukonsa[$i]->tajuk_id);
                    }
                    IklanKelasPukonsa::where('iklan_perolehan_id', $id)->delete(); // delete data

                    for ($kira = 0; $kira < ((int)$request->counterpukonsa + 1); $kira++){
                        $tajuk = "tajukpukonsa". $kira;
                        $sub_tajuk = "subtajukpukonsa". $kira;

                        // loop khusus
                        for ($i = 0; $i < count((array)$request->$sub_tajuk); $i++) {

                            if ($request->$tajuk) {
                                $tajuk = $request->$tajuk;
                            } else {
                                $tajuk = $tajuk_id[$kira];
                            }

                            $data = array(
                                'iklan_perolehan_id' =>$id,
                                'tajuk_id' => $tajuk,
                                'tajukkecil_id' => $request->$sub_tajuk[$i],
                            );


                            $create_kelas_pukonsa = new IklanKelasPukonsa();
                            $create_kelas_pukonsa->fill($data);
                            $create_kelas_pukonsa->save();
                        }
                    }
                } else {
                    for ($kira = 0; $kira < ((int)$request->counterpukonsa + 1); $kira++){
                        $tajuk = "tajukpukonsa". $kira;
                        $sub_tajuk = "subtajukpukonsa". $kira;

                        // loop khusus
                        for ($i = 0; $i < count((array)$request->$sub_tajuk); $i++) {

                            $data = array(
                                'iklan_perolehan_id' => $id,
                                'tajuk_id' => $request->$tajuk,
                                'tajukkecil_id' => $request->$sub_tajuk[$i],
                            );

                            $create_kelas_pukonsa = new IklanKelasPukonsa();
                            $create_kelas_pukonsa->fill($data);
                            $create_kelas_pukonsa->save();
                        }
                    }
                }

            } else if ($request->syarat == 'upkj') {

                $pukonsaj = IklanKelasPukonsa::select('tajuk_id')->where('iklan_perolehan_id', $id)->distinct()->get(); // get data

                if ($pukonsaj) {
                    IklanKelasPukonsa::where('iklan_perolehan_id', $id)->delete();
                }
                //upkj
                if($request->counterupkj) {
                    $upkj = IklanKelasUpkj::select('tajuk_id')->where('iklan_perolehan_id', $id)->distinct()->get(); // get data
                    $tajukupkj_id = [];

                    for ($i = 0 ; $i<count($upkj); $i++){
                        array_push($tajukupkj_id, $upkj[$i]->tajuk_id);
                    }

                    IklanKelasUpkj::where('iklan_perolehan_id', $id)->delete(); // delete data

                    for ($kira = 0; $kira < ((int)$request->counterupkj + 1); $kira++){
                        $tajukupkj = "tajukupkj". $kira;
                        $sub_tajukupkj = "subtajukupkj". $kira;

                        // loop khusus

                        for ($i = 0; $i < count((array)$request->$sub_tajukupkj); $i++) {

                            if ($request->$tajukupkj) {
                                $tajukupkj = $request->$tajukupkj;
                            } else {
                                $tajukupkj = $tajukupkj_id[$kira];
                            }


                            $data = array(
                                'iklan_perolehan_id' => $id,
                                'tajuk_id' => $tajukupkj,
                                'tajukkecil_id' => $request->$sub_tajukupkj[$i],
                            );

                            $create_kelas_upkj = new IklanKelasUpkj();
                            $create_kelas_upkj->fill($data);
                            $create_kelas_upkj->save();
                        }
                    }
                } else {
                    for ($kira = 0; $kira < ((int)$request->counterupkj + 1); $kira++){
                        $tajuk = "tajukupkj". $kira;
                        $sub_tajuk = "subtajukupkj". $kira;

                        // loop khusus
                        for ($i = 0; $i < count((array)$request->$sub_tajuk); $i++) {

                            $data = array(
                                'iklan_perolehan_id' => $id,
                                'tajuk_id' => $request->$tajuk,
                                'tajukkecil_id' => $request->$sub_tajuk[$i],
                            );

                            $create_kelas_upkj = new IklanKelasUpkj();
                            $create_kelas_upkj->fill($data);
                            $create_kelas_upkj->save();
                        }
                    }
                }

            } else if ($request->syarat == 'tiada') {

                $pukonsaj = IklanKelasPukonsa::select('tajuk_id')->where('iklan_perolehan_id', $id)->distinct()->get(); // get data

                if ($pukonsaj) {
                    IklanKelasPukonsa::where('iklan_perolehan_id', $id)->delete();
                }

                $upkjp = IklanKelasUpkj::select('tajuk_id')->where('iklan_perolehan_id', $id)->distinct()->get(); // get data

                if ($upkjp) {
                    IklanKelasUpkj::where('iklan_perolehan_id', $id)->delete();
                }
            }

        } else if ($negeri != 'IP') {
            if($request->counterpukonsa) {

                $pukonsa = IklanKelasPukonsa::select('tajuk_id')->where('iklan_perolehan_id', $id)->distinct()->get(); // get data
                $tajuk_id = [];

                for ($i = 0 ; $i<count($pukonsa); $i++){
                    array_push($tajuk_id, $pukonsa[$i]->tajuk_id);
                }
                IklanKelasPukonsa::where('iklan_perolehan_id', $id)->delete(); // delete data

                for ($kira = 0; $kira < ((int)$request->counterpukonsa + 1); $kira++){
                    $tajuk = "tajukpukonsa". $kira;
                    $sub_tajuk = "subtajukpukonsa". $kira;

                    // loop khusus
                    for ($i = 0; $i < count((array)$request->$sub_tajuk); $i++) {

                        if ($request->$tajuk) {
                            $tajuk = $request->$tajuk;
                        } else {
                            $tajuk = $tajuk_id[$kira];
                        }

                        $data = array(
                            'iklan_perolehan_id' =>$id,
                            'tajuk_id' => $tajuk,
                            'tajukkecil_id' => $request->$sub_tajuk[$i],
                        );


                        $create_kelas_pukonsa = new IklanKelasPukonsa();
                        $create_kelas_pukonsa->fill($data);
                        $create_kelas_pukonsa->save();
                    }
                }
            }

            //upkj
            if($request->counterupkj) {
                $upkj = IklanKelasUpkj::select('tajuk_id')->where('iklan_perolehan_id', $id)->distinct()->get(); // get data
                $tajukupkj_id = [];

                for ($i = 0 ; $i<count($upkj); $i++){
                    array_push($tajukupkj_id, $upkj[$i]->tajuk_id);
                }

                IklanKelasUpkj::where('iklan_perolehan_id', $id)->delete(); // delete data

                for ($kira = 0; $kira < ((int)$request->counterupkj + 1); $kira++){
                    $tajukupkj = "tajukupkj". $kira;
                    $sub_tajukupkj = "subtajukupkj". $kira;

                    // loop khusus

                    for ($i = 0; $i < count((array)$request->$sub_tajukupkj); $i++) {

                        if ($request->$tajukupkj) {
                            $tajukupkj = $request->$tajukupkj;
                        } else {
                            $tajukupkj = $tajukupkj_id[$kira];
                        }


                        $data = array(
                            'iklan_perolehan_id' => $id,
                            'tajuk_id' => $tajukupkj,
                            'tajukkecil_id' => $request->$sub_tajukupkj[$i],
                        );

                        $create_kelas_upkj = new IklanKelasUpkj();
                        $create_kelas_upkj->fill($data);
                        $create_kelas_upkj->save();
                    }
                }
            }
        }

        if($request->status == "hantar") {
            if ($request->kategori_iklan_id != 1) { //portal
                // email PELAKSANA
                $to_email = auth()->user()->email;
                $data = array('no_perolehan' => $dataperolehan->no_perolehan);
                Mail::to($to_email)->send(new MailKemasPermohonanSah($data));

                // email kepada Pentadbir
                $getPengesah =  User::join(
                    'model_has_roles',
                    'users.id','=','model_has_roles.model_id'
                )->where('model_has_roles.role_id', 3)->get();

                for ($sah = 0; $sah < count($getPengesah); $sah++){

                    $to_emel = $getPengesah[$sah]->email;
                    $data = array('no_perolehan' => $dataperolehan->no_perolehan);
                    Mail::to($to_emel)->send(new MailMaklumKemaskiniPermohonanSah($data));

                }
            } else { //ePerolehan
                // email PELAKSANA
                $to_email = auth()->user()->email;
                $data = array('no_perolehan' => $dataperolehan->no_perolehan);
                Mail::to($to_email)->send(new MailUpdateEP($data));
            }
            $msg = "Permohonan Berjaya Dikemaskini";
        } else {
            $msg = "Permohonan Berjaya Disimpan";
        }
        return redirect('/sisdant')->with('status', $msg);
    }

    public function simpanPermohonan(Request $request)
    {
        PermohonanNomborPerolehan::where('id_perolehan',$request->id_perolehan)->update(['tajuk_perolehan'=>$request->tajuk]);
        $msg = "Tajuk perolehan Berjaya Dikemaskini";
        return redirect('/sisdant')->with('status', $msg);
    }

    public function viewIklanSah($id)
    {
        //check role
        $user = auth()->user();
        $checkrole = ModelHasRoles::where('model_id',$user->id)->get();
        $type = "";
        for ($i=0; $i < count($checkrole); $i++) {
            if ($checkrole[$i]->role_id  == "12"){
                $type = "PELAKSANA";
            }
        }
        if(!$type == "PELAKSANA") {
            return redirect('/dashboard');
        }

        $mohon = PermohonanNomborPerolehan::with('negeri', 'users.section', 'matrikIklan.jenisIklan', 'matrikIklan.KategoriPerolehan', 'matrikIklan.jenisTender')
                            ->where('id_perolehan', $id)->first();
        $data = IklanPerolehan::with('caraBayar', 'pejabatPamer', 'pejabatLapor', 'bayarKepada', 'petiTender')->where('mohon_no_perolehan_id', $mohon->id_perolehan )->first();

        $borang_daftar = TemplatBorangDaftar::where('iklan_perolehan_id', $id )->first();

        $noPerolehan = str_replace("/","_",$mohon->no_perolehan);
        $name_qr = 'QR_CODE_'.$noPerolehan.'.pdf';
        $path_qrcode = '/'.'storage/qrcode/'.$name_qr;

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
        $carabayar = CaraBayar::where('id', '!=', $data->cara_bayaran)->where('id', '!=', 5)->get();

        if ($data->peti_tender == null){
            $petitender = SenaraiAlamat::get();
        } else {
            $petitender = SenaraiAlamat::where('id', '!=', $data->petitender['id'])->get();
        }

        if ($data->pejabat_pamer_jual != null){
            $senaraialamat = SenaraiAlamat::where('id', '!=', $data->pejabat_pamer_jual)->get();
        } else {
            $senaraialamat = SenaraiAlamat::get();
        }

        if ($data->pejabatlapor != null){
            $alamat = SenaraiAlamat::where('id', '!=', $data->pejabatlapor['id'])->get();
        } else {
            $alamat = SenaraiAlamat::get();
        }

        $bayarkepada = BayarKepada::where('id', '!=', $data->bayar_kepada)->where('id', '!=', 4)->get();
        $tablebidang = Bidang::all();
        $tableSubbidang = SubBidang::all();
        $tablekelas = Kelas::all();
        $tableKhusus = Pengkhususan::all();
        $tablepukonsa = KelasPukonsa::get();
        $subkelaspukonsa = SubKelasPukonsa::get();
        $tableupkj = KelasUpkj::get();
        $subkelasupkj = SubKelasUpkj::get();
        $grade = Grade::get();
        $negeri_permohonan = Negeri::select('singkatan')->where('id', $mohon->negeri_id)->first();
        $negeri_singkatan = $negeri_permohonan->singkatan;
        $matrik_iklan = MatrikIklan::where('id', $mohon->matrik_iklan_id)->first();
        $perolehan = KategoriPerolehan::where('id', $matrik_iklan->kategori_perolehan_id)->first();
        $nama_perolehan = $perolehan->nama;
        $tablepukonsa = KelasPukonsa::get();
        $kelaspukonsa = KelasPukonsa::get();
        $subkelaspukonsa = SubKelasPukonsa::get();
        $tableupkj = KelasUpkj::get();
        $kelasupkj = KelasUpkj::get();
        $subkelasupkj = SubKelasUpkj::get();

        return view('sisdant::viewiklan-sah', compact('data', 'mohon', 'negeri', 'jenis', 'tender', 'kategori', 'carabayar', 'senaraialamat', 'bayarkepada', 'alamat', 'petitender', 'bidang_sub', 'dokumen_tender', 'tablebidang', 'tableSubbidang', 'bidang_data', 'kelas_data', 'data_khusus', 'tablekelas', 'tableKhusus','grade', 'data_pukonsa', 'tablepukonsa', 'subkelaspukonsa', 'pukonsa_data', 'upkj_data', 'data_upkj', 'tableupkj', 'subkelasupkj', 'borang_daftar', 'negeri_singkatan', 'nama_perolehan', 'kelaspukonsa', 'subkelaspukonsa', 'tablepukonsa', 'kelasupkj', 'subkelasupkj', 'tableupkj', 'path_qrcode' ));
    }

    public function iklanbatal($id)
    {

        $data = IklanPerolehan::with('caraBayar', 'pejabatPamer', 'pejabatLapor', 'bayarKepada', 'petiTender')->where('id', $id )->first();
        $borang_daftar = TemplatBorangDaftar::where('iklan_perolehan_id', $id )->first();

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

        return view('sisdant::iklanbatal', compact('data', 'mohon', 'negeri', 'jenis', 'tender', 'kategori', 'carabayar', 'senaraialamat', 'bayarkepada', 'alamat', 'petitender', 'bidang_sub', 'dokumen_tender', 'tablebidang', 'tableSubbidang', 'bidang_data', 'kelas_data', 'data_khusus', 'tablekelas', 'tableKhusus','grade', 'data_pukonsa', 'tablepukonsa', 'subkelaspukonsa', 'pukonsa_data', 'upkj_data', 'data_upkj', 'tableupkj', 'subkelasupkj', 'borang_daftar', 'butangBatal'));
    }
}
