<?php
/**
 * IklanPerolehan File
 *
 * PHP Version 8.0
 *
 * @category IklanPerolehan
 * @package  IklanPerolehan
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use App\Domains\Auth\Models\User;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Sisdant\Models\MatrikIklan;
use Modules\Sisdant\Models\KelasPengkhususan;
use Modules\Sisdant\Models\BidangSubbidang;
use Modules\Sisdant\Models\StatusIklan;
use Modules\Sisdant\Models\CaraBayar;
use Modules\Sisdant\Models\Grade;
use Modules\Tunas\Models\KehadiranLawatanTapak;
use App\Models\SenaraiAlamat;
use Modules\Sisdant\Models\BayarKepada;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Tunas\Models\BorangDaftarMinat;
use Modules\Tunas\Models\JadualHarga;
use Modules\Awas\Models\DokumenKontrak;

/**
 * Class IklanPerolehan
 *
 * @category IklanPerolehan
 * @package  IklanPerolehan
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class IklanPerolehan extends Model
{
    use HasFactory;
    protected $table = 'iklan_perolehan';
    protected $fillable = [
        'id',
        'user_id',
        'mohon_no_perolehan_id',
        'tarikh_mula_jual',
        'tarikh_akhir_jual',
        'pejabat_pamer_jual',
        'tarikh_lawatan_tapak',
        'lawatan_tapak',
        'pejabat_lapor',
        'waktu_lapor',
        'harga_dokumen',
        'cara_bayaran_id',
        'bayar_kepada_id',
        'lokasi_tapak',
        'peti_tender',
        'tarikh_keluar_iklan',
        'tarikh_waktu_tutup',
        'status_iklan_id',
        'justifikasi_batal',
        'dokumen_batal',
        'status_kemaskini',
        'updated_at',
        'created_at',
        'borang_daftar',
        'grade_id',
        'dibatalkan_oleh',
        'tarikh_batal',
        'tarikh_kemaskini_penilaian',
        'taklimat_tender',
        'tarikh_taklimat_tender',
        'tarikh_tutup_list'
    ];

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function pegawaiBatal()
    {
        return $this->belongsTo(User::class, 'dibatalkan_oleh');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function mohonNoPerolehan()
    {
        return $this->belongsTo(PermohonanNomborPerolehan::class, 'mohon_no_perolehan_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function statusIklan()
    {
        return $this->belongsTo(StatusIklan::class, 'status_iklan_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function kelasPengkhususan()
    {
        return $this->hasMany(KelasPengkhususan::class, 'id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function bidangSubbidang()
    {
        return $this->hasMany(BidangSubbidang::class, 'id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function kehadiranLawatanTapak()
    {
        return $this->hasMany(KehadiranLawatanTapak::class, 'iklan_perolehan_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function caraBayar()
    {
        return $this->belongsTo(CaraBayar::class, 'cara_bayaran_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function pejabatPamer()
    {
        return $this->belongsTo(SenaraiAlamat::class, 'pejabat_pamer_jual');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function pejabatLapor()
    {
        return $this->belongsTo(SenaraiAlamat::class, 'pejabat_lapor');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function bayarKepada()
    {
        return $this->belongsTo(BayarKepada::class, 'bayar_kepada_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function petiTender()
    {
        return $this->belongsTo(SenaraiAlamat::class, 'peti_tender');
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

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function borangDaftarMinat()
    {
        return $this->hasMany(BorangDaftarMinat::class, 'iklan_perolehan_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function borangDaftarMinatBerjaya()
    {
        return $this->hasMany(BorangDaftarMinat::class, 'iklan_perolehan_id')->where('status_petender','berjaya');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function jadualHarga()
    {
        return $this->hasMany(JadualHarga::class, 'iklan_perolehan_id');
    }

        /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function dokumenKontrak()
    {
        return $this->hasMany(DokumenKontrak::class, 'iklan_perolehan_id');
    }
}
