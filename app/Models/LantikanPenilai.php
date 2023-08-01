<?php
/**
 * LantikanPenilai File
 *
 * PHP Version 8.0
 *
 * @category LantikanPenilai
 * @package  LantikanPenilai
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class LantikanPenilai
 *
 * @category LantikanPenilai
 * @package  LantikanPenilai
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LantikanPenilai extends Model
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
    protected $table = 'memo_lantikan_penilai';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['text_1', 'text_2', 'text_3', 'text_4', 'moto_1', 'sym'];

}
