<?php
/**
 * LocaleMiddleware File
 *
 * PHP Version 8.0
 *
 * @category LocaleMiddleware
 * @package  LocaleMiddleware
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Middleware;

use Closure;

/**
 * Class LocaleMiddleware
 *
 * PHP Version 8.0
 *
 * @category LocaleMiddleware
 * @package  LocaleMiddleware
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request comment about this variable
     * @param \Closure                 $next    comment about this variable
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Locale is enabled and allowed to be changed
        if (config('boilerplate.locale.status') && session()->has('locale')) {
            setAllLocale(session()->get('locale'));
        }

        return $next($request);
    }
}
