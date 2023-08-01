<?php
/**
 * UserRegistrationEmail File
 *
 * PHP Version 8.0
 *
 * @category UserRegistrationEmail
 * @package  UserRegistrationEmail
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
 * UserRegistrationEmail File
 *
 * PHP Version 8.0
 *
 * @category UserRegistrationEmail
 * @package  UserRegistrationEmail
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UserRegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $url;
    public $mailto;

    /**
     * Create a new message instance.
     *
     * @param password $password comment about this parameter
     * @param url      $url      comment about this parameter
     * @param mailto   $mailto   comment about this parameter
     * 
     * @return void
     */
    public function __construct($password, $url, $mailto)
    {
        $this->password = $password;
        $this->url = $url;
        $this->mailto = $mailto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Makluman Pendaftaran Pengguna Baru')->markdown('mail.UserRegistrationPassword');
    }
}
