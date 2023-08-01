<?php
/**
 * LanjutSahLakuService File.
 *
 * PHP Version 8.0
 *
 * @category LanjutSahLakuService
 * @package  LanjutSahLakuService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Template\LanjutSahLaku\LanjutSahLakuUpdated;
use App\Models\LanjutSahLaku;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class LanjutSahLakuService.
 *
 * @category LanjutSahLakuService
 * @package  LanjutSahLakuService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LanjutSahLakuService extends BaseService
{
    /**
     * LanjutSahLakuService constructor.
     *
     * @param LanjutSahLaku $lanjutsahlaku comment about this variable
     */
    public function __construct(LanjutSahLaku $lanjutsahlaku)
    {
        $this->model = $lanjutsahlaku;
    }

    /**
     * Function update
     *
     * @param LanjutSahLaku $lanjutsahlaku comment about this variable
     * @param array         $data          comment about this variable
     *
     * @return lanjutsahlaku
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(LanjutSahLaku $lanjutsahlaku, array $data = []): LanjutSahLaku
    {
        DB::beginTransaction();

        try {
            $lanjutsahlaku->update(
                [
                    'rujukan' => $data['rujukan'],
                    'alamat' => $data['alamat'],
                    'up' => $data['up'],
                    'title' => $data['title'],
                    'tajuk' => $data['tajuk'],
                    'text_1' => $data['text_1'],
                    'text_2' => $data['text_2'],
                    'moto' => $data['moto'],
                    'sym' => $data['sym'],
                    'nama' => $data['nama'],
                    'jawatan' => $data['jawatan'],
                    'kementerian' => $data['kementerian'],
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            // throw new GeneralException(__($e));
            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new LanjutSahLakuUpdated($lanjutsahlaku));

        DB::commit();

        return $lanjutsahlaku;
    }

}
