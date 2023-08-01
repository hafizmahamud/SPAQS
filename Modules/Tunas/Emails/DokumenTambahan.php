<?php
/**
 * DokumenTambahan File
 *
 * PHP Version 8.0
 *
 * @category DokumenTambahan
 * @package  DokumenTambahan
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Tunas\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
/**
 * Class DokumenTambahan
 *
 * @category DokumenTambahan
 * @package  DokumenTambahan
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
// class DokumenTambahan extends Mailable
class DokumenTambahan extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $arrayAddendum;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $arrayAddendum)
    {
        //
        $this->data = $data;
        $this->arrayAddendum = $arrayAddendum;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Dokumen Tambahan Bagi '.$this->data['no_perolehan'])->markdown('email.DokumenTambahan');
        return $this;
    }
}
