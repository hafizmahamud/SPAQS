<?php
/**
 * SuratKeputusanController File.
 *
 * PHP Version 8.0
 *
 * @category SuratKeputusanController
 * @package  SuratKeputusanController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate;

use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\Template\UpdateSuratKeputusanRequest;
use App\Http\Controllers\Controller;
use App\Models\SuratEdarKeputusan;
use App\Domains\Auth\Services\SuratKeputusanService;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Models\Tandatangan;
use App\Models\HeaderSurat;

/**
 * Class SuratKeputusanController.
 *
 * @category SuratKeputusanController
 * @package  SuratKeputusanController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SuratKeputusanController extends Controller
{
    /**
     * SuratKeputusanController service.
     *
     * @var SuratKeputusanService
     */
    protected $SuratKeputusanService;

    /**
     * SuratKeputusanController constructor.
     *
     * @param SuratKeputusanService $suratkeputusanService comment about this variable
     */
    public function __construct(SuratKeputusanService $suratkeputusanService)
    {
        $this->suratkeputusanService = $suratkeputusanService;
    }

    /**
     * Index
     *
     * @param SuratEdarKeputusan $suratedarkeputusan comment about this variable
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SuratEdarKeputusan $suratedarkeputusan)
    {
        $data = SuratEdarKeputusan::first();
        return view('backend.auth.template.surat_keputusan.index', ['data' => $data,]);
    }

    /**
     * Function edit
     *
     * @param SuratEdarKeputusan $suratedarkeputusan comment about this variable
     *
     * @return mixed
     */
    public function edit(SuratEdarKeputusan $suratedarkeputusan)
    {
        return view(
            'backend.auth.template.surat_keputusan.edit',
            [
                'data' => $suratedarkeputusan,
            ]
        );
    }

    /**
     * Update suratedarkeputusan
     *
     * @param UpdateSuratKeputusanRequest $request            comment about this variable
     * @param SuratEdarKeputusan          $suratedarkeputusan comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateSuratKeputusanRequest $request, SuratEdarKeputusan $suratedarkeputusan)
    {
        $this->suratkeputusanService->update($suratedarkeputusan, $request->validated());

        return redirect()->route('admin.auth.suratkeputusan.index', $suratedarkeputusan)->withFlashSuccess(__('Maklumat surat edar keputusan telah berjaya dikemaskini.'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatesuratkeputusan()
    {
        $filename = 'Template Surat Edaran Keputusan MLP.pdf';

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
                'rujukan' => $data->rujukan,
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
        ];

        $ruj = '<label style="font-size:11px; font-family: Arial;">(&nbsp;&nbsp;&nbsp;&nbsp;) ' . $data['rujukan'] .' </label><br>';
        $date = '<label style="font-size:11px; font-family: Arial;">' . date('F Y') .' </label><br>';

        $view = \View::make('pdf_tem_suratEdarKeputusan', $data);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Template Surat Edaran Keputusan MLP');
        $pdf::SetMargins(20, 10, 15, true); //left bottom right
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::writeHTMLCell(0, 0, 135, -250, $ruj); //width  height x y
        $pdf::writeHTMLCell(0, 0, 173, -245, $date);

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
