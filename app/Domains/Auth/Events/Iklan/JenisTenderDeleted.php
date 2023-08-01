<?php
// phpcs:ignoreFile -- this fail is generated by Laravel
namespace App\Domains\Auth\Events\Iklan;

use Modules\Sisdant\Models\JenisTender;
use Illuminate\Queue\SerializesModels;

/**
 * Class JenisTenderDeleted.
 */
class JenisTenderDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $jenisTender;

    /**
     * @param $jenisTender
     */
    public function __construct(JenisTender $jenisTender)
    {
        $this->jenisTender = $jenisTender;
    }
}
