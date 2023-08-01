<?php
/**
 * LoginController File.
 *
 * PHP Version 8.0
 *
 * @category LoginController
 * @package  LoginController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Events\User\UserLoggedIn;
use App\Rules\Captcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
//use Request;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Auth;
use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Log;
use DateTime;
/**
 * Class LoginController.
 *
 * @category LoginController
 * @package  LoginController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LoginController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(homeRoute());
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    /**
     * Validate the user login request.
     *
     * @param \Illuminate\Http\Request $request comment about this variable
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
            $this->username() => ['required', 'max:255', 'string'],
            'password' => array_merge(['max:100'], PasswordRules::login()),
            'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
            ], [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
            ]
        );
    }

    /**
     * Overidden for 2FA
     * https://github.com/DarkGhostHunter/Laraguard#protecting-the-login.
     *
     * Attempt to log the user into the application.
     *
     * @param \Illuminate\Http\Request $request comment about this variable
     *
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        try {
            return $this->guard()->attempt(
                $this->credentials($request),
                $request->filled('remember')
            );
        } catch (HttpResponseException $exception) {
            $this->incrementLoginAttempts($request);
            throw $exception;
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request comment about this variable
     * @param $user    comment about this variable
     *
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (! $user->isActive()) {
            auth()->logout();

            return redirect()->route('frontend.auth.login')->withFlashDanger(__('Your account has been deactivated.'));
        }

        event(new UserLoggedIn($user));

        
        if (config('boilerplate.access.user.single_login')) {
            auth()->logoutOtherDevices($request->password);
        }
    }

        /**
         * Overwrite method logout.
         *
         * @param Request $request comment about this variable
         *
         * @return mixed
         */
    public function logout(Request $request)
    {
        $user = Auth::user();

        activity('Logout')
        ->log(':causer.name log keluar');

        $this->guard()->logout();
        
        //Insert into log the time period of user logged in when logout
        $login = DB::table('activity_log')
            ->where('log_name', 'LIKE', 'Login')
            ->where('causer_id', '=', $user->id)
            ->latest('created_at')
            ->first();
        $startTime = Carbon::parse($login->created_at);
        $endTime = Carbon::now();

        $totalDuration = $endTime->diff($startTime);

        $hours = $totalDuration->h.' jam';
        $minutes = $totalDuration->i.' minit';
        $differences = $hours.' & '.$minutes;

        activity('Logout')
            ->log('Tempoh masa pengguna '.$user->name.' adalah '.$differences);

        return redirect()->route('frontend.auth.login');
    }
}
