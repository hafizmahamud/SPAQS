<?php
/**
 * Bidang File.
 *
 * PHP Version 8.0
 *
 * @category Bidang
 * @package  Bidang
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\SubBidang;

/**
 * Bidang File.
 *
 * PHP Version 8.0
 *
 * @category Bidang
 * @package  Bidang
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class Bidang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bidang';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['kod', 'bidang'];

    public function subBidang()
    {
        return $this->hasMany(SubBidang::class, 'bidang_id');
    }

}
