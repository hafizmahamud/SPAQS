<?php
// phpcs:ignoreFile -- this fail is generated by Laravel
namespace App\Domains\Auth\Http\Requests\Backend\Role;

use App\Domains\Auth\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRoleRequest.
 */
class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ! $this->role->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => [Rule::exists('permissions', 'id')->where('type', $this->type)],
            'description' => ['required'],
        ];
    }

    /**
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
