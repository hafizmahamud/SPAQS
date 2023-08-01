<?php
/**
 * Kelas File.
 *
 * PHP Version 8.0
 *
 * @category Kelas
 * @package  Kelas
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Sisdant\Models\Pengkhususan;

/**
 * Kelas File.
 *
 * PHP Version 8.0
 *
 * @category Kelas
 * @package  Kelas
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class Kelas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelas';
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
    public $fillable = ['kod', 'kelas'];

    public function pengkhususan()
    {
        return $this->hasMany(Pengkhususan::class, 'kelas_id');
    }
}
