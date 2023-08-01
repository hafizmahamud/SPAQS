<?php
/**
 * LocaleServiceProvider File.
 *
 * PHP Version 8.0
 *
 * @category LocaleServiceProvider
 * @package  LocaleServiceProvider
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class LocaleServiceProvider.
 *
 * @category LocaleServiceProvider
 * @package  LocaleServiceProvider
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return boot
     */
    public function boot()
    {
        setAllLocale(config('app.locale'));

        $this->registerBladeExtensions();
    }

    /**
     * Register the locale blade extensions.
     *
     * @return bladeextensions
     */
    protected function registerBladeExtensions(): void
    {
        /*
         * The block of code inside this directive indicates
         * the chosen language requests RTL support.
         */
        Blade::if(
            'langrtl', function () {
                return session()->has('lang-rtl');
            }
        );
    }
}
