<?php
/**
 * AnnouncementScope File.
 *
 * PHP Version 8.0
 *
 * @category AnnouncementScope
 * @package  AnnouncementScope
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Announcement\Models\Traits\Scope;

/**
 * Class AnnouncementScope.
 *
 * @category AnnouncementScope
 * @package  AnnouncementScope
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
trait AnnouncementScope
{
    /**
     * Scope Enable
     *
     * @param $query comment about this variable
     *
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->whereEnabled(true);
    }

    /**
     * Scope for area
     *
     * @param $query comment about this variable
     * @param $area  comment about this variable
     *
     * @return mixed
     */
    public function scopeForArea($query, $area)
    {
        return $query->where(
            function ($query) use ($area) {
                $query->whereArea($area)
                    ->orWhereNull('area');
            }
        );
    }

    /**
     * Scope In Time Frame
     *
     * @param $query comment about this variable
     *
     * @return mixed
     */
    public function scopeInTimeFrame($query)
    {
        return $query->where(
            function ($query) {
                $query->where(
                    function ($query) {
                        $query->whereNull('starts_at')
                            ->whereNull('ends_at');
                    }
                )->orWhere(
                    function ($query) {
                        $query->whereNotNull('starts_at')
                            ->whereNotNull('ends_at')
                            ->where('starts_at', '<=', now())
                            ->where('ends_at', '>=', now());
                    }
                )->orWhere(
                    function ($query) {
                        $query->whereNotNull('starts_at')
                            ->whereNull('ends_at')
                            ->where('starts_at', '<=', now());
                    }
                )->orWhere(
                    function ($query) {
                        $query->whereNull('starts_at')
                            ->whereNotNull('ends_at')
                            ->where('ends_at', '>=', now());
                    }
                );
            }
        );
    }
}
