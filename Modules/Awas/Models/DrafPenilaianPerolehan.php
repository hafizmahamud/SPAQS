<?php

namespace Modules\Awas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\IklanPerolehan;

class DrafPenilaianPerolehan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'draf_penilaian_perolehan';
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
        'penyedia'
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

}
