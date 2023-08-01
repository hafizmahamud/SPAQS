<?php
/**
 * Negeri File
 *
 * PHP Version 8.0
 *
 * @category RunningNoPerolehan
 * @package  RunningNoPerolehan
 * @author   Aina Zuhairah <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Negeri
 *
 * @category RunningNoPerolehan
 * @package  RunningNoPerolehan
 * @author   Aina Zuhairah <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class RunningNoPerolehan extends Model
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
    protected $table = 'running_no_perolehan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['running_no', 'jenis_iklan_id', 'kategori_perolehan_id', 'negeri_id', 'bahagian_id', 'year', 'code'];
}
