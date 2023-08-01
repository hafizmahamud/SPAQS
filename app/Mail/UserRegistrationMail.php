<?php
/**
 * UserRegistrationMail File
 *
 * PHP Version 8.0
 *
 * @category UserRegistrationMail
 * @package  UserRegistrationMail
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserRegistrationMail
 *
 * @category UserRegistrationMail
 * @package  UserRegistrationMail
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UserRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $ic_no;
    public $email;
    public $url;

    /**
     * Create a new message instance.
     *
     * @param name  $name  comment about this parameter
     * @param ic_no $ic_no comment about this parameter
     * @param email $email comment about this parameter
     * @param url   $url   comment about this parameter
     * 
     * @return void
     */
    public function __construct($name, $ic_no, $email, $url)
    {
        $this->name = $name;
        $this->ic_no = $ic_no;
        $this->email = $email;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pendaftaran Pengguna Baru')->markdown('mail.UserRegistration');
    }
}
