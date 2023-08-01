<?php
/**
 * StoreAlamatRequest File.
 *
 * PHP Version 8.0
 *
 * @category StoreAlamatRequest
 * @package  StoreAlamatRequest
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Requests\Backend\Alamat;

use App\Models\SenaraiAlamat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreAlamatRequest.
 *
 * @category StoreAlamatRequest
 * @package  StoreAlamatRequest
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class StoreAlamatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jenis_alamat' => ['required', 'max:255'],
            'alamat' => ['required', 'max:255'],
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
}
