<?php
/**
 * UpdatePasswordController File.
 *
 * PHP Version 8.0
 *
 * @category UpdatePasswordController
 * @package  UpdatePasswordController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Http\Requests\Frontend\Auth\UpdatePasswordRequest;
use App\Domains\Auth\Services\UserService;

/**
 * Class UpdatePasswordController.
 *
 * @category UpdatePasswordController
 * @package  UpdatePasswordController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UpdatePasswordController
{
    /**
     * ChangePasswordController constructor.
     *
     * @var UserService
     */
    protected $userService;

    /**
     * ChangePasswordController constructor.
     *
     * @param UserService $userService comment about this variable
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * ChangePasswordController.
     *
     * @param UpdatePasswordRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdatePasswordRequest $request)
    {
        $this->userService->updatePassword($request->user(), $request->validated());

        return redirect()->back()->withFlashSuccess(__('Password successfully updated.'));
    }
}
