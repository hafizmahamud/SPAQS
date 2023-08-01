<?php
/**
 * MemoKeputusanUpdated File.
 *
 * PHP Version 8.0
 *
 * @category MemoKeputusanUpdated
 * @package  MemoKeputusanUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Template\MemoKeputusan;

use App\Models\MemoEdarKeputusan;
use Illuminate\Queue\SerializesModels;

/**
 * Class MemoKeputusanUpdated.
 *
 * @category MemoKeputusanUpdated
 * @package  MemoKeputusanUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MemoKeputusanUpdated
{
    use SerializesModels;

    /**
     * Declare memoedarkeputusan
     *
     * @var
     */
    public $memoedarkeputusan;

    /**
     * Constructor MemoEdarKeputusan
     *
     * @param $memoedarkeputusan comment about this variable
     */
    public function __construct(MemoEdarKeputusan $memoedarkeputusan)
    {
        $this->memoedarkeputusan = $memoedarkeputusan;
    }
}
