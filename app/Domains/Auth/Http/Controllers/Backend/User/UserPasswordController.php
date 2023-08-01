<?php
/**
 * UserPasswordController File.
 *
 * PHP Version 8.0
 *
 * @category UserPasswordController
 * @package  UserPasswordController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\User;

use App\Domains\Auth\Http\Requests\Backend\User\EditUserPasswordRequest;
use App\Domains\Auth\Http\Requests\Backend\User\UpdateUserPasswordRequest;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Illuminate\Http\Request;
/**
 * Class UserPasswordController.
 *
 * @category UserPasswordController
 * @package  UserPasswordController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UserPasswordController
{
    /**
     * UserPasswordController constructor.
     *
     * @var UserService
     */
    protected $userService;

    /**
     * UserPasswordController constructor.
     *
     * @param UserService $userService comment about this variable
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Edit password
     *
     * @param EditUserPasswordRequest $request comment about this variable
     * @param User                    $user    comment about this variable
     *
     * @return mixed
     */
    public function edit(EditUserPasswordRequest $request, User $user)
    {
        return view('backend.auth.user.change-password')
            ->withUser($user);
    }

        /**
         * Get a validator for an incoming registration request.
         *
         * @param data $data comment about this variable
         *
         * @return \Illuminate\Contracts\Validation\Validator
         */
    protected function validator(array $data)
    {
        return Validator::make(
            $data, [
            'password' => array_merge(['min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/']),
            ]
        );

    }

    /**
     * Update password
     *
     * @param UpdateUserPasswordRequest $request comment about this variable
     * @param User                      $user    comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateUserPasswordRequest $request, User $user)
    {
        $this->validator($request->all())->validate();
        $this->userService->updatePassword($user, $request);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('Kata Laluan telah berjaya dikemaskini.'));
    }
}
