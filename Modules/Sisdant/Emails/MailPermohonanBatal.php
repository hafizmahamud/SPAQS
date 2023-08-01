<?php
/**
 * MailPermohonanBatal File
 *
 * PHP Version 8.0
 *
 * @category MailPermohonanBatal
 * @package  MailPermohonanBatal
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
 * Class MailPermohonanBatal
 *
 * @category MailPermohonanBatal
 * @package  MailPermohonanBatal
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MailPermohonanBatal extends Mailable
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
        return $this->subject('Permohonan Nombor Perolehan Dibatalkan')->markdown('sisdant::email.MailPermohonanBatal');
    }
}
