<?php
/**
 * SstUpdated File.
 *
 * PHP Version 8.0
 *
 * @category SstUpdated
 * @package  SstUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Template\SST;

use App\Models\TemplatSST;
use Illuminate\Queue\SerializesModels;

/**
 * Class SstUpdated.
 *
 * @category SstUpdated
 * @package  SstUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SstUpdated
{
    use SerializesModels;

    /**
     * Declare sst
     *
     * @var
     */
    public $sst;

    /**
     * Constructor TemplatSST
     *
     * @param $sst comment about this variable
     */
    public function __construct(TemplatSST $sst)
    {
        $this->sst = $sst;
    }
}
