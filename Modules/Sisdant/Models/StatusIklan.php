<?php
/**
 * StatusIklan File
 *
 * PHP Version 8.0
 *
 * @category StatusIklan
 * @package  StatusIklan
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace Modules\Sisdant\Models;
use Modules\Sisdant\Models\IklanPerolehan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StatusIklan
 *
 * @category StatusIklan
 * @package  StatusIklan
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class StatusIklan extends Model
{
    use HasFactory;
    protected $table = 'status_iklan';
    protected $fillable = [
        'id',
        'status',
        'deskripsi'
    ];

    /**
     * Processes this sniff, when one of its tokens is encountered
     *
     * @return foreign data
     */
    public function iklanPerolehan()
    {
        return $this->hasMany(IklanPerolehan::class, 'id');
    }
}
