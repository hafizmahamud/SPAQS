<?php
/**
 * UpdateLantikanPenilaiRequest File
 *
 * @category UpdateLantikanPenilaiRequest
 * @package  UpdateLantikanPenilaiRequest
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Requests\Backend\Template\LantikanPenilai;

use App\Models\LantikanPelantik;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateLantikanPenilaiRequest.
 *
 * @category UpdateLantikanPenilaiRequest
 * @package  UpdateLantikanPenilaiRequest
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UpdateLantikanPenilaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return ! $logged_in_user->isAdmin();
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text_1' => ['required'],
            'text_2' => ['required'],
            'text_3' => ['required'],
            'text_4' => ['max:524288'],
            'moto_1' => ['required'],
            'sym' => ['required', 'max:255']
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
