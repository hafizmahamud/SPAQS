<?php
/**
 * DokumenSST File.
 *
 * PHP Version 8.0
 *
 * @category DokumenSST
 * @package  DokumenSST
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Awas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Awas\Models\PenilaianPerolehan;

/**
 * DokumenSST File.
 *
 * PHP Version 8.0
 *
 * @category DokumenSST
 * @package  DokumenSST
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class DokumenSST extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dokumen_sst';
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
        'penilaian_perolehan_id',
        'nama_fail',
        'fail',
        'created_at'
    ];

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function PenilaianPerolehan()
    {
        return $this->belongsTo(PenilaianPerolehan::class, 'penilaian_perolehan_id');
    }

}
