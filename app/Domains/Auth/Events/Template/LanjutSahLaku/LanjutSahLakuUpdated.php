<?php
/**
 * LanjutSahLakuUpdated File.
 *
 * PHP Version 8.0
 *
 * @category LanjutSahLakuUpdated
 * @package  LanjutSahLakuUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Template\LanjutSahLaku;

use App\Models\LanjutSahLaku;
use Illuminate\Queue\SerializesModels;

/**
 * Class LanjutSahLakuUpdated.
 *
 * @category LanjutSahLakuUpdated
 * @package  LanjutSahLakuUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LanjutSahLakuUpdated
{
    use SerializesModels;

    /**
     * Declare lanjutsahlaku
     *
     * @var
     */
    public $lanjutsahlaku;

    /**
     * Constructor LanjutSahLaku
     *
     * @param $lanjutsahlaku comment about this variable
     */
    public function __construct(LanjutSahLaku $lanjutsahlaku)
    {
        $this->lanjutsahlaku = $lanjutsahlaku;
    }
}
