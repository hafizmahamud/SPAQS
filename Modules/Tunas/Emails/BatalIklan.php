<?php
/**
 * BatalIklan File
 *
 * PHP Version 8.0
 *
 * @category BatalIklan
 * @package  BatalIklan
 * @author   Mimi Khalid<mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Tunas\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
/**
 * Class BatalIklan
 *
 * @category BatalIklan
 * @package  BatalIklan
 * @author   Mimi Khalid<mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BatalIklan extends Mailable
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
        return $this->subject('Pembatalan Nombor Perolehan Bagi '.$this->data['no_perolehan'])->markdown('email.BatalIklan');
    }
}
