<?php
/**
 * mailMaklumanBorangSaringanWajib File
 *
 * PHP Version 8.0
 *
 * @category mailMaklumanBorangSaringanWajib
 * @package  mailMaklumanBorangSaringanWajib
 * @author   MimiKhalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Tunas\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
/**
 * Class mailMaklumanBorangSaringanWajib
 *
 * @category mailMaklumanBorangSaringanWajib
 * @package  mailMaklumanBorangSaringanWajib
 * @author   MimiKhalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class mailMaklumanBorangSaringanWajib extends Mailable
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
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Borang Saringan Wajib Bagi '.$this->data['no_perolehan'])->markdown('email.mailMaklumanBorangSaringanWajib');
    }
}
