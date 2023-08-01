<?php
/**
 * IklanController File.
 *
 * PHP Version 8.0
 *
 * @category IklanController
 * @package  IklanController
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\Iklan;
use Modules\Sisdant\Models\MatrikIklan;
use App\Domains\Auth\Services\MatrikIklanService;
use App\Domains\Auth\Http\Requests\Backend\Iklan\StoreMatrikIklanRequest;
use App\Domains\Auth\Http\Requests\Backend\Iklan\DeleteMatrikIklanRequest;
use App\Domains\Auth\Http\Requests\Backend\Iklan\UpdateMatrikIklanRequest;

/**
 * Class IklanController.
 *
 * @category IklanController
 * @package  IklanController
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class IklanController
{
    /**
     * MatrikIklanService service
     *
     * @var MatrikIklanService
     */
    protected $matrikIklanService;


    /**
     * IklanController constructor.
     *
     * @param MatrikIklanService $matrikIklanService comment about this variable
     */
    public function __construct(MatrikIklanService $matrikIklanService)
    {
        $this->matrikIklanService = $matrikIklanService;
    }

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.iklan.matrik_iklan.index');
    }

    /**
     * Create matrik iklan
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.iklan.matrik_iklan.create')
            ->withRoles($this->matrikIklanService->get());

    }

    /**
     * Store matrik iklan
     *
     * @param StoreMatrikIklanRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function simpan(StoreMatrikIklanRequest $request)
    {
        $search =  MatrikIklan::where('jenis_iklan_id', $request->jenis_iklan_id)
        ->where('kategori_perolehan_id', $request->kategori_perolehan_id)
        ->where('jenis_tender_id', $request->jenis_tender_id)
        ->where('upload_iklan', $request->upload_iklan)
        ->first();

        if ($search) {
            return redirect()->route('admin.auth.iklan.matrik_iklan')->withFlashDanger(__('Rekod Matrik Iklan telah Wujud'));
        } else {
            $this->matrikIklanService->store($request->validated());
            return redirect()->route('admin.auth.iklan.matrik_iklan')->withFlashSuccess(__('Matrik Iklan berjaya di tambah'));
        }
    }

    /**
     * Delete matrik_iklan
     *
     * @param id $id comment about this variable
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        MatrikIklan::where('id', $id)->delete();

        return redirect()->route('admin.auth.iklan.matrik_iklan')->withFlashSuccess(__('Matrik Iklan telah dipadam.'));

    }

    /**
     * Edit matrik iklan
     *
     * @param MatrikIklan $matrikIklan comment about this variable
     *
     * @return mixed
     */
    public function edit(MatrikIklan $matrikIklan)
    {
        return view('backend.auth.iklan.matrik_iklan.edit', [ 'matrikIklan' => $matrikIklan ]);
    }

    /**
     * Update jenisiklan
     *
     * @param UpdateMatrikIklanRequest $request     comment about this variable
     * @param MatrikIklan              $matrikIklan comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateMatrikIklanRequest $request, MatrikIklan $matrikIklan)
    {
        $this->matrikIklanService->update($matrikIklan, $request->validated());

        return redirect()->route('admin.auth.iklan.matrik_iklan')->withFlashSuccess(__('Matrik Iklan telah dikemaskini'));
    }

}
