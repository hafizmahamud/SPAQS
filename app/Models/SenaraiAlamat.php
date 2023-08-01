<?php
/**
 * SenaraiAlamat File
 *
 * PHP Version 8.0
 *
 * @category SenaraiAlamat
 * @package  SenaraiAlamat
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class SenaraiAlamat
 *
 * @category SenaraiAlamat
 * @package  SenaraiAlamat
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SenaraiAlamat extends Model
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
    protected $table = 'senarai_alamat';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['jenis_alamat', 'alamat'];
}
