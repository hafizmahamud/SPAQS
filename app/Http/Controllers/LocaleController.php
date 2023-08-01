<?php
/**
 * LocaleController File.
 *
 * PHP Version 8.0
 *
 * @category LocaleController
 * @package  LocaleController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Controllers;

/**
 * Class LocaleController.
 *
 * @category LocaleController
 * @package  LocaleController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LocaleController
{
    /**
     * Locale
     *
     * @param $locale comment about this variable
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change($locale)
    {
        app()->setLocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();
    }
}
