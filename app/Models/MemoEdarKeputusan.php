<?php
/**
 * MemoEdarKeputusan File
 *
 * PHP Version 8.0
 *
 * @category MemoEdarKeputusan
 * @package  MemoEdarKeputusan
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class MemoEdarKeputusan
 *
 * @category MemoEdarKeputusan
 * @package  MemoEdarKeputusan
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MemoEdarKeputusan extends Model
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
    protected $table = 'memo_edar_keputusan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['rujukan', 'perkara', 'tajuk', 'kementerian', 'kementerian1', 'text_1', 'title', 'text_3', 'moto', 'sym'];

}
