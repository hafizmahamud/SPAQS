<?php
/**
 * BorangDaftarMinat File
 *
 * PHP Version 8.0
 *
 * @category BorangDaftarMinat
 * @package  BorangDaftarMinat
 * @author   Aina Zuhairah <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Tunas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Awas\Models\PenilaianPerolehan;
use Modules\Tunas\Models\JadualHarga;
use Modules\Sisdant\Models\Grade;

/**
 * Class BorangDaftarMinat
 *
 * @category BorangDaftarMinat
 * @package  BorangDaftarMinat
 * @author   Aina Zuhairah <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BorangDaftarMinat extends Model
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
    protected $table = 'borang_daftar_minat';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['iklan_perolehan_id', 'kehadiran_lawatan_tapak_id', 'nama_syarikat' ,'nama_pegawai','telno_fax','telno_fon', 'alamat_syarikat', 'emel_rasmi', 'no_mof', 'tarikh_tamat_mof', 'kod_sub_bidang_mof'
                        ,'doc_sijil_mof_path','doc_sijil_mof_nama','no_cidb','tarikh_tamat_cidb','kelas_pengkhususan_cidb','doc_sijil_cidb_path' ,'doc_sijil_cidb_nama', 'no_syarikat'
                        ,'doc_sijil_kebenaran_khas_path','doc_sijil_kebenaran_khas_nama','no_sijil_spkk','tarikh_tamat_spkk','doc_sijil_spkk_path','doc_sijil_spkk_nama'
                        ,'no_sijil_pukonsa','tarikh_tamat_pukonsa','doc_sijil_pukonsa_path','doc_sijil_pukonsa_nama'
                        ,'no_sijil_upkj','tarikh_tamat_upkj','doc_sijil_upkj_path','doc_sijil_upkj_nama','tarikh_tamat_sij_bumiputera'
                        ,'doc_sijil_sij_bumiputera_path','doc_sijil_sij_bumiputera_nama', 'status_petender' ,'no_siri', 'status_emel', 'grade_id'
                        ,'resit_path','resit','status_resit', 'no_sijil_sij_bumiputera', 'gred_kontraktor_pukonsa', 'gred_kontraktor_upkj'];

    protected $casts = [
        'kod_sub_bidang_mof' => 'json',
        'kelas_pengkhususan_cidb' => 'json',
        'gred_kontraktor_pukonsa' => 'json',
        'gred_kontraktor_upkj' => 'json'
    ];

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function lawatanTapak()
    {
        return $this->belongsTo(KehadiranLawatanTapak::class, 'kehadiran_lawatan_tapak_id');
    }

    public function iklanPerolehan()
    {
        return $this->belongsTo(IklanPerolehan::class, 'iklan_perolehan_id');
    }

    public function penilaianPerolehan()
    {
        return $this->hasMany(PenilaianPerolehan::class, 'keputusan_akhir');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function jadualharga()
    {
        return $this->hasMany(JadualHarga::class, 'syarikat_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


}
