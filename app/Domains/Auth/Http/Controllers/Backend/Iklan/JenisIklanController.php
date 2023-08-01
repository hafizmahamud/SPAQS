<?php
/**
 * JenisIklanController File.
 *
 * PHP Version 8.0
 *
 * @category JenisIklanController
 * @package  JenisIklanController
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\Iklan;
use App\Domains\Auth\Http\Requests\Backend\Iklan\StoreJenisIklanRequest;
use App\Domains\Auth\Http\Requests\Backend\Iklan\UpdateJenisIklanRequest;
use Modules\Sisdant\Models\JenisIklan;
use App\Domains\Auth\Services\JenisIklanService;

/**
 * Class JenisIklanController.
 *
 * @category JenisIklanController
 * @package  JenisIklanController
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class JenisIklanController
{
    /**
     * JenisIklan service
     *
     * @var JenisIklanService
     */
    protected $jenisIklanService;


    /**
     * JenisIklanController constructor.
     *
     * @param JenisIklanService $jenisIklanService comment about this variable
     */
    public function __construct(JenisIklanService $jenisIklanService)
    {
        $this->jenisIklanService = $jenisIklanService;
    }

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.iklan.jenis_iklan.index');
    }

    /**
     * Create jenis iklan
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.iklan.jenis_iklan.create')
            ->withRoles($this->jenisIklanService->get());

    }

    /**
     * Store jenis iklan
     *
     * @param StoreJenisIklanRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function simpanJenisIklan(StoreJenisIklanRequest $request)
    {
        $this->jenisIklanService->store($request->validated());

        return redirect()->route('admin.auth.iklan.jenis_iklan')->withFlashSuccess(__('Jenis Iklan berjaya di tambah'));
    }

    /**
     * Edit jenis iklan
     *
     * @param JenisIklan $jenisIklan comment about this variable
     *
     * @return mixed
     */
    public function edit(JenisIklan $jenisIklan)
    {
        return view('backend.auth.iklan.jenis_iklan.edit', [ 'jenisIklan' => $jenisIklan ]);
    }

    /**
     * Update jenisiklan
     *
     * @param UpdateJenisIklanRequest $request    comment about this variable
     * @param JenisIklan              $jenisIklan comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateJenisIklanRequest $request, JenisIklan $jenisIklan)
    {
        $this->jenisIklanService->update($jenisIklan, $request->validated());

        return redirect()->route('admin.auth.iklan.jenis_iklan')->withFlashSuccess(__('Jenis Iklan telah dikemaskini'));
    }

    /**
     * Delete jenisiklan
     *
     * @param id $id comment about this variable
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        JenisIklan::where('id', $id)->delete();

        return redirect()->route('admin.auth.iklan.jenis_iklan')->withFlashSuccess(__('Jenis Iklan telah dipadam.'));

    }

}
