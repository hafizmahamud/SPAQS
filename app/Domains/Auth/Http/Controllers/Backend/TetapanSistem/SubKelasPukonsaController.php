<?php
/**
 * SubKelasPukonsaController File.
 *
 * PHP Version 8.0
 *
 * @category SubKelasPukonsaController
 * @package  SubKelasPukonsaController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanSistem;

use Illuminate\Http\Request;
use Modules\Sisdant\Models\SubKelasPukonsa;
use Modules\Sisdant\Models\KelasPukonsa;

/**
 * Class SubKelasPukonsaController.
 *
 * @category SubKelasPukonsaController
 * @package  SubKelasPukonsaController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SubKelasPukonsaController
{

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.subKelasPukonsa.index');
    }

    /**
     * Create Sub Kelas Pukonsa
     *
     * @param KelasPukonsa $kelasPukonsa comment about this variable
     *
     * @return mixed
     */
    public function create(KelasPukonsa $kelasPukonsa)
    {
        return view('backend.auth.subKelasPukonsa.create')
            ->withKelasPukonsa($kelasPukonsa);
    }

    /**
     * Store Sub Bidang
     *
     * @param Request $request comment about this variable
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $search = SubKelasPukonsa::where('tajuk_id', $request->pukonsa_id)->where('tajuk_kecil', $request->tajuk_kecil)->first();
        if ($search) {
            return redirect()->route('admin.auth.pukonsa.edit', $request->pukonsa_id)->withFlashDanger(__('Tajuk kecil Sub Kelas Pukonsa telah wujud'));
        } else {
            $maxId = SubKelasPukonsa::max('id');
            $subKelasPukonsa = new SubKelasPukonsa;
            $subKelasPukonsa -> id = $maxId + 1;
            $subKelasPukonsa -> tajuk_kecil = $request->tajuk_kecil;
            $subKelasPukonsa -> keterangan = $request->keterangan;
            $subKelasPukonsa -> tajuk_id = $request->pukonsa_id;
            $subKelasPukonsa -> save();

            return redirect()->route('admin.auth.pukonsa.edit', $request->pukonsa_id)->withFlashSuccess(__('Sub Kelas Pukonsa berjaya ditambah.'));
        }
    }

    /**
     * Update Sub Bidang
     *
     * @param Request         $request         comment about this variable
     * @param SubKelasPukonsa $subKelasPukonsa comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request, SubKelasPukonsa $subKelasPukonsa)
    {
        SubKelasPukonsa::where('id', $subKelasPukonsa->id) -> update(
            [
            'keterangan' => $request->keterangan,
            ]
        );
        return redirect()->route('admin.auth.pukonsa.edit', $subKelasPukonsa->tajuk_id)->withFlashSuccess(__('Sub Kelas Pukonsa berjaya dikemaskini.'));
    }

    /**
     * Edit Sub Bidang
     *
     * @param SubKelasPukonsa $subKelasPukonsa comment about this variable
     *
     * @return mixed
     */
    public function edit(SubKelasPukonsa $subKelasPukonsa)
    {
        $kelasPukonsa = KelasPukonsa::where('id', $subKelasPukonsa->tajuk_id)->first();

        return view('backend.auth.subKelasPukonsa.edit')
            ->withSubKelasPukonsa($subKelasPukonsa)
            ->withKelasPukonsa($kelasPukonsa);
    }

    /**
     * Delete Sub Bidang
     *
     * @param id $id comment about this variable
     *
     * @return mixed
     */
    public function delete($id)
    {
        SubKelasPukonsa::where('id', $id)->delete();

        return redirect()->back()->withFlashSuccess(__('Sub Bidang berjaya dipadam.'));
    }

}
