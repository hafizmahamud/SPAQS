<?php
/**
 * SelesaiTugasController File.
 *
 * PHP Version 8.0
 *
 * @category SelesaiTugasController
 * @package  SelesaiTugasController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate;

use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\Template\UpdateSelesaiTugasRequest;
use App\Http\Controllers\Controller;
use App\Models\SelesaiTugas;
use App\Domains\Auth\Services\SelesaiTugasService;
use App\Models\Tandatangan;
use Elibyy\TCPDF\Facades\TCPDF;

/**
 * Class SelesaiTugasController.
 *
 * @category SelesaiTugasController
 * @package  SelesaiTugasController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SelesaiTugasController extends Controller
{
    /**
     * SelesaiTugasController service.
     *
     * @var SelesaiTugasService
     */
    protected $SelesaiTugasService;

    /**
     * SelesaiTugasController constructor.
     *
     * @param SelesaiTugasService $selesaitugasService comment about this variable
     */
    public function __construct(SelesaiTugasService $selesaitugasService)
    {
        $this->selesaitugasService = $selesaitugasService;
    }

    /**
     * Index
     *
     * @param SelesaiTugas $selesaitugas comment about this variable
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SelesaiTugas $selesaitugas)
    {
        $data = SelesaiTugas::first();
        return view('backend.auth.template.selesai_tugas.index', ['data' => $data,]);
    }

    /**
     * Function edit
     *
     * @param SelesaiTugas $selesaitugas comment about this variable
     *
     * @return mixed
     */
    public function edit(SelesaiTugas $selesaitugas)
    {
        return view(
            'backend.auth.template.selesai_tugas.edit',
            [
                'data' => $selesaitugas,
            ]
        );
    }

    /**
     * Update pelantikan
     *
     * @param UpdateSelesaiTugasRequest $request      comment about this variable
     * @param SelesaiTugas              $selesaitugas comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateSelesaiTugasRequest $request, SelesaiTugas $selesaitugas)
    {

        $this->selesaitugasService->update($selesaitugas, $request->validated());

        return redirect()->route('admin.auth.selesaitugas.index', $selesaitugas)->withFlashSuccess(__('Maklumat surat akuan selesai tugas telah berjaya dikemaskini.'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateselesaitugas()
    {
        $filename = 'Template Surat Selesai Tugas.pdf';

        $data = SelesaiTugas::first();

        $info_pengarah = Tandatangan::first();

        $data = [
                'tajuk' => $data->tajuk,
                'pengenalan' => $data->text_1,
                'isi1' => $data->text_2,
                'isi2' => $data->text_3,
                'isi3' => $data->text_4,
                'isi4' => $data->text_5,
                'isi5' => $data->text_6,
                'isi6' => $data->text_7,
                'nama' => $info_pengarah->nama,
        ];

        $view = \View::make('pdf_tem_selesaitugas', $data);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Template Surat Selesai Tugas');
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
