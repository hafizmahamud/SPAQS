<?php
/**
 * DeletedUserController File.
 *
 * PHP Version 8.0
 *
 * @category DeletedUserController
 * @package  DeletedUserController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\User;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;

/**
 * Class DeletedUserController.
 *
 * @category DeletedUserController
 * @package  DeletedUserController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class DeletedUserController
{
    /**
     * UserService
     *
     * @var UserService
     */
    protected $userService;

    /**
     * DeletedUserController constructor.
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
        return view('backend.auth.user.deleted');
    }

    /**
     * Update user
     *
     * @param User $deletedUser comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function update(User $deletedUser)
    {
        $this->userService->restore($deletedUser);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('The user was successfully restored.'));
    }

    /**
     * Destroy user
     *
     * @param User $deletedUser comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(User $deletedUser)
    {
        abort_unless(config('boilerplate.access.user.permanently_delete'), 404);

        $this->userService->destroy($deletedUser);

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('The user was permanently deleted.'));
    }
}
