<?php
/**
 * DokumenKontrak File.
 *
 * PHP Version 8.0
 *
 * @category DokumenKontrak
 * @package  DokumenKontrak
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Awas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\IklanPerolehan;
use App\Models\User;

/**
 * DokumenKontrak File.
 *
 * PHP Version 8.0
 *
 * @category DokumenKontrak
 * @package  DokumenKontrak
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class DokumenKontrak extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dokumen_kontrak';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'iklan_perolehan_id',
        'tarikh_sah_laku',
        'tarikh_sst',
        'nama_petender',
        'harga',
        'tempoh',
        'tarikh_sign_sst',
        'user_id',
        'pejabat_id',
        'tarikh_sign_dokumen_kontrak',
        'created_at',
        'updated_at',
        'status',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
