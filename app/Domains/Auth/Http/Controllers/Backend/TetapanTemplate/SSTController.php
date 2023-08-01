<?php
/**
 * SSTController File.
 *
 * PHP Version 8.0
 *
 * @category SSTController
 * @package  SSTController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate;

use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\Template\UpdateSSTRequest;
use App\Http\Controllers\Controller;
use App\Models\TemplatSST;
use Carbon\Carbon;

/**
 * Class SSTController.
 *
 * @category SSTController
 * @package  SSTController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SSTController extends Controller
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = TemplatSST::first();
        return view('backend.auth.template.sst.index', ['data' => $data,]);
    }

    /**
     * Update templat sst
     *
     * @param UpdateSSTRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateSSTRequest $request)
    {
        $template = TemplatSST::first();

        $name = $request->file('path')->getClientOriginalName();
        $tarikh_file = Carbon::now()->format('ymd_His');
        $explode_name = explode('.', $name);

        $nama_fail = '';
        for ($i=0; $i < count($explode_name)-1; $i++) {
            $nama_fail .= $explode_name[$i];
        }

        $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];

        if ($template) {
            TemplatSST::where('id', $template->id) -> update(
                [
                'name'=> $name,
                'path' => '/storage/tetapanTemplate/'.$name,
                ]
            );
        } else {

            $template = new TemplatSST;
            $template->name = $name;
            $template->path = '/storage/tetapanTemplate/'.$name;
            $template->save();
        }

        $request->file('path')->move(storage_path().'/app/public/tetapanTemplate', $name);

        return redirect()->route('admin.auth.sst.index')->withFlashSuccess(__('Template Borang SST telah berjaya disimpan.'));
    }

}
