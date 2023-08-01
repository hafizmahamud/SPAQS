<?php
/**
 * AnnouncementController File.
 *
 * PHP Version 8.0
 *
 * @category AnnouncementController
 * @package  AnnouncementController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\Announcement;

use Illuminate\Http\Request;
use App\Domains\Announcement\Models\Announcement;

/**
 * Class AnnouncementController.
 *
 * @category AnnouncementController
 * @package  AnnouncementController
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AnnouncementController
{

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.announcement.index');
    }
    /**
     * Create Kod Bidang
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.announcement.create');
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

        if ($request->active) {
            $active = $request->active;

            Announcement::where('enabled', $request->active)->update(['enabled' => 'f']);

        } else {
            $active = 'f';
        }

        Announcement::create(
            [
            'type' => $request->type,
            'message' => $request->makluman,
            'enabled' => $active,
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
            ]
        );

        return redirect()->route('admin.auth.announcement.index')->withFlashSuccess(__('Pengumuman berjaya ditambah.'));
    }

    /**
     * Update user
     *
     * @param Request      $request      comment about this variable
     * @param Announcement $announcement comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request, Announcement $announcement)
    {
        if ($request->active) {
            $active = $request->active;
            Announcement::where('enabled', $request->active)->whereNotIn('id', [$announcement->id])->update(['enabled' => 'f']);

        } else {
            $active = 'f';
        }

        Announcement::where('id', $announcement->id) -> update(
            [
                'type' => $request->type,
                'message' => $request->makluman,
                'enabled' => $active,
                'starts_at' => $request->starts_at,
                'ends_at' => $request->ends_at,
            ]
        );
        return redirect()->route('admin.auth.announcement.index')->withFlashSuccess(__('Pengumuman berjaya dikemaskini.'));
    }

    /**
     * Edit user
     *
     * @param Announcement $announcement comment about this variable
     *
     * @return mixed
     */
    public function edit(Announcement $announcement)
    {
        return view('backend.auth.announcement.edit')
            ->withAnnouncement($announcement);
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
        Announcement::where('id', $id)->delete();

        return redirect()->back()->withFlashSuccess(__('Pengumuman berjaya dipadam.'));
    }


}
