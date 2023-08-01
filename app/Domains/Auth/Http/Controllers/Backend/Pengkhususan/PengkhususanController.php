<?php
/**
 * PengkhususanController File.
 *
 * PHP Version 8.0
 *
 * @category PengkhususanController
 * @package  PengkhususanController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\Pengkhususan;

use Illuminate\Http\Request;
use Modules\Sisdant\Models\Pengkhususan;
use Modules\Sisdant\Models\Kelas;

/**
 * Class PengkhususanController.
 *
 * @category PengkhususanController
 * @package  PengkhususanController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class PengkhususanController
{

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.subBidang.index');
    }

    /**
     * Create Sub Bidang
     *
     * @param Kelas $kelas comment about this variable
     *
     * @return mixed
     */
    public function create(Kelas $kelas)
    {
        return view('backend.auth.pengkhususan.create')
            ->withKelas($kelas);
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
        $kelas = Kelas::where('id', $request->kelas_id)->first();
        $kod = $kelas->kod.$request->kod;
        $search = Pengkhususan::where('kod', $kod)->first();
        if ($search) {
            return redirect()->route('admin.auth.kelas.edit', $request->kelas_id)->withFlashDanger(__('Kod Pengkhususan telah Wujud'));
        } else {
            $pengkhususan = new Pengkhususan;
            $pengkhususan -> kod = $kod;
            $pengkhususan -> pengkhususan = $request->pengkhususan;
            $pengkhususan -> kelas_id = $request->kelas_id;
            $pengkhususan -> save();

            return redirect()->route('admin.auth.kelas.edit', $request->kelas_id)->withFlashSuccess(__('Pengkhususan berjaya ditambah.'));
        }
    }

    /**
     * Update Sub Bidang
     *
     * @param Request      $request      comment about this variable
     * @param Pengkhususan $pengkhususan comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request, Pengkhususan $pengkhususan)
    {
        Pengkhususan::where('id', $pengkhususan->id) -> update(
            [
            'pengkhususan' => $request->pengkhususan,
            ]
        );
        return redirect()->route('admin.auth.kelas.edit', $pengkhususan->kelas_id)->withFlashSuccess(__('Pengkhususan berjaya dikemaskini.'));
    }

    /**
     * Edit Sub Bidang
     *
     * @param Pengkhususan $pengkhususan comment about this variable
     *
     * @return mixed
     */
    public function edit(Pengkhususan $pengkhususan)
    {
        $kelas = Kelas::where('id', $pengkhususan->kelas_id)->first();

        return view('backend.auth.pengkhususan.edit')
            ->withPengkhususan($pengkhususan)
            ->withKelas($kelas);
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
        $Pengkhususan = Pengkhususan::where('id', $id)->first();
        Pengkhususan::where('id', $id)->delete();

        return redirect()->back()->withFlashSuccess(__('Pengkhususan berjaya dipadam.'));
    }

}
