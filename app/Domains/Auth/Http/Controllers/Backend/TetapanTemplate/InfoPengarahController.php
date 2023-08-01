<?php
/**
 * InfoPengarahController File.
 *
 * PHP Version 8.0
 *
 * @category InfoPengarahController
 * @package  InfoPengarahController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanTemplate;

use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\Template\UpdateInfoPengarahRequest;
use App\Http\Controllers\Controller;
use App\Models\Tandatangan;
use Carbon\Carbon;
use App\Domains\Auth\Services\InfoPengarahService;

/**
 * Class InfoPengarahController.
 *
 * @category InfoPengarahController
 * @package  InfoPengarahController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class InfoPengarahController extends Controller
{
    /**
     * InfoPengarahController service.
     *
     * @var InfoPengarahService
     */
    protected $InfoPengarahService;

    /**
     * InfoPengarahController constructor.
     *
     * @param InfoPengarahService $infopengarahService comment about this variable
     */
    public function __construct(InfoPengarahService $infopengarahService)
    {
        $this->infopengarahService = $infopengarahService;
    }

    /**
     * Index
     *
     * @param Tandatangan $tandatangan comment about this variable
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Tandatangan $tandatangan)
    {
        $data = Tandatangan::first();
        $tandatangan = config('app.url'). $data->path_tandatangan;
        return view('backend.auth.template.info_pengarah.index', ['data' => $data, 'tandatangan' => $tandatangan,]);
    }

    /**
     * Function edit
     *
     * @param Tandatangan $tandatangan comment about this variable
     *
     * @return mixed
     */
    public function edit(Tandatangan $tandatangan)
    {
        $sign = config('app.url'). $tandatangan->path_tandatangan;
        return view(
            'backend.auth.template.info_pengarah.edit',
            [
                'data' => $tandatangan,
                'tandatangan' => $sign,
            ]
        );
    }

    /**
     * Update tandatangan
     *
     * @param UpdateInfoPengarahRequest $request     comment about this variable
     * @param Tandatangan               $tandatangan comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateInfoPengarahRequest $request, Tandatangan $tandatangan)
    {
        foreach ($request->files as $file) {
            $name = $file->getClientOriginalName();
            $tarikh_file = Carbon::now()->format('ymd_His');
            $explode_name = explode('.', $name);

            $nama_fail = '';
            for ($i=0; $i < count($explode_name)-1; $i++) {
                $nama_fail .= $explode_name[$i];
            }

            $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
            $file->move(storage_path().'/app/public/tetapanTemplate', $name);
        }

        $this->infopengarahService->update($tandatangan, $request->validated());

        return redirect()->route('admin.auth.infopengarah.index', $tandatangan)->withFlashSuccess(__('Maklumat Pengarah telah berjaya dikemaskini.'));
    }

}
