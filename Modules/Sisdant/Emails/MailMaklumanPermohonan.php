<?php
/**
 * MailMaklumanPermohonan File
 *
 * PHP Version 8.0
 *
 * @category MailMaklumanPermohonan
 * @package  MailMaklumanPermohonan
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
 * Class MailMaklumanPermohonan
 *
 * @category MailMaklumanPermohonan
 * @package  MailMaklumanPermohonan
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MailMaklumanPermohonan extends Mailable
{
    use Queueable, SerializesModels;


    public $url;

    /**
     * Create a new message instance.
     *
     * @param url $url comment about this parameter
     *
     * @return void
     */
    public function __construct( $url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Makluman Permohonan Nombor Perolehan Baharu')->markdown('sisdant::email.MailMaklumanPermohonan');
    }
}
