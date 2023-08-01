<?php
/**
 * RegisterController File.
 *
 * PHP Version 8.0
 *
 * @category RegisterController
 * @package  RegisterController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Rules\Captcha;
use App\Register;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use App\Models\Pejabat;
use App\Domains\Auth\Services\UserService;
use App\Models\Negeri;
use App\Models\ModelHasRoles;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistrationMail;
use App\Mail\UserRegistrationMailUser;
use Illuminate\Support\Facades\Auth;



/**
 * Class RegisterController.
 *
 * @category RegisterController
 * @package  RegisterController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use \Illuminate\Foundation\Auth\RegistersUsers;

    /**
     * RegisterController constructor.
     *
     * @var UserService
     */
    protected $userService;

    /**
     * RegisterController constructor.
     *
     * @param UserService $userService comment about this variable
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Where to redirect users after registration.
     *
     * @return string
     */
    public function redirectPath()
    {
        return 'register-success';
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $listpejabat = Pejabat::select('id', 'bahagian', 'singkatan')
            ->orderBy('bahagian', 'asc')
            ->get();

        $listnegeri = Negeri::select('id', 'negeri', 'singkatan')
            ->orderBy('negeri', 'asc')
            ->get();

        abort_unless(config('boilerplate.access.user.registration'), 404);

        return view('frontend.auth.register', compact('listnegeri', 'listpejabat'));
    }

    /**
     * Show the application registration form.
     *
     * @param $id comment about this variable
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationAjax($id)
    {
        $listpejabat = DB::table("pejabat")
            ->list('bahagian', 'singkatan')
            ->orderBy('id', 'asc');

        return json_encode($listpejabat);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param data $data comment about this variable
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password' => array_merge(['min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/']),
            'ic_no' => ['required', 'numeric', 'digits:12'],
            'negeri_id' => ['required', 'not_in:none'],
            'section_id' => ['required_if:negeri_id,==,16', 'not_in:none'], 
            ]
        );

    }

    /**
     * Create a new user instance after a valid registration.
     * 
     * @param array $data comment about this variable
     * 
     * @return \App\Domains\Auth\Models\User|mixed
     *
     * @throws \App\Domains\Auth\Exceptions\RegisterException
     */
    protected function create(array $data)
    {

        if (in_array('section_id', array_keys($data))) {

            $section = $data['section_id'];

        } else {

            $section = null;
        }
        //return User::create(
        $user = User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'ic_no' => $data['ic_no'],
                'section_id' => $section,
                'negeri_id' => $data['negeri_id'],
                'email_verified_at' => now(),
                'active' => '0',
            ]
        );
        // Set Peranan 'Pelaksana' kepada pengguna baru daftar
        $modelRoles = new ModelHasRoles;
        $modelRoles->role_id = '12';
        $modelRoles->model_type = 'App\Domains\Auth\Models\User';
        $modelRoles->model_id = $user->id;
        $modelRoles->save();

        abort_unless(config('boilerplate.access.user.registration'), 404);
        $url = "/admin/auth/user/".$user->id."/edit";
        $admin = User::where('type', 'admin')->get('email');
        Mail::to($admin)->send(new UserRegistrationMail($user->name, $user->ic_no, $user->email, $url));
        Mail::to($user->email)->send(new UserRegistrationMailUser());
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param Request $request comment about this variable
     * 
     * @return \App\Domains\Auth\Models\User|mixed
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect('/register-success');
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

}
