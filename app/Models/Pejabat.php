<?php
/**
 * Pejabat File
 *
 * PHP Version 8.0
 *
 * @category Pejabat
 * @package  Pejabat
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models;

use Database\Factories\PejabatFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Negeri;
use App\Domains\Auth\Models\User;
/**
 * Class Pejabat
 *
 * @category Pejabat
 * @package  Pejabat
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class Pejabat extends Model
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
    protected $table = 'pejabat';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['bahagian', 'singkatan', 'negeri_id'];
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
     * The attributes that are mass assignable.
     *
     * @return foreign data
     */
    public function user()
    {
        return $this->hasMany(User::class, 'negeri_id');
    }
}
