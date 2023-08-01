<?php
/**
 * AkuanPelantikanUpdated File.
 *
 * PHP Version 8.0
 *
 * @category AkuanPelantikanUpdated
 * @package  AkuanPelantikanUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Template\AkuanPelantikan;

use App\Models\Pelantikan;
use Illuminate\Queue\SerializesModels;

/**
 * Class AkuanPelantikanUpdated.
 *
 * @category AkuanPelantikanUpdated
 * @package  AkuanPelantikanUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AkuanPelantikanUpdated
{
    use SerializesModels;

    /**
     * Declare pelantikan
     *
     * @var
     */
    public $pelantikan;

    /**
     * Constructor Pelantikan
     *
     * @param $pelantikan comment about this variable
     */
    public function __construct(Pelantikan $pelantikan)
    {
        $this->pelantikan = $pelantikan;
    }
}
