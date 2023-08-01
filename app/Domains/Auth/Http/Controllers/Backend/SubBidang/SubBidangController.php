<?php
/**
 * SubBidangController File.
 *
 * PHP Version 8.0
 *
 * @category SubBidangController
 * @package  SubBidangController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\SubBidang;

use Illuminate\Http\Request;
use Modules\Sisdant\Models\SubBidang;
use Modules\Sisdant\Models\Bidang;

/**
 * Class SubBidangController.
 *
 * @category SubBidangController
 * @package  SubBidangController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SubBidangController
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
     * @param Bidang $bidang comment about this variable
     *
     * @return mixed
     */
    public function create(Bidang $bidang)
    {
        return view('backend.auth.subBidang.create')
            ->withBidang($bidang);
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
        $bidang = Bidang::where('id', $request->bidang_id)->first();
        $kod = $bidang->kod.$request->kod;
        $search = SubBidang::where('kod', $kod)->first();
        if ($search) {
            return redirect()->route('admin.auth.bidang.edit', $request->bidang_id)->withFlashDanger(__('Kod Sub Bidang telah Wujud'));
        } else {
            $subBidang = new SubBidang;
            $subBidang -> kod = $kod;
            $subBidang -> sub_bidang = $request->subBidang;
            $subBidang -> bidang_id = $request->bidang_id;
            $subBidang -> save();

            return redirect()->route('admin.auth.bidang.edit', $request->bidang_id)->withFlashSuccess(__('Sub Bidang berjaya ditambah.'));
        }
    }

    /**
     * Update Sub Bidang
     *
     * @param Request   $request   comment about this variable
     * @param SubBidang $subBidang comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request, SubBidang $subBidang)
    {
        SubBidang::where('id', $subBidang->id) -> update(
            [
            'sub_bidang' => $request->sub_bidang,
            ]
        );
        return redirect()->route('admin.auth.bidang.edit', $subBidang->bidang_id)->withFlashSuccess(__('Sub Bidang berjaya dikemaskini.'));
    }

    /**
     * Edit Sub Bidang
     *
     * @param SubBidang $subBidang comment about this variable
     *
     * @return mixed
     */
    public function edit(SubBidang $subBidang)
    {
        $bidang = Bidang::where('id', $subBidang->bidang_id)->first();

        return view('backend.auth.subBidang.edit')
            ->withSubBidang($subBidang)
            ->withBidang($bidang);
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
        $SubBidang = SubBidang::where('id', $id)->first();
        SubBidang::where('id', $id)->delete();

        return redirect()->back()->withFlashSuccess(__('Sub Bidang berjaya dipadam.'));
    }

}
