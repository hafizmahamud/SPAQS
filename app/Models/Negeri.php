<?php
/**
 * Negeri File
 *
 * PHP Version 8.0
 *
 * @category Negeri
 * @package  Negeri
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use App\Models\Pejabat;
use App\Domains\Auth\Models\User;

/**
 * Class Negeri
 *
 * @category Negeri
 * @package  Negeri
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class Negeri extends Model
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
    protected $table = 'negeri';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['negeri', 'singkatan', 'alamat'];

    /**
     * The attributes that are mass assignable.
     *
     * @return foreign data
     */
    public function mohonNoPerolehan()
    {
        return $this->hasMany(PermohonanNomborPerolehan::class, 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @return foreign data
     */
    public function bahagian()
    {
        return $this->hasMany(Pejabat::class, 'negeri_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @return foreign data
     */
    public function user()
    {
        return $this->hasMany(User::class, 'negeri_id');
    }
}
