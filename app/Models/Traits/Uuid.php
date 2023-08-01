<?php
/**
 * Trait File.
 *
 * PHP Version 8.0
 *
 * @category Trait
 * @package  Trait
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Models\Traits;

use Ramsey\Uuid\Uuid as PackageUuid;

/**
 * Trait Uuid.
 *
 * @category Trait
 * @package  Trait
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
trait Uuid
{
    /**
     * Get uuid
     *
     * @param $query comment about this variable
     * @param $uuid  comment about this variable
     *
     * @return mixed
     */
    public function scopeUuid($query, $uuid)
    {
        return $query->where($this->getUuidName(), $uuid);
    }

    /**
     * Get UserName
     *
     * @return string
     */
    public function getUuidName()
    {
        return property_exists($this, 'uuidName') ? $this->uuidName : 'uuid';
    }

    /**
     * Use Laravel bootable traits.
     *
     * @return bootUuid
     */
    protected static function bootUuid()
    {
        static::creating(
            function ($model) {
                $model->{$model->getUuidName()} = PackageUuid::uuid4()->toString();
            }
        );
    }
}
