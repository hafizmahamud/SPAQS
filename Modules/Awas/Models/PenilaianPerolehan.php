<?php
/**
 * PenilaianPerolehan File.
 *
 * PHP Version 8.0
 *
 * @category PenilaianPerolehan
 * @package  PenilaianPerolehan
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Awas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\IklanPerolehan;
use Modules\Awas\Models\DokumenSST;
use App\Domains\Auth\Models\User;
use Modules\Tunas\Models\BorangDaftarMinat;

/**
 * PenilaianPerolehan File.
 *
 * PHP Version 8.0
 *
 * @category PenilaianPerolehan
 * @package  PenilaianPerolehan
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class PenilaianPerolehan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penilaian_perolehan';
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
        'iklan_perolehan_id',
        'tempoh_sah_laku',
        'tarikh_sah_laku',
        'tarikh_lantik_penilai',
        'user_id',
        'tarikh_laporan_tender',
        'tarikh_mesy_lembaga',
        'bil_mesy',
        'tarikh_result',
        'tarikh_terima_result',
        'tarikh_edar_result',
        'keputusan_akhir',
        'harga',
        'tempoh',
        'catatan',
        'status_penilaian',
        'no_pengesyoran',
        'tarikh_serah_dokumen_penilaian',
        'ketua_penilai',
        'pegawai_penilai_1',
        'pegawai_penilai_2',
        'penyedia',
        'no_rujukan',
        'tempoh_sedia_lt',
        'nama_syarikat',
        'storage_memo_keputusan',
        'nama_memo_keputusan',
        'storage_surat_keputusan',
        'nama_surat_keputusan',
        'alamat',
        'alamat2',
        'alamat3',
        'bandar',
        'poskod',
        'negeri'
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
    public function dokumenSST()
    {
        return $this->hasMany(DokumenSST::class, 'penilaian_perolehan_id');
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'pegawai_penilai_1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'pegawai_penilai_2');
    }

    public function borangDaftarMinat()
    {
        return $this->belongsTo(BorangDaftarMinat::class, 'keputusan_akhir');
    }
}
