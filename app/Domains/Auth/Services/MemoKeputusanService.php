<?php
/**
 * MemoKeputusanService File.
 *
 * PHP Version 8.0
 *
 * @category MemoKeputusanService
 * @package  MemoKeputusanService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Template\MemoKeputusan\MemoKeputusanUpdated;
use App\Models\MemoEdarKeputusan;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class MemoKeputusanService.
 *
 * @category MemoKeputusanService
 * @package  MemoKeputusanService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class MemoKeputusanService extends BaseService
{
    /**
     * MemoKeputusanService constructor.
     *
     * @param MemoEdarKeputusan $memoedarkeputusan comment about this variable
     */
    public function __construct(MemoEdarKeputusan $memoedarkeputusan)
    {
        $this->model = $memoedarkeputusan;
    }

    /**
     * Function update
     *
     * @param MemoEdarKeputusan $memoedarkeputusan comment about this variable
     * @param array             $data              comment about this variable
     *
     * @return memoedarkeputusan
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(MemoEdarKeputusan $memoedarkeputusan, array $data = []): MemoEdarKeputusan
    {
        DB::beginTransaction();

        try {
            $memoedarkeputusan->update(
                [
                    'rujukan' => $data['rujukan'],
                    'perkara' => $data['perkara'],
                    'kementerian' => $data['kementerian'],
                    'kementerian1' => $data['kementerian1'],
                    'text_1' => $data['text_1'],
                    'title' => $data['title'],
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

        event(new MemoKeputusanUpdated($memoedarkeputusan));

        DB::commit();

        return $memoedarkeputusan;
    }

}
