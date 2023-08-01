<?php
/**
 * AlamatUpdated File.
 *
 * PHP Version 8.0
 *
 * @category AlamatUpdated
 * @package  AlamatUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Alamat;

use App\Models\SenaraiAlamat;
use Illuminate\Queue\SerializesModels;

/**
 * Class AlamatUpdated
 *
 * @category AlamatUpdated
 * @package  AlamatUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AlamatUpdated
{
    use SerializesModels;

    /**
     * Declare alamat
     *
     * @var
     */
    public $alamat;

    /**
     * Function construct
     *
     * @param $alamat comment about this variable
     */
    public function __construct(SenaraiAlamat $alamat)
    {
        $this->alamat = $alamat;
    }
}
