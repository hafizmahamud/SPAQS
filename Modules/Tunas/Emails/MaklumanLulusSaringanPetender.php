<?php
/**
 * MaklumanLulusSaringanPetender File
 *
 * PHP Version 8.0
 *
 * @category MaklumanLulusSaringanPetender
 * @package  MaklumanLulusSaringanPetender
 * @author   MimiKhalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Tunas\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
/**
 * Class MaklumanLulusSaringanPetender
 *
 * @category MaklumanLulusSaringanPetender
 * @package  MaklumanLulusSaringanPetender
 * @author   MimiKhalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MaklumanLulusSaringanPetender extends Mailable
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
        if($this->data["jenis_tender"]=='bayar') {
            $this->subject('Makluman Pendaftaran Petender Bagi '.$this->data['no_perolehan'])->markdown('email.MaklumanLulusSaringanPetenderBerbayar');
            return $this;
        } else if($this->data["jenis_tender"]=='tanpa bayaran'){
            $this->subject('Makluman Pendaftaran Petender Bagi '.$this->data['no_perolehan'])->markdown('email.MaklumanLulusSaringanPetenderPercuma');
            return $this;
        } else if($this->data["jenis_tender"]=='tunai'){
            $this->subject('Makluman Pendaftaran Petender Bagi '.$this->data['no_perolehan'])->markdown('email.MaklumanLulusSaringanPetenderTunai');
            return $this;
        }
    }
}
