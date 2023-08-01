<?php
/**
 * SocialController File.
 *
 * PHP Version 8.0
 *
 * @category SocialController
 * @package  SocialController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Events\User\UserLoggedIn;
use App\Domains\Auth\Services\UserService;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class SocialController.
 *
 * @category SocialController
 * @package  SocialController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SocialController
{
    /**
     * Location to redirect.
     *
     * @param $provider comment about this variable
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Callback
     *
     * @param $provider    comment about this variable
     * @param UserService $userService comment about this variable
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function callback($provider, UserService $userService)
    {
        $user = $userService->registerProvider(Socialite::driver($provider)->user(), $provider);

        if (! $user->isActive()) {
            auth()->logout();

            return redirect()->route('frontend.auth.login')->withFlashDanger(__('Your account has been deactivated.'));
        }

        return redirect()->route(homeRoute());
    }
}
