<?php
/**
 * KelasUpkj File.
 *
 * PHP Version 8.0
 *
 * @category KelasUpkj
 * @package  KelasUpkj
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\SubKelasUpkj;

/**
 * KelasUpkj File.
 *
 * PHP Version 8.0
 *
 * @category KelasUpkj
 * @package  KelasUpkj
 * @author   Aina <aina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class KelasUpkj extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelas_upkj';
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
    public $fillable = ['tajuk', 'keterangan'];

    public function subKelasUpkj()
    {
        return $this->hasMany(SubKelasUpkj::class, 'tajuk_id');
    }
}
