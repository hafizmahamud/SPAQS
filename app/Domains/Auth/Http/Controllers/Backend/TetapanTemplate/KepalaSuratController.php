<?php
/**
 * KepalaSuratController File.
 *
 * PHP Version 8.0
 *
 * @category KepalaSuratController
 * @package  KepalaSuratController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate;

use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\Template\UpdateKepalaSuratRequest;
use App\Http\Controllers\Controller;
use App\Models\HeaderSurat;
use App\Domains\Auth\Services\KepalaSuratService;
use Carbon\Carbon;

/**
 * Class KepalaSuratController.
 *
 * @category KepalaSuratController
 * @package  KepalaSuratController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class KepalaSuratController extends Controller
{
    /**
     * KepalaSuratController service.
     *
     * @var KepalaSuratService
     */
    protected $KepalaSuratService;

    /**
     * KepalaSuratController constructor.
     *
     * @param KepalaSuratService $kepalasuratService comment about this variable
     */
    public function __construct(KepalaSuratService $kepalasuratService)
    {
        $this->kepalasuratService = $kepalasuratService;
    }

    /**
     * Index
     *
     * @param HeaderSurat $headersurat comment about this variable
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(HeaderSurat $headersurat)
    {
        $data = HeaderSurat::first();
        $jata_negara = config('app.url'). $data->path_jata_negara;
        $img_memo = config('app.url'). $data->path_img_memo;
        return view('backend.auth.template.kepala_surat.index', ['data' => $data, 'jata_negara' => $jata_negara, 'img_memo' => $img_memo,]);
    }

    /**
     * Function edit
     *
     * @param HeaderSurat $headersurat comment about this variable
     *
     * @return mixed
     */
    public function edit(HeaderSurat $headersurat)
    {
        $jata_negara = config('app.url'). $headersurat->path_jata_negara;
        $img_memo = config('app.url'). $headersurat->path_img_memo;
        return view(
            'backend.auth.template.kepala_surat.edit',
            [
                'data' => $headersurat,
                'jata_negara' => $jata_negara,
                'img_memo' => $img_memo,
            ]
        );
    }

    /**
     * Update headersurat
     *
     * @param UpdateKepalaSuratRequest $request     comment about this variable
     * @param HeaderSurat              $headersurat comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateKepalaSuratRequest $request, HeaderSurat $headersurat)
    {
        foreach ($request->files as $file) {
            $name = $file->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $file->move(storage_path().'/app/public/tetapanTemplate', $name);
        }

        $this->kepalasuratService->update($headersurat, $request->validated());

        return redirect()->route('admin.auth.kepalasurat.index', $headersurat)->withFlashSuccess(__('Maklumat kepala memo/surat telah berjaya dikemaskini.'));
    }

}
