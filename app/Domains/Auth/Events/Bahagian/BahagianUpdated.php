<?php
/**
 * BahagianUpdated File.
 *
 * PHP Version 8.0
 *
 * @category BahagianUpdated
 * @package  BahagianUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Bahagian;

use App\Models\Pejabat;
use Illuminate\Queue\SerializesModels;

/**
 * Class BahagianUpdated.
 *
 * @category BahagianUpdated
 * @package  BahagianUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BahagianUpdated
{
    use SerializesModels;

    /**
     * Declare bahagian
     *
     * @var
     */
    public $bahagian;

    /**
     * Constructor Pejabat
     *
     * @param $bahagian comment about this variable
     */
    public function __construct(Pejabat $bahagian)
    {
        $this->bahagian = $bahagian;
    }
}
