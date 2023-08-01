<?php
/**
 * UserTypeCheck File.
 *
 * PHP Version 8.0
 *
 * @category UserTypeCheck
 * @package  UserTypeCheck
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Middleware;

use Closure;

/**
 * Class UserTypeCheck.
 *
 * @category UserTypeCheck
 * @package  UserTypeCheck
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UserTypeCheck
{
    /**
     * UserTypeCheck
     *
     * @param $request comment about this variable
     * @param Closure $next    comment about this variable
     * @param $type    comment about this variable
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if ($request->user()) {
            if (strpos($type, '|') !== false) {
                $types = explode('|', $type);

                foreach ($types as $t) {
                    if ($request->user()->isType($t)) {
                        return $next($request);
                    }
                }
            } elseif ($request->user()->isType($type)) {
                return $next($request);
            }
        }

        return redirect()->route('frontend.index')->withFlashDanger(__('You do not have access to do that.'));
    }
}
