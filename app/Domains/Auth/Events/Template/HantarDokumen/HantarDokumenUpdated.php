<?php
/**
 * HantarDokumenUpdated File.
 *
 * PHP Version 8.0
 *
 * @category HantarDokumenUpdated
 * @package  HantarDokumenUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Template\HantarDokumen;

use App\Models\HantarDokumen;
use Illuminate\Queue\SerializesModels;

/**
 * Class HantarDokumenUpdated.
 *
 * @category HantarDokumenUpdated
 * @package  HantarDokumenUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class HantarDokumenUpdated
{
    use SerializesModels;

    /**
     * Declare pelantikan
     *
     * @var
     */
    public $hantardokumen;

    /**
     * Constructor HantarDokumen
     *
     * @param $hantardokumen comment about this variable
     */
    public function __construct(HantarDokumen $hantardokumen)
    {
        $this->hantardokumen = $hantardokumen;
    }
}
