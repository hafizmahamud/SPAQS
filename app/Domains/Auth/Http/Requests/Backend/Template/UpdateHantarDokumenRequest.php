<?php
/**
 * UpdateHantarDokumenRequest File
 *
 * @category UpdateHantarDokumenRequest
 * @package  UpdateHantarDokumenRequest
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Requests\Backend\Template;

use App\Models\HantarDokumen;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * Class UpdateHantarDokumenRequest.
 *
 * @category UpdateHantarDokumenRequest
 * @package  UpdateHantarDokumenRequest
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UpdateHantarDokumenRequest extends FormRequest
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
            'text_2' => ['required'],
            'text_3' => ['max:524288'],
            'moto' => ['required'],
            'sym' => ['required'],
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
