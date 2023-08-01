<?php
/**
 * AlamatController File.
 *
 * PHP Version 8.0
 *
 * @category AlamatController
 * @package  AlamatController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanSistem;

use App\Domains\Auth\Http\Requests\Backend\Alamat\DeleteAlamatRequest;
use App\Domains\Auth\Http\Requests\Backend\Alamat\EditAlamatRequest;
use App\Domains\Auth\Http\Requests\Backend\Alamat\StoreAlamatRequest;
use App\Domains\Auth\Http\Requests\Backend\Alamat\UpdateAlamatRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SenaraiAlamat;
use App\Domains\Auth\Services\AlamatService;
/**
 * Class AlamatController.
 *
 * @category AlamatController
 * @package  AlamatController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AlamatController extends Controller
{
    /**
     * AlamatController service.
     *
     * @var AlamatService
     */
    protected $alamatService;

    /**
     * AlamatController constructor.
     *
     * @param AlamatService $alamatService comment about this variable
     */
    public function __construct(AlamatService $alamatService)
    {
        $this->alamatService = $alamatService;
    }


    //
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.auth.alamat.index');
    }

    /**
     * Create alamat
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.alamat.create');
    }

    /**
     * Store alamat
     *
     * @param StoreAlamatRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreAlamatRequest $request)
    {
        $alamat = $this->alamatService->store($request->validated());

        return redirect()->route('admin.auth.alamat.index', $alamat)->withFlashSuccess(__('Alamat telah berjaya ditambah'));
    }

    /**
     * Show alamat
     *
     * @param SenaraiAlamat $alamat comment about this variable
     *
     * @return mixed
     */
    public function show(SenaraiAlamat $alamat)
    {
        return view('backend.auth.alamat.show');
    }

    /**
     * Function edit
     *
     * @param SenaraiAlamat $alamat comment about this variable
     *
     * @return mixed
     */
    public function edit(SenaraiAlamat $alamat)
    {
        return view(
            'backend.auth.alamat.edit',
            [
                'alamat' => $alamat,
            ]
        );
    }

    /**
     * Update alamat
     *
     * @param UpdateAlamatRequest $request comment about this variable
     * @param Alamat              $alamat  comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateAlamatRequest $request, SenaraiAlamat $alamat)
    {
        $this->alamatService->update($alamat, $request->validated());

        return redirect()->route('admin.auth.alamat.edit', $alamat)->withFlashSuccess(__('Alamat telah berjaya dikemaskini.'));
    }

    /**
     * Destroy alamat
     *
     * @param DeleteAlamatRequest $id comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function delete($id)
    {
        SenaraiAlamat::where('id', $id)->delete();

        return redirect()->route('admin.auth.alamat.index')->withFlashSuccess(__('Alamat telah dihapuskan.'));
    }
}
