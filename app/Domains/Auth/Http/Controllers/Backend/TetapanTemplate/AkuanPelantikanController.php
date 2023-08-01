<?php
/**
 * AkuanPelantikanController File.
 *
 * PHP Version 8.0
 *
 * @category AkuanPelantikanController
 * @package  AkuanPelantikanController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate;

use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\Template\UpdateAkuanPelantikanRequest;
use App\Http\Controllers\Controller;
use App\Models\Pelantikan;
use App\Domains\Auth\Services\AkuanPelantikanService;
use App\Models\Tandatangan;
use Elibyy\TCPDF\Facades\TCPDF;

/**
 * Class AkuanPelantikanController.
 *
 * @category AkuanPelantikanController
 * @package  AkuanPelantikanController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AkuanPelantikanController extends Controller
{
    /**
     * AkuanPelantikanController service.
     *
     * @var InfoPengarahService
     */
    protected $AkuanPelantikanService;

    /**
     * AkuanPelantikanController constructor.
     *
     * @param AkuanPelantikanService $akuanpelantikanService comment about this variable
     */
    public function __construct(AkuanPelantikanService $akuanpelantikanService)
    {
        $this->akuanpelantikanService = $akuanpelantikanService;
    }

    /**
     * Index
     *
     * @param Pelantikan $pelantikan comment about this variable
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Pelantikan $pelantikan)
    {
        $data = Pelantikan::first();
        return view('backend.auth.template.akuan_pelantikan.index', ['data' => $data,]);
    }

    /**
     * Function edit
     *
     * @param Pelantikan $pelantikan comment about this variable
     *
     * @return mixed
     */
    public function edit(Pelantikan $pelantikan)
    {
        return view(
            'backend.auth.template.akuan_pelantikan.edit',
            [
                'data' => $pelantikan,
            ]
        );
    }

    /**
     * Update pelantikan
     *
     * @param UpdateAkuanPelantikanRequest $request    comment about this variable
     * @param Pelantikan                   $pelantikan comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateAkuanPelantikanRequest $request, Pelantikan $pelantikan)
    {

        $this->akuanpelantikanService->update($pelantikan, $request->validated());

        return redirect()->route('admin.auth.akuanpelantikan.index', $pelantikan)->withFlashSuccess(__('Maklumat surat akuan pelantikan telah berjaya dikemaskini.'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateakuanlantikan()
    {
        $filename = 'Template Surat Akuan Pelantikan.pdf';

        $data = Pelantikan::first();
        // dd($data);

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
                'isi7' => $data->text_8,
                'nama' => $info_pengarah->nama,
        ];

        $view = \View::make('pdf_tem_akuanlantikan', $data);
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Template Surat Akuan Pelantikan');
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
