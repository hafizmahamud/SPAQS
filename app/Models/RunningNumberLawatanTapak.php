<?php
/**
 * RunningNumberLawatanTapak File.
 *
 * PHP Version 8.0
 *
 * @category RunningNumberLawatanTapak
 * @package  RunningNumberLawatanTapak
 * @author   Maya Shihabudin <maya@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * RunningNumberLawatanTapak File.
 *
 * PHP Version 8.0
 *
 * @category RunningNumberLawatanTapak
 * @package  RunningNumberLawatanTapak
 * @author   Maya Shihabudin <maya@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class RunningNumberLawatanTapak extends Model
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
    protected $table = 'running_number_lawatantapak';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['running_number', 'iklan_perolehan_id'];
}
