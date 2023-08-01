<?php
/**
 * ToBeLoggedOut File.
 *
 * PHP Version 8.0
 *
 * @category ToBeLoggedOut
 * @package  ToBeLoggedOut
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Middleware;

use Closure;

/**
 * Class ToBeLoggedOut.
 *
 * @category ToBeLoggedOut
 * @package  ToBeLoggedOut
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class ToBeLoggedOut
{
    /**
     * ToBeLoggedOut
     *
     * @param $request comment about this variable
     * @param Closure $next    comment about this variable
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        // If the user is to be logged out
        if ($request->user() && $request->user()->to_be_logged_out) {
            // Make sure they can log back in next session
            $request->user()->update(['to_be_logged_out' => false]);

            // Kill the current session and force back to the login screen
            session()->flush();
            auth()->logout();

            return redirect()->route('frontend.auth.login');
        }

        return $next($request);
    }
}
