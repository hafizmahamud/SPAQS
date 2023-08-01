<?php
/**
 * BayarKepada File
 *
 * PHP Version 8.0
 *
 * @category BayarKepada
 * @package  BayarKepada
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class BayarKepada
 *
 * @category BayarKepada
 * @package  BayarKepada
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BayarKepada extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bayar_kepada';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['nama'];
}
