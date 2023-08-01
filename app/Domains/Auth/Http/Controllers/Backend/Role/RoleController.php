<?php
/**
 * RoleController File.
 *
 * PHP Version 8.0
 *
 * @category RoleController
 * @package  RoleController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\Role;

use App\Domains\Auth\Http\Requests\Backend\Role\DeleteRoleRequest;
use App\Domains\Auth\Http\Requests\Backend\Role\EditRoleRequest;
use App\Domains\Auth\Http\Requests\Backend\Role\StoreRoleRequest;
use App\Domains\Auth\Http\Requests\Backend\Role\UpdateRoleRequest;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use App\Models\ModelHasRoles;
use App\Domains\Auth\Services\PermissionService;
use App\Domains\Auth\Services\RoleService;

/**
 * Class RoleController.
 *
 * @category RoleController
 * @package  RoleController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class RoleController
{
    /**
     * Role service
     *
     * @var RoleService
     */
    protected $roleService;

    /**
     * Permission service
     *
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * RoleController constructor.
     *
     * @param RoleService       $roleService       comment about this variable
     * @param PermissionService $permissionService comment about this variable
     */
    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.auth.role.index');
    }

    /**
     * Create role
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.role.create')
            ->withCategories($this->permissionService->getCategorizedPermissions())
            ->withGeneral($this->permissionService->getUncategorizedPermissions());
    }

    /**
     * Store role
     *
     * @param StoreRoleRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roleService->store($request->validated());

        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('The role was successfully created.'));
    }

    /**
     * Edit role
     *
     * @param EditRoleRequest $request comment about this variable
     * @param Role            $role    comment about this variable
     *
     * @return mixed
     */
    public function edit(EditRoleRequest $request, Role $role)
    {
        return view('backend.auth.role.edit')
            ->withCategories($this->permissionService->getCategorizedPermissions())
            ->withGeneral($this->permissionService->getUncategorizedPermissions())
            ->withRole($role)
            ->withUsedPermissions($role->permissions->modelKeys());
    }

    /**
     * Update role
     *
     * @param UpdateRoleRequest $request comment about this variable
     * @param Role              $role    comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->roleService->update($role, $request->validated());

        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('The role was successfully updated.'));
    }

    /**
     * Delete Role
     *
     * @param DeleteRoleRequest $request comment about this variable
     * @param Role              $role    comment about this variable
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function destroy(DeleteRoleRequest $request, Role $role)
    {
        $this->roleService->destroy($role);

        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('The role was successfully deleted.'));
    }

    /**
     * Lihat User
     *
     * @param Id $id comment about this variable
     *
     * @return mixed
     */
    public function lihatUser($id)
    {
        $role = ModelHasRoles::where('role_id', $id)->pluck('model_id');
        $user = User::whereIn('id', $role)->pluck('id');
        $roleName = Role::where('id', $id)->first();
        return view('backend.auth.role.viewUserRole', compact('user', 'roleName'));
    }
}
