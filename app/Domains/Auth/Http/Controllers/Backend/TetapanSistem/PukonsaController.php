<?php
/**
 * PukonsaController File.
 *
 * PHP Version 8.0
 *
 * @category PukonsaController
 * @package  PukonsaController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanSistem;

use Illuminate\Http\Request;
use Modules\Sisdant\Models\KelasPukonsa;

/**
 * Class PukonsaController.
 *
 * @category PukonsaController
 * @package  PukonsaController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class PukonsaController
{

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.pukonsa.index');
    }

    /**
     * Create KelasPukonsa
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.pukonsa.create');
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
        $search = KelasPukonsa::where('tajuk', $request->tajuk)->first();
        if ($search) {
            return redirect()->route('admin.auth.pukonsa.index')->withFlashDanger(__('Tajuk Kelas Pukonsa telah Wujud'));
        } else {
            $maxId = KelasPukonsa::max('id');
            $pukonsa = new KelasPukonsa;
            $pukonsa -> id = $maxId + 1;
            $pukonsa -> tajuk = $request->tajuk;
            $pukonsa -> keterangan = $request->keterangan;
            $pukonsa -> save();

            return redirect()->route('admin.auth.pukonsa.index')->withFlashSuccess(__('Kelas Pukonsa berjaya ditambah.'));
        }
    }

        /**
         * Show user
         *
         * @param KelasPukonsa $kelasPukonsa comment about this variable
         *
         * @return mixed
         */
    public function show(KelasPukonsa $kelasPukonsa)
    {
        return view('backend.auth.pukonsa.show')
            ->withKelasPukonsa($kelasPukonsa);
    }

    /**
     * Update user
     *
     * @param Request      $request      comment about this variable
     * @param KelasPukonsa $kelasPukonsa comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request, KelasPukonsa $kelasPukonsa)
    {
        KelasPukonsa::where('id', $kelasPukonsa->id) -> update(
            [
            'keterangan' => $request->keterangan,
            ]
        );
        return redirect()->route('admin.auth.pukonsa.index')->withFlashSuccess(__('Kelas Pukonsa berjaya dikemaskini.'));
    }

    /**
     * Edit user
     *
     * @param KelasPukonsa $kelasPukonsa comment about this variable
     *
     * @return mixed
     */
    public function edit(KelasPukonsa $kelasPukonsa)
    {
        return view('backend.auth.pukonsa.edit')
            ->withKelasPukonsa($kelasPukonsa);
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
        KelasPukonsa::where('id', $id)->delete();

        return redirect()->back()->withFlashSuccess(__('Kelas Pukonsa berjaya dipadam.'));
    }


}
