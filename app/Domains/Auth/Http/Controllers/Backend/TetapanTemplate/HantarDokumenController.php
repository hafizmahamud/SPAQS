<?php
/**
 * HantarDokumenController File.
 *
 * PHP Version 8.0
 *
 * @category HantarDokumenController
 * @package  HantarDokumenController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate;

use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\Template\UpdateHantarDokumenRequest;
use App\Http\Controllers\Controller;
use App\Models\HantarDokumen;
use App\Domains\Auth\Services\HantarDokumenService;
use App\Models\Tandatangan;
use App\Models\HeaderSurat;
use Elibyy\TCPDF\Facades\TCPDF;

/**
 * Class HantarDokumenController.
 *
 * @category HantarDokumenController
 * @package  HantarDokumenController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class HantarDokumenController extends Controller
{
    /**
     * HantarDokumenController service.
     *
     * @var HantarDokumenService
     */
    protected $HantarDokumenService;

    /**
     * HantarDokumenController constructor.
     *
     * @param HantarDokumenService $hantardokumenService comment about this variable
     */
    public function __construct(HantarDokumenService $hantardokumenService)
    {
        $this->hantardokumenService = $hantardokumenService;
    }

    /**
     * Index
     *
     * @param HantarDokumen $hantardokumen comment about this variable
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(HantarDokumen $hantardokumen)
    {
        $data = HantarDokumen::first();
        return view('backend.auth.template.hantar_dokumen.index', ['data' => $data,]);
    }

    /**
     * Function edit
     *
     * @param HantarDokumen $hantardokumen comment about this variable
     *
     * @return mixed
     */
    public function edit(HantarDokumen $hantardokumen)
    {
        return view(
            'backend.auth.template.hantar_dokumen.edit',
            [
                'data' => $hantardokumen,
            ]
        );
    }

    /**
     * Update hantardokumen
     *
     * @param UpdateHantarDokumenRequest $request       comment about this variable
     * @param HantarDokumen              $hantardokumen comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateHantarDokumenRequest $request, HantarDokumen $hantardokumen)
    {

        $this->hantardokumenService->update($hantardokumen, $request->validated());

        return redirect()->route('admin.auth.hantardokumen.index', $hantardokumen)->withFlashSuccess(__('Maklumat hantar borang selesai tugas telah berjaya dikemaskini.'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatehantardokumen()
    {
        $filename = 'Template Surat Hantar Dokumen Ke KASA.pdf';

        $header = HeaderSurat::first();
        $data = HantarDokumen::first();

        $jabatan = explode("(", $header->jabatan);
        $jabatanBM = $jabatan[0];
        $jabatanEN = '(' . $jabatan[1];

        $kementerian = explode("(", $header->kementerian);
        $kementerianBM = $kementerian[0];
        $kementerianEN = '(' . $kementerian[1];

        $alamat = preg_split("/\,/", $header->alamat);

        $moto = preg_split("/\n/", $data->moto);

        $info_pengarah = Tandatangan::first();

        $add_SU = preg_split("/\n/", $data->alamat);

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
                'add_SU' => $add_SU,
                'up' => $data->up,
                'title' => $data->title,
                'tajuk' => $data->tajuk,
                'text_1' => $data->text_1,
                'text_2' => $data->text_2,
                'text_3' => $data->text_3,
                'tarikh' => date('F Y'),
                'moto' => $moto,
                'sym' => $data->sym,
                'nama' => $info_pengarah->nama,
                'jawatan' => $info_pengarah->jawatan,
                'tanda_tangan' => config('app.url'). $info_pengarah->path_tandatangan,
        ];

        $ruj = '<label style="font-size:11px; font-family: Arial;">(&nbsp;&nbsp;&nbsp;&nbsp;) ' . $data['rujukan'] .' </label><br>';
        $date = '<label style="font-size:11px; font-family: Arial;">' . date('F Y') .' </label><br>';

        $view = \View::make('pdf_tem_hantardokumen', $data);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Template Surat Hantar Dokumen Ke KASA');
        $pdf::SetMargins(20, 10, 15, true); //left bottom right
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::writeHTMLCell(0, 0, 145, -250, $ruj); //width  height x y
        $pdf::writeHTMLCell(0, 0, 173, -245, $date);


        $lampiran = '<label style="font-size:11px; font-family: Arial; color: grey;">LAMPIRAN A</label><br>';
        $today = '<label style="font-size:11px; font-family: Arial; color: grey;">' . date('d.m.Y') .' </label><br>';

        $view_borang = \View::make('pdf_tem_kertaspertimbangan', $data);
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
            mkdir(base_path('/storage/app/public/tetapanTemplate/download'));
        } catch (\Throwable $th) {
            //throw $th;
        }
        $path = storage_path().'/app/public/tetapanTemplate/download/';

        $pdf::Output($path . $filename, 'F');

        return response()->download($path . $filename);
    }
}
