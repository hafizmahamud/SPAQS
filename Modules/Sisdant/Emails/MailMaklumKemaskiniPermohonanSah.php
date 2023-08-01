<?php
/**
 * MailMaklumKemaskiniPermohonanSah File
 *
 * PHP Version 8.0
 *
 * @category MailMaklumKemaskiniPermohonanSah
 * @package  MailMaklumKemaskiniPermohonanSah
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
 * Class MailMaklumKemaskiniPermohonanSah
 *
 * @category MailMaklumKemaskiniPermohonanSah
 * @package  MailMaklumKemaskiniPermohonanSah
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MailMaklumKemaskiniPermohonanSah extends Mailable
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
        return $this->subject('Makluman Permohonan Nombor Perolehan '.$this->data['no_perolehan'].' Dikemaskini')->markdown('sisdant::email.MailMaklumKemaskiniPermohonanSah');
    }
}
