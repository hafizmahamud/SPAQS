<?php
/**
 * SubKelasPukonsa File.
 *
 * PHP Version 8.0
 *
 * @category SubKelasPukonsa
 * @package  SubKelasPukonsa
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * SubKelasPukonsa File.
 *
 * PHP Version 8.0
 *
 * @category SubKelasPukonsa
 * @package  SubKelasPukonsa
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SubKelasPukonsa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subkelas_pukonsa';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['tajuk_id', 'keterangan','tajuk_kecil'];
}
