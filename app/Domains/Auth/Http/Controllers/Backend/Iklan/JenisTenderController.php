<?php
/**
 * JenisTenderController File.
 *
 * PHP Version 8.0
 *
 * @category JenisTenderController
 * @package  JenisTenderController
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\Iklan;
use Modules\Sisdant\Models\JenisTender;
use App\Domains\Auth\Services\JenisTenderService;
use App\Domains\Auth\Http\Requests\Backend\Iklan\UpdateJenisTenderRequest;
use App\Domains\Auth\Http\Requests\Backend\Iklan\StoreJenisTenderRequest;


/**
 * Class JenisTenderController.
 *
 * @category JenisTenderController
 * @package  JenisTenderController
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class JenisTenderController
{
    /**
     * JenisTender service
     *
     * @var JenisTenderService
     */
    protected $jenisTenderService;


    /**
     * JenisTenderController constructor.
     *
     * @param JenisTenderService $jenisTenderService comment about this variable
     */
    public function __construct(JenisTenderService $jenisTenderService)
    {
        $this->jenisTenderService = $jenisTenderService;
    }

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.iklan.jenis_tender.index');
    }

    /**
     * Create jenis tender
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.iklan.jenis_tender.create')
            ->withRoles($this->jenisTenderService->get());

    }

    /**
     * Store jenis tender
     *
     * @param StoreJenisTenderRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreJenisTenderRequest $request)
    {
        $search = JenisTender::where('nama', $request->nama)->first();
        if ($search) {
            return redirect()->route('admin.auth.iklan.jenis_tender')->withFlashDanger(__('Rekod Jenis Perolehan telah Wujud'));
        } else {
            $this->jenisTenderService->store($request->validated());
            return redirect()->route('admin.auth.iklan.jenis_tender')->withFlashSuccess(__('Jenis Perolehan berjaya di tambah'));
        }
    }

    /**
     * Edit jenisTender
     *
     * @param JenisTender $jenisTender comment about this variable
     *
     * @return mixed
     */
    public function edit(JenisTender $jenisTender)
    {
        return view('backend.auth.iklan.jenis_tender.edit', [ 'jenisTender' => $jenisTender ]);
    }

    /**
     * Update jenis tender
     *
     * @param UpdateJenisTenderRequest $request     comment about this variable
     * @param JenisTender              $jenisTender comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function updateJenisTender(UpdateJenisTenderRequest $request, JenisTender $jenisTender)
    {
        $this->jenisTenderService->update($jenisTender, $request->validated());

        return redirect()->route('admin.auth.iklan.jenis_tender')->withFlashSuccess(__('Jenis Perolehan telah dikemaskini'));
    }

    /**
     * Delete jenistender
     *
     * @param id $id comment about this variable
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        JenisTender::where('id', $id)->delete();

        return redirect()->route('admin.auth.iklan.jenis_tender')->withFlashSuccess(__('Jenis Perolehan telah dipadam.'));

    }

}
