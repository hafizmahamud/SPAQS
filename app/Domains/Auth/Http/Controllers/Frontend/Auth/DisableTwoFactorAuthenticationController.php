<?php
/**
 * DisableTwoFactorAuthenticationController File.
 *
 * PHP Version 8.0
 *
 * @category DisableTwoFactorAuthenticationController
 * @package  DisableTwoFactorAuthenticationController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Http\Requests\Frontend\Auth\DisableTwoFactorAuthenticationRequest;

/**
 * Class DisableTwoFactorAuthenticationController.
 *
 * @category DisableTwoFactorAuthenticationController
 * @package  DisableTwoFactorAuthenticationController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class DisableTwoFactorAuthenticationController
{
    /**
     * Show
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('frontend.user.account.tabs.two-factor-authentication.disable');
    }

    /**
     * Disable two factor authentication
     *
     * @param DisableTwoFactorAuthenticationRequest $request comment about this variable
     *
     * @return mixed
     */
    public function destroy(DisableTwoFactorAuthenticationRequest $request)
    {
        $request->user()->disableTwoFactorAuth();

        return redirect()->route('frontend.user.account', ['#two-factor-authentication'])->withFlashSuccess(__('Two Factor Authentication Successfully Disabled'));
    }
}
