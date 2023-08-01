<?php
/**
 * HeaderSurat File
 *
 * PHP Version 8.0
 *
 * @category HeaderSurat
 * @package  HeaderSurat
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class HeaderSurat
 *
 * @category HeaderSurat
 * @package  HeaderSurat
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class HeaderSurat extends Model
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
    protected $table = 'header_surat';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['jata_negara', 'img_memo', 'jabatan', 'kementerian', 'alamat', 'laman_web', 'no_tel', 'no_fax', 'email', 'path_jata_negara', 'path_img_memo'];

}
