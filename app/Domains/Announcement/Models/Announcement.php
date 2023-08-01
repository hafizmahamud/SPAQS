<?php
/**
 * Announcement File.
 *
 * PHP Version 8.0
 *
 * @category Announcement
 * @package  Announcement
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Announcement\Models;

use App\Domains\Announcement\Models\Traits\Scope\AnnouncementScope;
use Database\Factories\AnnouncementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Announcement.
 *
 * @category Announcement
 * @package  Announcement
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class Announcement extends Model
{
    use AnnouncementScope,
        HasFactory,
        LogsActivity;

    public const TYPE_FRONTEND = 'frontend';
    public const TYPE_BACKEND = 'backend';

    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    /**
     * Fillable column
     *
     * @var string[]
     */
    protected $fillable = [
        'area',
        'type',
        'message',
        'enabled',
        'starts_at',
        'ends_at',
    ];

    /**
     * Date
     *
     * @var string[]
     */
    protected $dates = [
        'starts_at',
        'ends_at',
    ];

    /**
     * Cast
     *
     * @var string[]
     */
    protected $casts = [
        'enabled' => 'boolean',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AnnouncementFactory::new();
    }
}
