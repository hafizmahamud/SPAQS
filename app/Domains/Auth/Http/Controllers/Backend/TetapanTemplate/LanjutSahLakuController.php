<?php
/**
 * LanjutSahLakuController File.
 *
 * PHP Version 8.0
 *
 * @category LanjutSahLakuController
 * @package  LanjutSahLakuController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate;

use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\Template\UpdateLanjutSahLakuRequest;
use App\Http\Controllers\Controller;
use App\Models\LanjutSahLaku;
use App\Domains\Auth\Services\LanjutSahLakuService;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Models\Tandatangan;
use App\Models\HeaderSurat;

/**
 * Class LanjutSahLakuController.
 *
 * @category LanjutSahLakuController
 * @package  LanjutSahLakuController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LanjutSahLakuController extends Controller
{
    /**
     * LanjutSahLakuController service.
     *
     * @var LanjutSahLakuService
     */
    protected $LanjutSahLakuService;

    /**
     * LanjutSahLakuController constructor.
     *
     * @param LanjutSahLakuService $lanjutsahlakuService comment about this variable
     */
    public function __construct(LanjutSahLakuService $lanjutsahlakuService)
    {
        $this->lanjutsahlakuService = $lanjutsahlakuService;
    }

    /**
     * Index
     *
     * @param LanjutSahLaku $lanjutsahlaku comment about this variable
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(LanjutSahLaku $lanjutsahlaku)
    {
        $data = LanjutSahLaku::first();
        return view('backend.auth.template.lanjut_sahlaku.index', ['data' => $data,]);
    }

    /**
     * Function edit
     *
     * @param LanjutSahLaku $lanjutsahlaku comment about this variable
     *
     * @return mixed
     */
    public function edit(LanjutSahLaku $lanjutsahlaku)
    {
        return view(
            'backend.auth.template.lanjut_sahlaku.edit',
            [
                'data' => $lanjutsahlaku,
            ]
        );
    }

    /**
     * Update lanjutsahlaku
     *
     * @param UpdateLanjutSahLakuRequest $request       comment about this variable
     * @param LanjutSahLaku              $lanjutsahlaku comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateLanjutSahLakuRequest $request, LanjutSahLaku $lanjutsahlaku)
    {

        $this->lanjutsahlakuService->update($lanjutsahlaku, $request->validated());

        return redirect()->route('admin.auth.sahlaku.index', $lanjutsahlaku)->withFlashSuccess(__('Maklumat lanjut sah laku telah berjaya dikemaskini.'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatesahlaku()
    {
        $filename = 'Template Surat Mohon Lanjut SahLaku Tender.pdf';

        $header = HeaderSurat::first();
        $data = LanjutSahLaku::first();

        $jabatan = explode("(", $header->jabatan);
        $jabatanBM = $jabatan[0];
        $jabatanEN = '(' . $jabatan[1];

        $kementerian = explode("(", $header->kementerian);
        $kementerianBM = $kementerian[0];
        $kementerianEN = '(' . $kementerian[1];

        $alamat = preg_split("/\,/", $header->alamat);

        $moto = preg_split("/\n/", $data->moto);

        $info_pengarah = Tandatangan::first();

        $alamat1 = preg_split("/\n/", $data->alamat);

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
                'tajuk' => $data->tajuk,
                'alamat1' => $alamat1,
                'up' => $data->up,
                'text_1' => $data->text_1,
                'text_2' => $data->text_2,
                'moto' => $moto,
                'sym' => $data->sym,
                'nama' => $info_pengarah->nama,
                'jawatan' => $info_pengarah->jawatan,
                'nama_pelulus' => $data->nama,
                'jawatan_pelulus' => $data->jawatan,
                'kementerian_pelulus' => $data->kementerian,
        ];

        setlocale(LC_TIME, 'ms_MY Malay ');
        $cur_month = strtoupper(date('F Y'));

        $ruj = '<label style="font-size:11px; font-family: Arial;">Rujukan:  (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) ' . $data['rujukan'] .' </label><br>';
        $date = '<label style="font-size:11px; font-family: Arial;">Tarikh &nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . date('F Y') .' </label><br>';

        $view = \View::make('pdf_tem_suratSahLanjut', $data);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Template Surat Mohon Lanjut SahLaku Tender');
        $pdf::SetMargins(20, 10, 15, true); //left bottom right
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::writeHTMLCell(0, 0, 130, -250, $ruj); //width  height x y
        $pdf::writeHTMLCell(0, 0, 130, -245, $date);

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
