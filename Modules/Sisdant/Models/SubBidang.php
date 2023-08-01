<?php
/**
 * SubBidang File.
 *
 * PHP Version 8.0
 *
 * @category SubBidang
 * @package  SubBidang
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\Bidang;

/**
 * SubBidang File.
 *
 * PHP Version 8.0
 *
 * @category SubBidang
 * @package  SubBidang
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */

class SubBidang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sub_bidang';
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
    public $fillable = ['kod', 'sub_bidang', 'bidang_id'];

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }
}
