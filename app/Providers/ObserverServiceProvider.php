<?php
/**
 * ObserverServiceProvider File
 *
 * PHP Version 8.0
 *
 * @category ObserverServiceProvider
 * @package  ObserverServiceProvider
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Providers;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

/**
 * ObserverServiceProvider File
 *
 * PHP Version 8.0
 *
 * @category ObserverServiceProvider
 * @package  ObserverServiceProvider
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return boot
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }

    /**
     * Register the service provider.
     *
     * @return register
     */
    public function register()
    {
        //
    }
}
