<?php
/**
 * SelesaiTugasUpdated File.
 *
 * PHP Version 8.0
 *
 * @category SelesaiTugasUpdated
 * @package  SelesaiTugasUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Template\SelesaiTugas;

use App\Models\SelesaiTugas;
use Illuminate\Queue\SerializesModels;

/**
 * Class SelesaiTugasUpdated.
 *
 * @category SelesaiTugasUpdated
 * @package  SelesaiTugasUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SelesaiTugasUpdated
{
    use SerializesModels;

    /**
     * Declare selesaitugas
     *
     * @var
     */
    public $selesaitugas;

    /**
     * Constructor SelesaiTugas
     *
     * @param $selesaitugas comment about this variable
     */
    public function __construct(SelesaiTugas $selesaitugas)
    {
        $this->selesaitugas = $selesaitugas;
    }
}
