<?php
/**
 * HantarDokumenService File.
 *
 * PHP Version 8.0
 *
 * @category HantarDokumenService
 * @package  HantarDokumenService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Template\HantarDokumen\HantarDokumenUpdated;
use App\Models\HantarDokumen;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class HantarDokumenService.
 *
 * @category HantarDokumenService
 * @package  HantarDokumenService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class HantarDokumenService extends BaseService
{
    /**
     * HantarDokumenService constructor.
     *
     * @param HantarDokumen $hantardokumen comment about this variable
     */
    public function __construct(HantarDokumen $hantardokumen)
    {
        $this->model = $hantardokumen;
    }

    /**
     * Function update
     *
     * @param HantarDokumen $hantardokumen comment about this variable
     * @param array         $data          comment about this variable
     *
     * @return hantardokumen
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(HantarDokumen $hantardokumen, array $data = []): HantarDokumen
    {
        DB::beginTransaction();

        try {
            $hantardokumen->update(
                [
                    'rujukan' => $data['rujukan'],
                    'alamat' => $data['alamat'],
                    'up' => $data['up'],
                    'title' => $data['title'],
                    'tajuk' => $data['tajuk'],
                    'text_1' => $data['text_1'],
                    'text_2' => $data['text_2'],
                    'text_3' => $data['text_3'],
                    'moto' => $data['moto'],
                    'sym' => $data['sym'],
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            // throw new GeneralException(__($e));
            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new HantarDokumenUpdated($hantardokumen));

        DB::commit();

        return $hantardokumen;
    }

}
