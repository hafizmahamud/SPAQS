<?php
/**
 * SuperAdminCheck File.
 *
 * PHP Version 8.0
 *
 * @category SuperAdminCheck
 * @package  SuperAdminCheck
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Middleware;

use Closure;

/**
 * Class SuperAdminCheck.
 *
 * @category SuperAdminCheck
 * @package  SuperAdminCheck
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SuperAdminCheck
{
    /**
     * SuperAdminCheck
     *
     * @param $request comment about this variable
     * @param Closure $next    comment about this variable
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->hasAllAccess()) {
            return $next($request);
        }

        return redirect()->route('frontend.index')->withFlashDanger(__('You do not have access to do that.'));
    }
}
