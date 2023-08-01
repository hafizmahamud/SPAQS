<?php
/**
 * AlamatCreated File.
 *
 * PHP Version 8.0
 *
 * @category AlamatCreated
 * @package  AlamatCreated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Alamat;

use App\Models\SenaraiAlamat;
use Illuminate\Queue\SerializesModels;

/**
 * Class AlamatCreated.
 *
 * @category AlamatCreated
 * @package  AlamatCreated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AlamatCreated
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
