<?php
/**
 * LantikanPenilaiController File.
 *
 * PHP Version 8.0
 *
 * @category LantikanPenilaiController
 * @package  LantikanPenilaiController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate;

use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\Template\LantikanPenilai\UpdateLantikanPenilaiRequest;
use App\Http\Controllers\Controller;
use App\Models\LantikanPenilai;
use App\Domains\Auth\Services\LantikanPenilaiService;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Str;
use App\Models\HeaderSurat;
use App\Models\Tandatangan;

/**
 * Class LantikanPenilaiController.
 *
 * @category LantikanPenilaiController
 * @package  LantikanPenilaiController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LantikanPenilaiController extends Controller
{
    /**
     * LantikanPenilaiController service.
     *
     * @var LantikanPenilaiService
     */
    protected $LantikanPenilaiService;

    /**
     * LantikanPenilaiController constructor.
     *
     * @param LantikanPenilaiService $lantikanpenilaiService comment about this variable
     */
    public function __construct(LantikanPenilaiService $lantikanpenilaiService)
    {
        $this->lantikanpenilaiService = $lantikanpenilaiService;
    }

    /**
     * Index
     *
     * @param LantikanPenilai $lantikanpenilai comment about this variable
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(LantikanPenilai $lantikanpenilai)
    {
        $data = LantikanPenilai::first();
        return view('backend.auth.template.lantikan_penilai.index', ['data' => $data,]);
    }

    /**
     * Function edit
     *
     * @param LantikanPenilai $lantikanpenilai comment about this variable
     *
     * @return mixed
     */
    public function edit(LantikanPenilai $lantikanpenilai)
    {
        return view(
            'backend.auth.template.lantikan_penilai.edit',
            [
                'data' => $lantikanpenilai,
            ]
        );
    }

    /**
     * Update lantikanpenilai
     *
     * @param UpdateLantikanPenilaiRequest $request         comment about this variable
     * @param LantikanPenilai              $lantikanpenilai comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateLantikanPenilaiRequest $request, LantikanPenilai $lantikanpenilai)
    {
        $this->lantikanpenilaiService->update($lantikanpenilai, $request->validated());

        return redirect()->route('admin.auth.lantikanpenilai.index', $lantikanpenilai)->withFlashSuccess(__('Lantikan Penilai telah berjaya dikemaskini.'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateMemoLantikanPenilai()
    {
        $filename = 'Template Memo Perlantikan Penilai.pdf';

        $header = HeaderSurat::first();
        $detail = LantikanPenilai::first();

        $jabatan = explode("(", $header->jabatan);
        $jabatanBM = $jabatan[0];
        $jabatanEN = '(' . $jabatan[1];

        $kementerian = explode("(", $header->kementerian);
        $kementerianBM = $kementerian[0];
        $kementerianEN = '(' . $kementerian[1];

        $alamat = preg_split("/\,/", $header->alamat);

        $moto = preg_split("/\n/", $detail->moto_1);

        $info_pengarah = Tandatangan::first();

        $data = [
                'jata_negara' => config('app.url'). $header->path_jata_negara,
                'memo_surat' => config('app.url'). $header->path_img_memo,
                'jabatanBM' => $jabatanBM,
                'jabatanEN' => $jabatanEN,
                'kementerianBM' => $kementerianBM,
                'kementerianEN' => $kementerianEN,
                'alamats' => $alamat,
                'laman_web' => $header->laman_web,
                'no_tel' => $header->no_tel,
                'no_fax' => $header->no_fax,
                'email' => $header->email,
                'tarikh' => date('F Y'),
                'text_1' => $detail->text_1,
                'text_2' => $detail->text_2,
                'text_3' => $detail->text_3,
                'text_4' => $detail->text_4,
                'moto' => $moto,
                'sym' => $detail->sym,
                'nama' => $info_pengarah->nama,
                'tanda_tangan' => config('app.url'). $info_pengarah->path_tandatangan,
        ];

        $view = \View::make('pdf_tem_memolantikan', $data);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Template Memo Perlantikan Penilai');
        $pdf::SetMargins(30, 10, 15, true);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        try {
            mkdir(base_path('/storage/app/public/tetapanTemplate/download'));
        } catch (\Throwable $th) {
            //throw $th;
        }
        $path = storage_path().'/app/public/tetapanTemplate/download/';

        $pdf::Output($path . $filename, 'F');

        return response()->download($path . $filename);
    }

}
