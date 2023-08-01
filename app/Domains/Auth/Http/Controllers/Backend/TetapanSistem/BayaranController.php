<?php
/**
 * BayaranController File.
 *
 * PHP Version 8.0
 *
 * @category BayaranController
 * @package  BayaranController
 * @author   Nurul Syafina <syafina@plisca.com.my>
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
use Modules\Sisdant\Models\BayarKepada;

/**
 * Class BayaranController.
 *
 * @category BayaranController
 * @package  BayaranController
 * @author   Nurul Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BayaranController extends Controller
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.bayaran.index');
    }

    /**
     * Create Kod Bidang
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.bayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request comment about this variable
     *
     * @return Renderable
     */
    public function store(Request $request)
    {
            $bayaran = new BayarKepada;
            $bayaran -> nama = $request->nama;
            $bayaran -> save();

            return redirect()->route('admin.auth.bayaran.index')->withFlashSuccess(__('Bayaran Kepada berjaya ditambah.'));
    }

    /**
     * Update user
     *
     * @param Request     $request     comment about this variable
     * @param BayarKepada $bayarKepada comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request, BayarKepada $bayarKepada)
    {
        BayarKepada::where('id', $bayarKepada->id) -> update(
            [
            'nama'=> $request->nama,
            ]
        );
        return redirect()->route('admin.auth.bayaran.index')->withFlashSuccess(__('Bayaran Kepada berjaya dikemaskini.'));
    }

    /**
     * Edit user
     *
     * @param BayarKepada $bayarKepada comment about this variable
     *
     * @return mixed
     */
    public function edit(BayarKepada $bayarKepada)
    {
        return view('backend.auth.bayaran.edit')
            ->withBayarKepada($bayarKepada);
    }

     /**
      * Delete Kod Bidang
      *
      * @param id $id comment about this variable
      *
      * @return mixed
      */
    public function delete($id)
    {
        BayarKepada::where('id', $id)->delete();

        return redirect()->back()->withFlashSuccess(__('Bayaran Kepada berjaya dipadam.'));
    }
}
