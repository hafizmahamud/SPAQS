<?php
/**
 * BidangSubbidang File
 *
 * PHP Version 8.0
 *
 * @category BidangSubbidang
 * @package  BidangSubbidang
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Modules\Sisdant\Models\KelasPengkhususan;
use Modules\Sisdant\Models\Bidang;
use Modules\Sisdant\Models\SubBidang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BidangSubbidang
 *
 * @category BidangSubbidang
 * @package  BidangSubbidang
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BidangSubbidang extends Model
{
    use HasFactory;
    protected $table = 'bidang_subbidang';
    protected $fillable = [
        'id',
        'iklan_perolehan_id',
        'bidang_id',
        'sub_bidang_id',
        'updated_at',
        'created_at'
    ];

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function subbidang()
    {
        return $this->belongsTo(SubBidang::class, 'sub_bidang_id');
    }
}
