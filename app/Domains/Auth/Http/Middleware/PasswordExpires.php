<?php
/**
 * PasswordExpires File.
 *
 * PHP Version 8.0
 *
 * @category PasswordExpires
 * @package  PasswordExpires
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Middleware;

use Carbon\Carbon;
use Closure;

/**
 * Class PasswordExpires.
 *
 * @category PasswordExpires
 * @package  PasswordExpires
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class PasswordExpires
{
    /**
     * PasswordExpires
     *
     * @param $request comment about this variable
     * @param Closure $next    comment about this variable
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     *
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        if (is_numeric(config('boilerplate.access.user.password_expires_days'))) {
            $password_changed_at = new Carbon($request->user()->password_changed_at ?? $request->user()->created_at);

            if (now()->diffInDays($password_changed_at) >= config('boilerplate.access.user.password_expires_days')) {
                return redirect()
                    ->route('frontend.auth.password.expired')
                    ->withFlashWarning(
                        __(
                            'Your password has expired. We require you to change your password every :days days for security purposes.', [
                            'days' => config('boilerplate.access.user.password_expires_days'),
                            ]
                        )
                    );
            }
        }

        return $next($request);
    }
}
