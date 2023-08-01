<?php
/**
 * LantikanPenilai File.
 *
 * PHP Version 8.0
 *
 * @category LantikanPenilai
 * @package  LantikanPenilai
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Template\LantikanPenilai\LantikanPenilaiUpdated;
use App\Models\LantikanPenilai;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class LantikanPenilai.
 *
 * @category LantikanPenilai
 * @package  LantikanPenilai
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LantikanPenilaiService extends BaseService
{
    /**
     * LantikanPenilai constructor.
     *
     * @param LantikanPenilai $lantikanpenilai comment about this variable
     */
    public function __construct(LantikanPenilai $lantikanpenilai)
    {
        $this->model = $lantikanpenilai;
    }

    /**
     * Function update
     *
     * @param LantikanPenilai $lantikanpenilai comment about this variable
     * @param array           $data            comment about this variable
     *
     * @return lantikanpenilai
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(LantikanPenilai $lantikanpenilai, array $data = []): LantikanPenilai
    {
        DB::beginTransaction();

        try {
            $lantikanpenilai->update(
                [
                    'text_1' => $data['text_1'],
                    'text_2' => $data['text_2'],
                    'text_3' => $data['text_3'],
                    'text_4' => $data['text_4'],
                    'moto_1' => $data['moto_1'],
                    'sym' => $data['sym'],

                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            // throw new GeneralException(__($e));
            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new LantikanPenilaiUpdated($lantikanpenilai));

        DB::commit();

        return $lantikanpenilai;
    }

}
