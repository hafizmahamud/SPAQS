<?php
/**
 * UpdateLanjutSahLakuRequest File
 *
 * @category UpdateLanjutSahLakuRequest
 * @package  UpdateLanjutSahLakuRequest
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Requests\Backend\Template;

use App\Models\LanjutSahLaku;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * Class UpdateLanjutSahLakuRequest.
 *
 * @category UpdateLanjutSahLakuRequest
 * @package  UpdateLanjutSahLakuRequest
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UpdateLanjutSahLakuRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rujukan' => ['required'],
            'alamat' => ['required'],
            'up' => ['required'],
            'title' => ['required'],
            'tajuk' => ['required'],
            'text_1' => ['required'],
            'text_2' => ['max:524288'],
            'moto' => ['required'],
            'sym' => ['required'],
            'nama' => ['required'],
            'jawatan' => ['required'],
            'kementerian' => ['required'],
        ];
    }

    /**
     * Function messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this role type.'),
        ];
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('You can not edit the Administrator role.'));
    }
}
