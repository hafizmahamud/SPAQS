<?php
/**
 * SuratKeputusanUpdated File.
 *
 * PHP Version 8.0
 *
 * @category SuratKeputusanUpdated
 * @package  SuratKeputusanUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Events\Template\SuratKeputusan;

use App\Models\SuratEdarKeputusan;
use Illuminate\Queue\SerializesModels;

/**
 * Class SuratKeputusanUpdated.
 *
 * @category SuratKeputusanUpdated
 * @package  SuratKeputusanUpdated
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SuratKeputusanUpdated
{
    use SerializesModels;

    /**
     * Declare suratedarkeputusan
     *
     * @var
     */
    public $suratedarkeputusan;

    /**
     * Constructor SuratEdarKeputusan
     *
     * @param $suratedarkeputusan comment about this variable
     */
    public function __construct(SuratEdarKeputusan $suratedarkeputusan)
    {
        $this->suratedarkeputusan = $suratedarkeputusan;
    }
}
