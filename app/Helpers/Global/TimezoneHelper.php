<?php
/**
 * Timezone File.
 *
 * PHP Version 8.0
 *
 * @category Timezone
 * @package  Timezone
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
use JamesMills\LaravelTimezone\Timezone;

if (! function_exists('timezone')) {
    /**
     * Access the timezone helper.
     *
     * @return timezone
     */
    function timezone()
    {
        return resolve(Timezone::class);
    }
}
