<?php
/**
 * Carbon File.
 *
 * PHP Version 8.0
 *
 * @category Carbon
 * @package  Carbon
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
use Carbon\Carbon;

if (! function_exists('setAllLocale')) {

    /**
     * Set carbo locale
     *
     * @param $locale comment about this variable
     *
     * @return locale
     */
    function setAllLocale($locale)
    {
        setAppLocale($locale);
        setPHPLocale($locale);
        setCarbonLocale($locale);
        setLocaleReadingDirection($locale);
    }
}

if (! function_exists('setAppLocale')) {

    /**
     * Set carbo locale
     *
     * @param $locale comment about this variable
     *
     * @return locale
     */
    function setAppLocale($locale)
    {
        app()->setLocale($locale);
    }
}

if (! function_exists('setPHPLocale')) {

    /**
     * Set carbo locale
     *
     * @param $locale comment about this variable
     *
     * @return locale
     */
    function setPHPLocale($locale)
    {
        setlocale(LC_TIME, $locale);
    }
}

if (! function_exists('setCarbonLocale')) {

    /**
     * Set carbo locale
     *
     * @param $locale comment about this variable
     *
     * @return locale
     */
    function setCarbonLocale($locale)
    {
        Carbon::setLocale($locale);
    }
}

if (! function_exists('setLocaleReadingDirection')) {

    /**
     * Locale
     *
     * @param $locale comment about this variable
     *
     * @return locale
     */
    function setLocaleReadingDirection($locale)
    {
        /*
         * Set the session variable for whether or not the app is using RTL support
         * For use in the blade directive in BladeServiceProvider
         */
        if (! app()->runningInConsole()) {
            if (config('boilerplate.locale.languages')[$locale]['rtl']) {
                session(['lang-rtl' => true]);
            } else {
                session()->forget('lang-rtl');
            }
        }
    }
}

if (! function_exists('getLocaleName')) {

    /**
     * LocaleName
     *
     * @param $locale comment about this variable
     *
     * @return mixed
     */
    function getLocaleName($locale)
    {
        return config('boilerplate.locale.languages')[$locale]['name'];
    }
}
