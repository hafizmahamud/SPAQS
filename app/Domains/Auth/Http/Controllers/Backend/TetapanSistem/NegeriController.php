<?php
/**
 * NegeriController File.
 *
 * PHP Version 8.0
 *
 * @category NegeriController
 * @package  NegeriController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanSistem;

use App\Domains\Auth\Http\Requests\Backend\Negeri\DeleteNegeriRequest;
use App\Domains\Auth\Http\Requests\Backend\Negeri\EditNegeriRequest;
use App\Domains\Auth\Http\Requests\Backend\Negeri\StoreNegeriRequest;
use App\Domains\Auth\Http\Requests\Backend\Negeri\UpdateNegeriRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Negeri;
use App\Domains\Auth\Services\NegeriService;
use App\Domains\Auth\Services\BahagianService;
use DB;
/**
 * Class NegeriController.
 *
 * @category NegeriController
 * @package  NegeriController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class NegeriController extends Controller
{
    /**
     * NegeriController service.
     *
     * @var NegeriService
     */
    protected $negeriService;

    /**
     * NegeriController constructor.
     *
     * @param NegeriService $negeriService comment about this variable
     */
    public function __construct(NegeriService $negeriService)
    {
        $this->negeriService = $negeriService;
    }


    //
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.auth.negeri.index');
    }

    //
    /**
     * Function to getBahagian
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getBahagian()
    {
        $negeri = Negeri::get();
        $data = DB::table('pejabat')->select('bahagian')->join($negeri->id, '=', 'pejabat.negeri_id')->get();

        return response()->json([$data]);
    }

    /**
     * Create user
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.negeri.create');
    }

    /**
     * Store negeri
     *
     * @param StoreNegeriRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreNegeriRequest $request)
    {
        $negeri = $this->negeriService->store($request->validated());

        return redirect()->route('admin.auth.negeri.index', $negeri)->withFlashSuccess(__('Pejabat JPS telah berjaya ditambah'));
    }

    /**
     * Edit Negeri
     *
     * @param Negeri $negeri comment about this variable
     *
     * @return mixed
     */
    public function edit(Negeri $negeri)
    {
        return view(
            'backend.auth.negeri.edit', [
                'negeri' => $negeri,
            ]
        );
    }

    /**
     * Update negeri
     *
     * @param UpdateNegeriRequest $request comment about this variable
     * @param Negeri              $negeri  comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateNegeriRequest $request, Negeri $negeri)
    {
        $this->negeriService->update($negeri, $request->validated());

        return redirect()->route('admin.auth.negeri.edit', $negeri)->withFlashSuccess(__('Negeri telah berjaya dikemaskini.'));
    }

    /**
     * Destroy negeri
     *
     * @param id $id comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function delete($id)
    {
        Negeri::where('id', $id)->delete();

        return redirect()->route('admin.auth.negeri.index')->withFlashSuccess(__('Negeri telah dihapuskan.'));
    }
}
