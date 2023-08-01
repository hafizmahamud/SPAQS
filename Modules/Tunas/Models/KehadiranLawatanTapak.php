<?php
/**
 * KehadiranLawatanTapak File.
 *
 * PHP Version 8.0
 *
 * @category KehadiranLawatanTapak
 * @package  KehadiranLawatanTapak
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Tunas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\IklanPerolehan;

/**
 * KehadiranLawatanTapak File.
 *
 * PHP Version 8.0
 *
 * @category KehadiranLawatanTapak
 * @package  KehadiranLawatanTapak
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class KehadiranLawatanTapak extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kehadiran_lawatan_tapak';
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
        'name_syarikat',
        'no_syarikat',
        'nama_pegawai_ditauliah',
        'jawatan',
        'emel',
        'notel',
        'nofax',
        'alamat',
        'tarikh_masa',
        'no_siri'
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
