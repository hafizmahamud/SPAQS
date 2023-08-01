<?php
/**
 * BidangController File.
 *
 * PHP Version 8.0
 *
 * @category BidangController
 * @package  BidangController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\Bidang;

use Illuminate\Http\Request;
use Modules\Sisdant\Models\Bidang;

/**
 * Class BidangController.
 *
 * @category BidangController
 * @package  BidangController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BidangController
{

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.bidang.index');
    }

    /**
     * Create Kod Bidang
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.bidang.create');
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
        $search = Bidang::where('kod', $request->kod)->first();
        if ($search) {
            return redirect()->route('admin.auth.bidang.index')->withFlashDanger(__('Kod Bidang telah Wujud'));
        } else {
            $maxId = Bidang::max('id');
            $bidang = new Bidang;
            $bidang -> id = $maxId + 1;
            $bidang -> kod = $request->kod;
            $bidang -> bidang = $request->bidang;
            $bidang -> save();

            return redirect()->route('admin.auth.bidang.index')->withFlashSuccess(__('Kod Bidang berjaya ditambah.'));
        }
    }

        /**
         * Show user
         *
         * @param Bidang $bidang comment about this variable
         *
         * @return mixed
         */
    public function show(Bidang $bidang)
    {
        return view('backend.auth.bidang.show')
            ->withBidang($bidang);
    }

    /**
     * Update user
     *
     * @param Request $request comment about this variable
     * @param Bidang  $bidang  comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request, Bidang $bidang)
    {
        Bidang::where('id', $bidang->id) -> update(
            [
            'bidang' => $request->bidang,
            ]
        );
        return redirect()->route('admin.auth.bidang.index')->withFlashSuccess(__('Kod Bidang berjaya dikemaskini.'));
    }

    /**
     * Edit user
     *
     * @param Bidang $bidang comment about this variable
     *
     * @return mixed
     */
    public function edit(Bidang $bidang)
    {
        return view('backend.auth.bidang.edit')
            ->withBidang($bidang);
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
        Bidang::where('id', $id)->delete();

        return redirect()->back()->withFlashSuccess(__('Kod Bidang berjaya dipadam.'));
    }


}
