<?php
/**
 * KelasController File.
 *
 * PHP Version 8.0
 *
 * @category KelasController
 * @package  KelasController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\Kelas;

use Illuminate\Http\Request;
use Modules\Sisdant\Models\Kelas;

/**
 * Class KelasController.
 *
 * @category KelasController
 * @package  KelasController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class KelasController
{

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.kelas.index');
    }

    /**
     * Create Kod Bidang
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.kelas.create');
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
        $search = Kelas::where('kod', $request->kod)->first();
        if ($search) {
            return redirect()->route('admin.auth.kelas.index')->withFlashDanger(__('Kod Kategori telah Wujud.'));
        } else {
            $maxId = Kelas::max('id');
            $kelas = new Kelas;
            $kelas -> id = $maxId + 1;
            $kelas -> kod = $request->kod;
            $kelas -> kelas = $request->kelas;
            $kelas -> save();

            return redirect()->route('admin.auth.kelas.index')->withFlashSuccess(__('Kategori berjaya ditambah.'));
        }
    }

    /**
     * Show user
     *
     * @param Kelas $kelas comment about this variable
     *
     * @return mixed
     */
    public function show(Kelas $kelas)
    {
        return view('backend.auth.kelas.show')
            ->withKelas($kelas);
    }

    /**
     * Update user
     *
     * @param Request $request comment about this variable
     * @param Kelas   $kelas   comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request, Kelas $kelas)
    {
        Kelas::where('id', $kelas->id) -> update(
            [
            'kelas' => $request->kelas,
            ]
        );
        return redirect()->route('admin.auth.kelas.index')->withFlashSuccess(__('Kategori berjaya dikemaskini.'));
    }

    /**
     * Edit user
     *
     * @param Kelas $kelas comment about this variable
     *
     * @return mixed
     */
    public function edit(Kelas $kelas)
    {
        return view('backend.auth.kelas.edit')
            ->withKelas($kelas);
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
        Kelas::where('id', $id)->delete();

        return redirect()->back()->withFlashSuccess(__('Kategori berjaya dipadam.'));
    }


}
