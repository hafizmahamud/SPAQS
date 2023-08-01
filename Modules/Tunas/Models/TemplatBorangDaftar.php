<?php
/**
 * TemplatBorangDaftar File
 *
 * PHP Version 8.0
 *
 * @category TemplatBorangDaftar
 * @package  TemplatBorangDaftar
 * @author   Aina Zuhairah <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Tunas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplatBorangDaftar
 *
 * @category TemplatBorangDaftar
 * @package  TemplatBorangDaftar
 * @author   Aina Zuhairah <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class TemplatBorangDaftar extends Model
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
    protected $table = 'templat_borang_daftar';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['iklan_perolehan_id', 'bahagian_1', 'bahagian_2', 'bahagian_3', 'bahagian_4', 'bahagian_5', 'bahagian_6', 'bahagian_7'];

}
