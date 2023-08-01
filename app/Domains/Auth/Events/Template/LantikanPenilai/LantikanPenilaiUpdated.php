<?php
/**
 * LantikanPenilaiUpdated File.
 *
 * PHP Version 8.0
 *
 * @category LantikanPenilaiUpdated
 * @package  LantikanPenilaiUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Template\LantikanPenilai;

use App\Models\LantikanPenilai;
use Illuminate\Queue\SerializesModels;

/**
 * Class LantikanPenilaiUpdated.
 *
 * @category LantikanPenilaiUpdated
 * @package  LantikanPenilaiUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LantikanPenilaiUpdated
{
    use SerializesModels;

    /**
     * Declare lantikanpenilai
     *
     * @var
     */
    public $lantikanpenilai;

    /**
     * Constructor LantikanPenilai
     *
     * @param $lantikanpenilai comment about this variable
     */
    public function __construct(LantikanPenilai $lantikanpenilai)
    {
        $this->lantikanpenilai = $lantikanpenilai;
    }
}
