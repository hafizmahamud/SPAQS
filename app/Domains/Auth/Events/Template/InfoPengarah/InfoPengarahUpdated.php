<?php
/**
 * InfoPengarahUpdated File.
 *
 * PHP Version 8.0
 *
 * @category InfoPengarahUpdated
 * @package  InfoPengarahUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Template\InfoPengarah;

use App\Models\Tandatangan;
use Illuminate\Queue\SerializesModels;

/**
 * Class InfoPengarahUpdated.
 *
 * @category InfoPengarahUpdated
 * @package  InfoPengarahUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class InfoPengarahUpdated
{
    use SerializesModels;

    /**
     * Declare tandatangan
     *
     * @var
     */
    public $tandatangan;

    /**
     * Constructor Tandatangan
     *
     * @param $tandatangan comment about this variable
     */
    public function __construct(Tandatangan $tandatangan)
    {
        $this->tandatangan = $tandatangan;
    }
}
