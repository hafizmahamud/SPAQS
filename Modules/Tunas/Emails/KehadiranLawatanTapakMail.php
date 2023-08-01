<?php
/**
 * UserRegistrationMail File
 *
 * PHP Version 8.0
 *
 * @category KehadiranLawatanTapakMail
 * @package  KehadiranLawatanTapakMail
 * @author   Maya Shihabudin <maya@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Tunas\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
/**
 * UserRegistrationMail File
 *
 * PHP Version 8.0
 *
 * @category KehadiranLawatanTapakMail
 * @package  KehadiranLawatanTapakMail
 * @author   Maya Shihabudin <maya@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class KehadiranLawatanTapakMail extends Mailable
{
    use Queueable, SerializesModels;

    public $no_siri;
    public $borang_daftar;
    public $jenisLawatanTapak;
    public $dateBukaIklanAddTwoDays;
    public $data;

    /**
     * Create a new message instance.
     * 
     * @param no_siri       $no_siri       comment abouT this parameter
     * @param borang_daftar $borang_daftar comment about this parameter
     * 
     * @return void
     */
    public function __construct($data,$no_siri,$borang_daftar,$jenisLawatanTapak,$dateBukaIklanAddTwoDays)
    {
        $this->no_siri = $no_siri;
        $this->borang_daftar = $borang_daftar;
        $this->jenisLawatanTapak = $jenisLawatanTapak;
        $this->dateBukaIklanAddTwoDays = $dateBukaIklanAddTwoDays;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->jenisLawatanTapak!='TIDAK_WAJIB') {
            return $this->subject('Maklumat Borang Lawatan Tapak Bagi '.$this->data['no_perolehan'])->markdown('email.KehadiranLawatanTapakMail');
        } else {
            return $this->subject('Maklumat Borang Pendaftaran Kontraktor Bagi '.$this->data['no_perolehan'])->markdown('email.KehadiranLawatanTapakMail');
        }
    }
}