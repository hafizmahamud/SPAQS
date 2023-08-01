<?php
/**
 * MailPermohonan File
 *
 * PHP Version 8.0
 *
 * @category MailPermohonan
 * @package  MailPermohonan
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */

namespace Modules\Sisdant\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class MailPermohonan
 *
 * @category MailPermohonan
 * @package  MailPermohonan
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MailPermohonan extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Makluman Permohonan Nombor Perolehan Baharu')->markdown('sisdant::email.MailPermohonan');
    }
}
