<?php
/**
 * KelasPengkhususan File
 *
 * PHP Version 8.0
 *
 * @category KelasPengkhususan
 * @package  KelasPengkhususan
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\Kelas;
use Modules\Sisdant\Models\Pengkhususan;

/**
 * Class KelasPengkhususan
 *
 * @category KelasPengkhususan
 * @package  KelasPengkhususan
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class KelasPengkhususan extends Model
{
    use HasFactory;
    protected $table = 'kelas_pengkhususan';
    protected $fillable = [
        'id',
        'iklan_perolehan_id',
        'kelas_id',
        'pengkhususan_id',
        'updated_at',
        'created_at'
    ];

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function khusus()
    {
        return $this->belongsTo(Pengkhususan::class, 'pengkhususan_id');
    }

}
