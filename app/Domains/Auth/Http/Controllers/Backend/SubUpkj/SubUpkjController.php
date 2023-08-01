<?php
/**
 * SubBidangController File.
 *
 * PHP Version 8.0
 *
 * @category SubUpkjController
 * @package  SubUpkjController
 * @author   Faris <faris@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\SubUpkj;

use Illuminate\Http\Request;
use Modules\Sisdant\Models\KelasUpkj;
use Modules\Sisdant\Models\SubKelasUpkj;

/**
 * Class SubBidangController.
 *
 * @category SubUpkjController
 * @package  SubUpkjController
 * @author   Faris <faris@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SubUpkjController
{
    /**
     * Create Sub Upkj
     *
     * @param KelasUpkj $upkj comment about this variable
     *
     * @return mixed
     */
    public function create(KelasUpkj $upkj)
    {
        return view('backend.auth.subUpkj.create')
            ->withUpkj($upkj);
    }

    /**
     * Store Sub Upkj
     *
     * @param Request $request comment about this variable
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $search = SubKelasUpkj::where('tajuk_kecil', $request->tajuk_kecil)->first();
        if ($search) {
            return redirect()->route('admin.auth.upkj.subupkj', $request->upkj_id)->withFlashDanger(__('Tajuk Kecil Sub UPKJ Telah Wujud'));
        } else {
            $maxId = SubKelasUpkj::max('id');
            $subUpkj = new SubKelasUpkj;
            $subUpkj -> id = $maxId + 1;
            $subUpkj -> tajuk_kecil = $request->tajuk_kecil;
            $subUpkj -> keterangan = $request->keterangan;
            $subUpkj -> tajuk_id = $request->upkj_id;
            $subUpkj -> save();

            return redirect()->route('admin.auth.upkj.subupkj', $request->upkj_id)->withFlashSuccess('Sub UPKJ Berjaya Ditambah.');
        }
    }

    /**
     * Update Sub Upkj
     *
     * @param Request      $request comment about this variable
     * @param SubKelasUpkj $subUpkj comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request, SubKelasUpkj $subUpkj)
    {
        SubKelasUpkj::where('id', $subUpkj->id) -> update(
            [
            'keterangan' => $request->keterangan,
            ]
        );
        return redirect()->route('admin.auth.upkj.subupkj', $subUpkj->tajuk_id)->withFlashSuccess(__('Sub UPKJ berjaya dikemaskini.'));
    }

    /**
     * Edit Sub Bidang
     *
     * @param SubKelasUpkj $subUpkj comment about this variable
     *
     * @return mixed
     */
    public function edit(SubKelasUpkj $subUpkj)
    {
        $upkj = KelasUpkj::where('id', $subUpkj->tajuk_id)->first();

        return view('backend.auth.subUpkj.edit')
            ->withSubUpkj($subUpkj)
            ->withUpkj($upkj);
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
        SubKelasUpkj::where('id', $id)->delete();

        return redirect()->back()->withFlashSuccess(__('Sub UPKJ berjaya dipadam.'));
    }

}
