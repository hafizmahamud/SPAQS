<?php
/**
 * KepalaSuratUpdated File.
 *
 * PHP Version 8.0
 *
 * @category KepalaSuratUpdated
 * @package  KepalaSuratUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Template\KepalaSurat;

use App\Models\HeaderSurat;
use Illuminate\Queue\SerializesModels;

/**
 * Class KepalaSuratUpdated.
 *
 * @category KepalaSuratUpdated
 * @package  KepalaSuratUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class KepalaSuratUpdated
{
    use SerializesModels;

    /**
     * Declare headersurat
     *
     * @var
     */
    public $headersurat;

    /**
     * Constructor HeaderSurat
     *
     * @param $headersurat comment about this variable
     */
    public function __construct(HeaderSurat $headersurat)
    {
        $this->headersurat = $headersurat;
    }
}
