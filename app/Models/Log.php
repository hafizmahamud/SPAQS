<?php
/**
 * Log File
 *
 * PHP Version 8.0
 *
 * @category Log
 * @package  Log
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Log
 *
 * @category Log
 * @package  Log
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class Log extends Model
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
    protected $table = 'activity_log';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
      'log_name', 
      'description',
      'created_at',
    ];

}
