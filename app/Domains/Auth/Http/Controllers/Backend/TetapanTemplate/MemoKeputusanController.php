<?php
/**
 * MemoKeputusanController File.
 *
 * PHP Version 8.0
 *
 * @category MemoKeputusanController
 * @package  MemoKeputusanController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate;

use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\Template\UpdateMemoKeputusanRequest;
use App\Http\Controllers\Controller;
use App\Models\MemoEdarKeputusan;
use App\Domains\Auth\Services\MemoKeputusanService;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Models\Tandatangan;
use App\Models\HeaderSurat;

/**
 * Class MemoKeputusanController.
 *
 * @category MemoKeputusanController
 * @package  MemoKeputusanController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MemoKeputusanController extends Controller
{
    /**
     * MemoKeputusanController service.
     *
     * @var MemoKeputusanService
     */
    protected $MemoKeputusanService;

    /**
     * MemoKeputusanController constructor.
     *
     * @param MemoKeputusanService $memokeputusanService comment about this variable
     */
    public function __construct(MemoKeputusanService $memokeputusanService)
    {
        $this->memokeputusanService = $memokeputusanService;
    }

    /**
     * Index
     *
     * @param MemoEdarKeputusan $memoedarkeputusan comment about this variable
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(MemoEdarKeputusan $memoedarkeputusan)
    {
        $data = MemoEdarKeputusan::first();
        return view('backend.auth.template.memo_keputusan.index', ['data' => $data,]);
    }

    /**
     * Function edit
     *
     * @param MemoEdarKeputusan $memoedarkeputusan comment about this variable
     *
     * @return mixed
     */
    public function edit(MemoEdarKeputusan $memoedarkeputusan)
    {
        return view(
            'backend.auth.template.memo_keputusan.edit',
            [
                'data' => $memoedarkeputusan,
            ]
        );
    }

    /**
     * Update memoedarkeputusan
     *
     * @param UpdateMemoKeputusanRequest $request           comment about this variable
     * @param MemoEdarKeputusan          $memoedarkeputusan comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateMemoKeputusanRequest $request, MemoEdarKeputusan $memoedarkeputusan)
    {

        $this->memokeputusanService->update($memoedarkeputusan, $request->validated());

        return redirect()->route('admin.auth.memokeputusan.index', $memoedarkeputusan)->withFlashSuccess(__('Maklumat memo edar keputusan telah berjaya dikemaskini.'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatememokeputusan()
    {
        $filename = 'Template Memo Edaran Keputusan MLP.pdf';

        $header = HeaderSurat::first();
        $data = MemoEdarKeputusan::first();
        // dd($header);

        $jabatan = explode("(", $header->jabatan);
        $jabatanBM = $jabatan[0];
        $jabatanEN = '(' . $jabatan[1];

        $kementerian = explode("(", $header->kementerian);
        $kementerianBM = $kementerian[0];
        $kementerianEN = '(' . $kementerian[1];

        $alamat = preg_split("/\,/", $header->alamat);

        $moto = preg_split("/\n/", $data->moto);

        $info_pengarah = Tandatangan::first();

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
                'rujukan' => $data->rujukan,
                'tarikh' => strtoupper(date('F Y')),
                'perkara' => $data->perkara,
                'kementerian' => $data->kementerian,
                'kementerian1' => $data->kementerian1,
                'text_1' => $data->text_1,
                'title' => $data->title,
                'text_3' => $data->text_3,
                'moto' => $moto,
                'sym' => $data->sym,
                'nama' => $info_pengarah->nama,
                'tanda_tangan' => config('app.url'). $info_pengarah->path_tandatangan,
        ];

        $view = \View::make('pdf_tem_memoKeputusan', $data);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Template Memo Edaran Keputusan MLP');
        $pdf::SetMargins(20, 10, 15, true); //left bottom right
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
