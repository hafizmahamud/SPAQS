<?php
/**
 * SuratKeputusanService File.
 *
 * PHP Version 8.0
 *
 * @category SuratKeputusanService
 * @package  SuratKeputusanService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Template\SuratKeputusan\SuratKeputusanUpdated;
use App\Models\SuratEdarKeputusan;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class SuratKeputusanService.
 *
 * @category SuratKeputusanService
 * @package  SuratKeputusanService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SuratKeputusanService extends BaseService
{
    /**
     * SuratKeputusanService constructor.
     *
     * @param SuratEdarKeputusan $suratedarkeputusan comment about this variable
     */
    public function __construct(SuratEdarKeputusan $suratedarkeputusan)
    {
        $this->model = $suratedarkeputusan;
    }

    /**
     * Function update
     *
     * @param SuratEdarKeputusan $suratedarkeputusan comment about this variable
     * @param array              $data               comment about this variable
     *
     * @return suratedarkeputusan
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(SuratEdarKeputusan $suratedarkeputusan, array $data = []): SuratEdarKeputusan
    {
        DB::beginTransaction();

        try {
            $suratedarkeputusan->update(
                [
                    'rujukan' => $data['rujukan'],
                    'title' => $data['title'],
                    'kementerian' => $data['kementerian'],
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

        event(new SuratKeputusanUpdated($suratedarkeputusan));

        DB::commit();

        return $suratedarkeputusan;
    }

}
