<?php
/**
 * AkuanPelantikan File.
 *
 * PHP Version 8.0
 *
 * @category AkuanPelantikan
 * @package  AkuanPelantikan
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Template\AkuanPelantikan\AkuanPelantikanUpdated;
use App\Models\Pelantikan;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class AkuanPelantikan.
 *
 * @category AkuanPelantikan
 * @package  AkuanPelantikan
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AkuanPelantikanService extends BaseService
{
    /**
     * AkuanPelantikan constructor.
     *
     * @param Pelantikan $pelantikan comment about this variable
     */
    public function __construct(Pelantikan $pelantikan)
    {
        $this->model = $pelantikan;
    }

    /**
     * Function update
     *
     * @param Pelantikan $pelantikan comment about this variable
     * @param array      $data       comment about this variable
     *
     * @return lantikan
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(Pelantikan $pelantikan, array $data = []): Pelantikan
    {
        DB::beginTransaction();

        try {
            $pelantikan->update(
                [
                    'tajuk' => $data['tajuk'],
                    'text_1' => $data['text_1'],
                    'text_2' => $data['text_2'],
                    'text_3' => $data['text_3'],
                    'text_4' => $data['text_4'],
                    'text_5' => $data['text_5'],
                    'text_6' => $data['text_6'],
                    'text_7' => $data['text_7'],
                    'text_8' => $data['text_8'],
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            // throw new GeneralException(__($e));
            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new AkuanPelantikanUpdated($pelantikan));

        DB::commit();

        return $pelantikan;
    }

}
