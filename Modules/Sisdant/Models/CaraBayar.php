<?php
/**
 * CaraBayar File
 *
 * PHP Version 8.0
 *
 * @category CaraBayar
 * @package  CaraBayar
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class CaraBayar
 *
 * @category CaraBayar
 * @package  CaraBayar
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class CaraBayar extends Model
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
    protected $table = 'cara_bayar';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['nama'];
}
