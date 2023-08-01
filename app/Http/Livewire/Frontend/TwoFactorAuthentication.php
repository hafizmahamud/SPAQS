<?php
/**
 * TwoFactorAuthentication File
 *
 * PHP Version 8.0
 *
 * @category TwoFactorAuthentication
 * @package  TwoFactorAuthentication
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Frontend;

use Illuminate\Http\Request;
use Livewire\Component;

/**
 * Class TwoFactorAuthentication.
 *
 * @category TwoFactorAuthentication
 * @package  TwoFactorAuthentication
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class TwoFactorAuthentication extends Component
{
    /**
     * The code
     *
     * @var
     */
    public $code;

    /**
     * Validate code
     *
     * @param Request $request comment about this variable
     *
     * @return mixed
     */
    public function validateCode(Request $request)
    {
        $this->validate(
            [
            'code' => 'required|min:6',
            ]
        );

        if ($request->user()->confirmTwoFactorAuth($this->code)) {
            $this->resetErrorBag();

            session()->flash('flash_success', __('Two Factor Authentication Successfully Enabled'));

            return redirect()->route('frontend.auth.account.2fa.show');
        }

        $this->addError('code', __('Your authorization code was invalid. Please try again.'));

        return false;
    }

    /**
     * Render
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return view('components.frontend.two-factor-authentication');
    }
}
