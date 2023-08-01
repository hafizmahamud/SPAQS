<?php
/**
 * IklanKelasPukonsa File
 *
 * PHP Version 8.0
 *
 * @category IklanKelasPukonsa
 * @package  IklanKelasPukonsa
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\SubKelasPukonsa;
use Modules\Sisdant\Models\KelasPukonsa;

/**
 * Class IklanKelasPukonsa
 *
 * @category IklanKelasPukonsa
 * @package  IklanKelasPukonsa
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class IklanKelasPukonsa extends Model
{
    use HasFactory;
    protected $table = 'iklan_kelaspukonsa';
    protected $fillable = [
        'id',
        'iklan_perolehan_id',
        'tajuk_id',
        'tajukkecil_id',
        'updated_at',
        'created_at'
    ];

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function kelas()
    {
        return $this->belongsTo(KelasPukonsa::class, 'tajuk_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function khusus()
    {
        return $this->belongsTo(SubKelasPukonsa::class, 'tajukkecil_id');
    }

}
