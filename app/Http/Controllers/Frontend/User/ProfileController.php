<?php
/**
 * ProfileController File.
 *
 * PHP Version 8.0
 *
 * @category ProfileController
 * @package  ProfileController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Controllers\Frontend\User;

use App\Domains\Auth\Services\UserService;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;

/**
 * Class ProfileController.
 *
 * @category ProfileController
 * @package  ProfileController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class ProfileController
{
    /**
     * Update Profile
     *
     * @param UpdateProfileRequest $request     comment about this variable
     * @param UserService          $userService comment about this variable
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request, UserService $userService)
    {
        $nama = $request->user()->name;
        $ic = $request->user()->ic_no;
        $negeri_id = $request->user()->negeri_id;
        $section_id = $request->user()->section_id;
        $jawatan = $request->user()->jawatan;

        if ($request->action == 'ic') {
            $array = array(
                'name' => $nama,
                'ic_no' => $request->no_kad_pengenalan,
                'section_id' => $section_id,
                'negeri_id' => $negeri_id,
                'jawatan' => $jawatan,
            );
        } else if ($request->action == 'nama') {
            $array = array(
                'name' => $request->nama,
                'ic_no' => $ic,
                'section_id' => $section_id,
                'negeri_id' => $negeri_id,
                'jawatan' => $jawatan,
            );
        } else if ($request->action == 'bahagian') {
            $array = array(
                'name' => $nama,
                'ic_no' => $ic,
                'section_id' => $request->bahagian,
                'negeri_id' => $request->negeri,
                'jawatan' => $jawatan,
            );
        } else if ($request->action == 'jawatan') {
            $array = array(
                'name' => $nama,
                'ic_no' => $ic,
                'section_id' => $section_id,
                'negeri_id' => $negeri_id,
                'jawatan' => $request->jawatan,
            );

        }

        $userService->updateProfile($request->user(), $array);

        return redirect()->back()->withFlashSuccess(__('Profile successfully updated.'));
    }
}
