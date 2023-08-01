<?php
/**
 * TwoFactorAuthenticationController File.
 *
 * PHP Version 8.0
 *
 * @category TwoFactorAuthenticationController
 * @package  TwoFactorAuthenticationController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;

/**
 * Class TwoFactorAuthenticationController.
 *
 * @category TwoFactorAuthenticationController
 * @package  TwoFactorAuthenticationController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class TwoFactorAuthenticationController
{
    /**
     * Create 2factor auth
     *
     * @param Request $request comment about this variable
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        $secret = $request->user()->createTwoFactorAuth();

        return view('frontend.user.account.tabs.two-factor-authentication.enable')
            ->withQrCode($secret->toQr())
            ->withSecret($secret->toString());
    }

    /**
     * Show
     *
     * @param Request $request comment about this variable
     *
     * @return mixed
     */
    public function show(Request $request)
    {
        return view('frontend.user.account.tabs.two-factor-authentication.recovery')
            ->withRecoveryCodes($request->user()->getRecoveryCodes());
    }

    /**
     * Update generate code
     *
     * @param Request $request comment about this variable
     *
     * @return mixed
     */
    public function update(Request $request)
    {
        $request->user()->generateRecoveryCodes();

        session()->flash('flash_warning', __('Any old backup codes have been invalidated.'));

        return redirect()->route('frontend.auth.account.2fa.show')->withFlashSuccess(__('Two Factor Recovery Codes Regenerated'));
    }
}
