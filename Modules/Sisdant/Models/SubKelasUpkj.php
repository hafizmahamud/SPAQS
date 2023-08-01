<?php
/**
 * SubKelasUpkj File.
 *
 * PHP Version 8.0
 *
 * @category SubKelasUpkj
 * @package  SubKelasUpkj
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\KelasUpkj;

/**
 * SubKelasUpkj File.
 *
 * PHP Version 8.0
 *
 * @category SubKelasUpkj
 * @package  SubKelasUpkj
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SubKelasUpkj extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subkelas_upkj';
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
    public $fillable = ['tajuk_id', 'keterangan','tajuk_kecil'];

    public function kelasUpkj()
    {
        return $this->belongsTo(KelasUpkj::class, 'tajuk_id');
    }
}
