<?php
/**
 * UpdateKepalaSuratRequest File
 *
 * @category UpdateKepalaSuratRequest
 * @package  UpdateKepalaSuratRequest
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Requests\Backend\Template;

use App\Models\HeaderSurat;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * Class UpdateKepalaSuratRequest.
 *
 * @category UpdateKepalaSuratRequest
 * @package  UpdateKepalaSuratRequest
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UpdateKepalaSuratRequest extends FormRequest
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
            'jata_negara' => ['mimes:png'],
            'img_memo' => ['mimes:png'],
            'jabatan' => ['required'],
            'kementerian' => ['required'],
            'alamat' => ['required'],
            'laman_web' => ['required'],
            'no_tel' => ['required'],
            'no_fax' => ['required'],
            'email' => ['required']
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
