<?php
/**
 * KategoriIklanController File.
 *
 * PHP Version 8.0
 *
 * @category JenisKategoriIklanController
 * @package  KategoriIklanController
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\Iklan;
use Modules\Sisdant\Models\KategoriPerolehan;
use App\Domains\Auth\Services\KategoriPerolehanService;
use App\Domains\Auth\Http\Requests\Backend\Iklan\UpdateKategoriPerolehanRequest;
use App\Domains\Auth\Http\Requests\Backend\Iklan\StoreKategoriPerolehanRequest;


/**
 * Class KategoriIklanController.
 *
 * @category KategoriIklanController
 * @package  KategoriIklanController
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class KategoriIklanController
{
    /**
     * KategoriIklan service
     *
     * @var KategoriPerolehanService
     */
    protected $kategoriPerolehanService;


    /**
     * JenisIklanController constructor.
     *
     * @param KategoriPerolehanService $kategoriPerolehanService comment about this variable
     */
    public function __construct(KategoriPerolehanService $kategoriPerolehanService)
    {
        $this->kategoriPerolehanService = $kategoriPerolehanService;
    }

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.iklan.kategori_iklan.index');
    }

    /**
     * Create kategori iklan
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.iklan.kategori_iklan.create')
            ->withRoles($this->kategoriPerolehanService->get());

    }

    /**
     * Store kategori iklan
     *
     * @param StoreJenisIklanRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function simpanKategoriPerolehan(StoreKategoriPerolehanRequest $request)
    {
        $search = KategoriPerolehan::where('nama', $request->nama)->first();
        if ($search) {
            return redirect()->route('admin.auth.iklan.kategori_iklan')->withFlashDanger(__('Rekod Kategori Iklan telah Wujud'));
        } else {
            $this->kategoriPerolehanService->store($request->validated());
            return redirect()->route('admin.auth.iklan.kategori_iklan')->withFlashSuccess(__('Kategori Perolehan berjaya di tambah'));
        }
    }

    /**
     * Edit kategoriPerolehan
     *
     * @param KategoriPerolehan $kategoriPerolehan comment about this variable
     *
     * @return mixed
     */
    public function edit(KategoriPerolehan $kategoriPerolehan)
    {
        return view('backend.auth.iklan.kategori_iklan.edit', [ 'kategoriPerolehan' => $kategoriPerolehan ]);
    }

    /**
     * Update kategori perolehan
     *
     * @param UpdateKategoriPerolehanRequest $request           comment about this variable
     * @param KategoriPerolehan              $kategoriPerolehan comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function updateKategoriPerolehan(UpdateKategoriPerolehanRequest $request, KategoriPerolehan $kategoriPerolehan)
    {
        $this->kategoriPerolehanService->update($kategoriPerolehan, $request->validated());

        return redirect()->route('admin.auth.iklan.kategori_iklan')->withFlashSuccess(__('Kategori Perolehan telah dikemaskini'));
    }

    /**
     * Delete kategori_iklan
     *
     * @param id $id comment about this variable
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        KategoriPerolehan::where('id', $id)->delete();

        return redirect()->route('admin.auth.iklan.kategori_iklan')->withFlashSuccess(__('Kategori Perolehan telah dipadam.'));

    }

}
