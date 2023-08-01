<?php
/**
 * SelesaiTugas File
 *
 * PHP Version 8.0
 *
 * @category SelesaiTugas
 * @package  SelesaiTugas
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class SelesaiTugas
 *
 * @category SelesaiTugas
 * @package  SelesaiTugas
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SelesaiTugas extends Model
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
    protected $table = 'surat_akuan_selesai_tugas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['tajuk', 'text_1', 'text_2', 'text_3', 'text_4', 'text_5', 'text_6', 'text_7', 'text_8'];


}
