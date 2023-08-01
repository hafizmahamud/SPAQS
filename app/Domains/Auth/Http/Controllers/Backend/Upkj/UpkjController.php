<?php
/**
 * UpkjController File.
 *
 * PHP Version 8.0
 *
 * @category UpkjController
 * @package  UpkjController
 * @author   Faris <faris@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\Upkj;

use Illuminate\Http\Request;
use Modules\Sisdant\Models\KelasUpkj;

/**
 * Class UpkjController.
 *
 * @category UpkjController
 * @package  UpkjController
 * @author   Faris <faris@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UpkjController
{

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.upkj.index');
    }

    /**
     * Create Kod Bidang
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.upkj.create');
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
        $search = KelasUpkj::where('tajuk', $request->tajuk)->first();
        if ($search) {
            return redirect()->route('admin.auth.upkj.index')->withFlashDanger(__('Tajuk UPKJ telah Wujud'));
        } else {
            $maxId = KelasUpkj::max('id');
            $upkj = new KelasUpkj;
            $upkj -> id = $maxId + 1;
            $upkj -> tajuk = $request->tajuk;
            $upkj -> keterangan = $request->keterangan;
            $upkj -> save();

            return redirect()->route('admin.auth.upkj.index')->withFlashSuccess(__('Tajuk UPKJ berjaya ditambah.'));
        }
    }

    /**
     * Show user
     *
     * @param KelasUpkj $upkj comment about this variable
     *
     * @return mixed
     */
    public function show(KelasUpkj $upkj)
    {
        return view('backend.auth.upkj.show')
            ->withUpkj($upkj);
    }

    /**
     * Update user
     *
     * @param Request   $request comment about this variable
     * @param KelasUpkj $upkj    comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request, KelasUpkj $upkj)
    {
        KelasUpkj::where('id', $upkj->id) -> update(
            [
            'keterangan' => $request->keterangan,
            ]
        );
        return redirect()->route('admin.auth.upkj.index')->withFlashSuccess(__('Upkj berjaya dikemaskini.'));
    }

    /**
     * Edit user
     *
     * @param KelasUpkj $upkj comment about this variable
     *
     * @return mixed
     */
    public function subupkj(KelasUpkj $upkj)
    {
        return view('backend.auth.upkj.subupkj')
        ->withUpkj($upkj);
    }

     /**
      * Delete Kod Upkj
      *
      * @param id $id comment about this variable
      *
      * @return mixed
      */
    public function delete($id)
    {
        KelasUpkj::where('id', $id)->delete();

        return redirect()->back()->withFlashSuccess(__('Upkj berjaya dipadam.'));
    }


}
