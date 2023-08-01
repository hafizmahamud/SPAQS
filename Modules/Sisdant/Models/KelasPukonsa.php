<?php
/**
 * KelasPukonsa File.
 *
 * PHP Version 8.0
 *
 * @category KelasPukonsaPukonsa
 * @package  KelasPukonsa
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\SubKelasPukonsa;

/**
 * KelasPukonsa File.
 *
 * PHP Version 8.0
 *
 * @category KelasPukonsa
 * @package  KelasPukonsa
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class KelasPukonsa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelas_pukonsa';
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
    public $fillable = ['tajuk', 'keterangan'];

    public function subPukonsa()
    {
        return $this->hasMany(SubKelasPukonsa::class, 'tajuk_id');
    }

}
