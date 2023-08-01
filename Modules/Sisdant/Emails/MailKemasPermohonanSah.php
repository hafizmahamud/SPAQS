<?php
/**
 * MailKemasPermohonanSah File
 *
 * PHP Version 8.0
 *
 * @category MailKemasPermohonanSah
 * @package  MailKemasPermohonanSah
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
 * Class MailKemasPermohonanSah
 *
 * @category MailKemasPermohonanSah
 * @package  MailKemasPermohonanSah
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MailKemasPermohonanSah extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Butiran '.$this->data['no_perolehan'].' Telah Diserahkan')->markdown('sisdant::email.MailKemasPermohonanSah');
    }
}
