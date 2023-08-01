<?php
/**
 * MailMaklumResitSah File
 *
 * PHP Version 8.0
 *
 * @category MailMaklumResitSah
 * @package  MailMaklumResitSah
 * @author   Aina Zuhairah <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Tunas\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
/**
 * Class MailMaklumResitSah
 *
 * @category MailMaklumResitSah
 * @package  MailMaklumResitSah
 * @author   Aina Zuhairah <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MailMaklumResitSah extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $arrayTender;
    public $arrayAddendum;
    public $countAddendum;
    public $countTender;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $arrayTender, $arrayAddendum, $countAddendum, $countTender)
    {
        //
        $this->data = $data;
        $this->arrayTender = $arrayTender;
        $this->arrayAddendum = $arrayAddendum;
        $this->countAddendum = $countAddendum;
        $this->countTender = $countTender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Makluman Resit Sah Bagi '.$this->data['no_perolehan'])->markdown('email.MailMaklumResitSah');
    }
}
