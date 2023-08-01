<?php
/**
 * Captcha File
 *
 * PHP Version 8.0
 *
 * @category Captcha
 * @package  Captcha
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class Captcha.
 *
 * PHP Version 8.0
 *
 * @category Captcha
 * @package  Captcha
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class Captcha implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute comment about this variable
     * @param mixed  $value     comment about this variable
     *
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function passes($attribute, $value)
    {
        if (empty($value)) {
            return false;
        }

        $response = json_decode(
            (new Client(
                [
                'timeout' => config('boilerplate.access.captcha.configs.options.timeout'),
                ]
            ))->post(
                'https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                'secret' => config('boilerplate.access.captcha.configs.secret_key'),
                'remoteip' => request()->getClientIp(),
                'response' => $value,
                ],
                ]
            )->getBody(), true
        );

        return isset($response['success']) && $response['success'] === true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The captcha was invalid.');
    }
}
