<?php
/**
 * Roles File
 *
 * PHP Version 8.0
 *
 * @category Roles
 * @package  Roles
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Roles
 *
 * @category Roles
 * @package  Roles
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class Roles extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['type', 'name', 'guard_name', 'description'];

}
