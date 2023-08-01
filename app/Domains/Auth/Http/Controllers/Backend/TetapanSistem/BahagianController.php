<?php
/**
 * BahagianController File.
 *
 * PHP Version 8.0
 *
 * @category BahagianController
 * @package  BahagianController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanSistem;

use App\Domains\Auth\Http\Requests\Backend\Bahagian\DeleteBahagianRequest;
use App\Domains\Auth\Http\Requests\Backend\Bahagian\EditBahagianRequest;
use App\Domains\Auth\Http\Requests\Backend\Bahagian\StoreBahagianRequest;
use App\Domains\Auth\Http\Requests\Backend\Bahagian\UpdateBahagianRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pejabat;
use App\Models\Negeri;
use App\Domains\Auth\Services\BahagianService;
use Illuminate\Support\Facades\Route;

/**
 * Class BahagianController.
 *
 * @category BahagianController
 * @package  BahagianController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BahagianController extends Controller
{
    /**
     * BahagianController service.
     *
     * @var BahagianService
     */
    protected $BahagianService;

    /**
     * BahagianController constructor.
     *
     * @param BahagianService $bahagianService comment about this variable
     */
    public function __construct(BahagianService $bahagianService)
    {
        $this->bahagianService = $bahagianService;
    }


    //
    /**
     * Index
     *
     * @param Negeri $negeri comment about this variable
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Negeri $negeri)
    {
        return view('backend.auth.bahagian.index')
            ->withNegeri($negeri);
    }

    /**
     * Create user
     *
     * @param Negeri $negeri comment about this variable
     *
     * @return mixed
     */
    public function create(Negeri $negeri)
    {
        return view('backend.auth.bahagian.create')
            ->withNegeri($negeri);
    }

    /**
     * Store user
     *
     * @param StoreUserRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreBahagianRequest $request)
    {
        if (Pejabat::where('negeri_id', $request->negeri_id)->whereIn('singkatan', [$request->singkatan])->first()) {
            return redirect()->back()->withFlashDanger(__('Singkatan telah wujud untuk bahagian di dalam negeri ini'));
        } else {
            $bahagian = $this->bahagianService->store($request->validated());
            return redirect()->route('admin.auth.negeri.bahagian', $bahagian->negeri_id)->withFlashSuccess(__('Bahagian telah berjaya ditambah'));
        }

    }

    /**
     * Show user
     *
     * @param User $user comment about this variable
     *
     * @return mixed
     */
    public function show(User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }

    /**
     * Function edit
     *
     * @param Pejabat $bahagian comment about this variable
     *
     * @return mixed
     */
    public function edit(Pejabat $bahagian)
    {
        return view(
            'backend.auth.bahagian.edit', [
                'bahagian' => $bahagian,
            ]
        );
    }

    /**
     * Update Bahagian
     *
     * @param UpdateBahagianRequest $request  comment about this variable
     * @param Pejabat               $bahagian comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateBahagianRequest $request, Pejabat $bahagian)
    {
        $this->bahagianService->update($bahagian, $request->validated());

        return redirect()->route('admin.auth.bahagian.edit', $bahagian)->withFlashSuccess(__('Bahagian telah berjaya dikemaskini.'));
    }

    /**
     * Destroy Bahagian
     *
     * @param Pejabat $id comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function delete($id)
    {
        $bahagian = Pejabat::where('id', $id)->first();
        Pejabat::where('id', $id)->delete();

        return redirect()->route('admin.auth.negeri.bahagian', $bahagian->negeri_id)->withFlashSuccess(__('Bahagian telah dihapuskan.'));
    }
}
