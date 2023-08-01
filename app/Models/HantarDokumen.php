<?php
/**
 * HantarDokumen File
 *
 * PHP Version 8.0
 *
 * @category HantarDokumen
 * @package  HantarDokumen
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class HantarDokumen
 *
 * @category HantarDokumen
 * @package  HantarDokumen
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class HantarDokumen extends Model
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
    protected $table = 'surat_hantar_dokumen';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['rujukan', 'alamat', 'up', 'title', 'tajuk', 'text_1', 'text_2', 'text_3', 'text_4', 'moto', 'sym'];

}
