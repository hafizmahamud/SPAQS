<?php
// phpcs:ignoreFile -- this fail is generated by Laravel
namespace Modules\Sisdant\Models;
use App\Domains\Auth\Models\User;
use App\Models\Pejabat;
use App\Models\Negeri;
use Modules\Sisdant\Models\MatrikIklan;
use Modules\Sisdant\Models\KategoriIklan;
use Modules\Sisdant\Models\IklanPerolehan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JenisIklan.
 */
class PermohonanNomborPerolehan extends Model
{
    use HasFactory;
    protected $table = 'mohon_no_perolehan';
    protected $primaryKey = 'id_perolehan';
    protected $fillable = ['matrik_iklan_id', 'tahun_perolehan','tajuk_perolehan','tarikh_jangka_iklan','user_id','section_id','negeri_id','no_perolehan','dokumen_muatnaik', 'nama_dokumen','status', 'dokumen_batal','justifikasi_batal','kategori_iklan_id','updated_at', 'created_at'];

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function negeri()
    {
        return $this->belongsTo(Negeri::class, 'negeri_id');
    }

    /**
     * Function for belongs to relationship
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Function for belongs to relationship
     */
    public function section()
    {
        return $this->belongsTo(Pejabat::class, 'section_id');
    }

    /**
     * Function for belongs to relationship
     */
    public function matrikIklan()
    {
        return $this->belongsTo(MatrikIklan::class, 'matrik_iklan_id');
    }

    /**
     * Function for belongs to relationship
     */
    public function kategoriIklan()
    {
        return $this->belongsTo(KategoriIklan::class, 'kategori_iklan_id');
    }

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function iklanPerolehan()
    {
        return $this->hasOne(IklanPerolehan::class, 'mohon_no_perolehan_id');
    }
}
