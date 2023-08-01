<?php
/**
 * UserStatusController File.
 *
 * PHP Version 8.0
 *
 * @category UserStatusController
 * @package  UserStatusController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\User;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserStatusDeactivate;
use App\Mail\UserStatusActivate;
use DB;

/**
 * Class UserStatusController.
 *
 * @category UserStatusController
 * @package  UserStatusController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class DeactivatedUserController
{
    /**
     * UserService
     *
     * @var UserService
     */
    protected $userService;


    /**
     * DeactivatedUserController constructor.
     *
     * @param UserService $userService comment about this variable
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.auth.user.deactivated');
    }

    /**
     * Update user
     *
     * @param Request $request comment about this variable
     * @param User    $user    comment about this variable
     * @param $status  comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Request $request, User $user, $status)
    {
        $this->userService->mark($user, (int) $status);

        //Hantar Email lepas deactivated
        if ($user->active == '0') {
            $mailto = $user->email;
            Mail::to($mailto)->send(new UserStatusDeactivate);
        }
        
        //Hantar Email lepas activate
        if ($user->active == '1') {
            $url = "/login";
            $mailto = $user->email;
            Mail::to($mailto)->send(new UserStatusActivate($url));
        }

        return redirect()->route(
            (int) $status === 1 || ! $request->user()->can('admin.access.user.reactivate') ?
                'admin.auth.user.index' :
                'admin.auth.user.deactivated'
        )->withFlashSuccess(__('The user was successfully updated.'));
    }
}
