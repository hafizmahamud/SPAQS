<?php
/**
 * AlamatDeleted File.
 *
 * PHP Version 8.0
 *
 * @category AlamatDeleted
 * @package  AlamatDeleted
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Alamat;

use App\Models\SenaraiAlamat;
use Illuminate\Queue\SerializesModels;

/**
 * Class AlamatDeleted.
 *
 * @category AlamatDeleted
 * @package  AlamatDeleted
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AlamatDeleted
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
