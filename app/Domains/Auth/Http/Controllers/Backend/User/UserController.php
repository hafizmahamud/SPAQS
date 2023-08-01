<?php
/**
 * UserController File.
 *
 * PHP Version 8.0
 *
 * @category UserController
 * @package  UserController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\User;

use App\Domains\Auth\Http\Requests\Backend\User\DeleteUserRequest;
use App\Domains\Auth\Http\Requests\Backend\User\EditUserRequest;
use App\Domains\Auth\Http\Requests\Backend\User\StoreUserRequest;
use App\Domains\Auth\Http\Requests\Backend\User\UpdateUserRequest;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\PermissionService;
use App\Domains\Auth\Services\RoleService;
use App\Domains\Auth\Services\UserService;
use App\Models\Negeri;
use App\Models\Pejabat;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Awas\Models\PenilaianPerolehan;
use Illuminate\Http\Request;

/**
 * Class UserController.
 *
 * @category UserController
 * @package  UserController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UserController
{
    /**
     * UserController constructor.
     *
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     *
     * @var RoleService
     */
    protected $roleService;

    /**
     * UserController constructor.
     *
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * UserController constructor.
     *
     * @param UserService       $userService       comment about this variable
     * @param RoleService       $roleService       comment about this variable
     * @param PermissionService $permissionService comment about this variable
     */
    public function __construct(UserService $userService, RoleService $roleService, PermissionService $permissionService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.user.index');
    }

    /**
     * Create user
     *
     * @return mixed
     */
    public function create()
    {
        $listpejabat = Pejabat::select('id', 'bahagian', 'singkatan')
            ->orderBy('bahagian', 'asc')
            ->get();

        $listnegeri = Negeri::select('id', 'negeri', 'singkatan')
            ->orderBy('negeri', 'asc')
            ->get();

        return view('backend.auth.user.create', compact('listnegeri', 'listpejabat'))
            ->withRoles($this->roleService->get())
            ->withCategories($this->permissionService->getCategorizedPermissions())
            ->withGeneral($this->permissionService->getUncategorizedPermissions());
    }

    /**
     * Store user
     *
     * @param StoreUserRequest $request comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->store($request->validated());
        return redirect()->route('admin.auth.user.show', $user)->withFlashSuccess(__('The user was successfully created.'));
    }

    /**
     * Show user
     *
     * @param User $user comment about this variable
     *
     * @return mixed
     */
    public function show(User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }

    /**
     * Edit user
     *
     * @param EditUserRequest $request comment about this variable
     * @param User            $user    comment about this variable
     *
     * @return mixed
     */
    public function edit(EditUserRequest $request, User $user)
    {
        return view('backend.auth.user.edit')
            ->withUser($user)
            ->withRoles($this->roleService->get())
            ->withCategories($this->permissionService->getCategorizedPermissions())
            ->withGeneral($this->permissionService->getUncategorizedPermissions())
            ->withUsedPermissions($user->permissions->modelKeys());
    }

    /**
     * Update user
     *
     * @param UpdateUserRequest $request comment about this variable
     * @param User              $user    comment about this variable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->update($user, $request->validated());
        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('The user was successfully updated.'));
    }

    /**
     * Destroy user
     *
     * @param DeleteUserRequest $request comment about this variable
     * @param User              $user    comment about this variable
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(DeleteUserRequest $request, User $user)
    {
        $this->userService->delete($user);

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('The user was successfully deleted.'));
    }

    /**
     * Update profile user.
     *
     * @param Request $request comment about this variable
     *
     * @return Renderable
     */
    public function getPejabat(Request $request)
    {
        $negeri = $request->negeri;
        $pejabat = Pejabat::where('negeri_id', $negeri)
            ->orderBy('bahagian', 'asc')
            ->get();

        return response()->json([$pejabat]);
    }

    /**
     * Semak user.
     *
     * @param Request $request comment about this variable
     *
     * @return Renderable
     */
    public function semakpengguna(Request $request)
    {
        $sisdant = PermohonanNomborPerolehan::where('user_id', $request->userId)
                    ->whereIn('status', ['sah', 'draf-iklan'])
                    ->get();
        $sisdant = $sisdant->count();

        $tunas = IklanPerolehan::where('user_id', $request->userId)
        ->whereIn('status_iklan_id', [1, 2, 3, 4, 5])
        ->whereNull('jadual_harga_status')
        ->orWhere('jadual_harga_status', ['TINDAKAN', 'DRAF'])
        ->get();

        $tunas = $tunas->count();

        $awas = PenilaianPerolehan::where('user_id', $request->userId)
        ->whereNotIn('status_penilaian', ['syor_tamat', 'syor_selesai'])
        ->get();

        $awas = $awas->count();

        $total = $sisdant + $tunas + $awas;

        return response()->json([$total]);
    }
}
