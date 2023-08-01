<?php
/**
 * JadualHarga File.
 *
 * PHP Version 8.0
 *
 * @category JadualHarga
 * @package  JadualHarga
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Tunas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Tunas\Models\BorangDaftarMinat;

/**
 * JadualHarga File.
 *
 * PHP Version 8.0
 *
 * @category JadualHarga
 * @package  JadualHarga
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class JadualHarga extends Model
{
     /**
      * The table associated with the model.
      *
      * @var string
      */
    protected $table = 'jadual_harga';
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
    public $fillable = [
        'id',
        'iklan_perolehan_id',
        'syarikat_id',
        'rujukan',
        'harga',
        'tempoh',
        'bulan_minggu',
        'catatan',
    ];

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function iklanPerolehan()
    {
        return $this->belongsTo(IklanPerolehan::class, 'iklan_perolehan_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function syarikat()
    {
        return $this->belongsTo(BorangDaftarMinat::class, 'syarikat_id');
    }
}
