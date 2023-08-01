<?php
/**
 * MailController File
 *
 * PHP Version 8.0
 *
 * @category MailController
 * @package  MailController
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistrationMail;
use App\Mail\UserStatusChange;
use DB;
/**
 * Class MailController
 *
 * @category MailController
 * @package  MailController
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MailController extends Controller
{
    /**
     * Function sendRegistrationEmail
     *
     * @return mixed
     */
    public static function sendRegistrationEmail()
    {
        $user = DB::table('users')->latest('created_at')->first();

        $userRegistration = [
            'title' => 'Permohonan Akaun Baru SPAQS',
            'body1' => 'Adalah dimaklumkan, satu permohonan pendaftaran akaun di SPAQS. Maklumat pendaftaran adalah seperti berikut: ',
            'body2' => $user->name,
            'body3' => $user->ic_no,
            'body4' => $user->email,

        ];

        $admin = DB::table('users')->where('type', 'admin')->get('email');

        Mail::to($admin)->send(new UserRegistrationMail($userRegistration));

        return view('frontend.register-success');
    }

}
