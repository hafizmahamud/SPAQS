<?php
/**
 * SelesaiTugasService File.
 *
 * PHP Version 8.0
 *
 * @category SelesaiTugasService
 * @package  SelesaiTugasService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Template\SelesaiTugas\SelesaiTugasUpdated;
use App\Models\SelesaiTugas;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class SelesaiTugasService.
 *
 * @category SelesaiTugasService
 * @package  SelesaiTugasService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SelesaiTugasService extends BaseService
{
    /**
     * SelesaiTugasService constructor.
     *
     * @param SelesaiTugas $selesaitugas comment about this variable
     */
    public function __construct(SelesaiTugas $selesaitugas)
    {
        $this->model = $selesaitugas;
    }

    /**
     * Function update
     *
     * @param SelesaiTugas $selesaitugas comment about this variable
     * @param array        $data         comment about this variable
     *
     * @return selesaitugas
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(SelesaiTugas $selesaitugas, array $data = []): SelesaiTugas
    {
        DB::beginTransaction();

        try {
            $selesaitugas->update(
                [
                    'tajuk' => $data['tajuk'],
                    'text_1' => $data['text_1'],
                    'text_2' => $data['text_2'],
                    'text_3' => $data['text_3'],
                    'text_4' => $data['text_4'],
                    'text_5' => $data['text_5'],
                    'text_6' => $data['text_6'],
                    'text_7' => $data['text_7'],
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            // throw new GeneralException(__($e));
            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new SelesaiTugasUpdated($selesaitugas));

        DB::commit();

        return $selesaitugas;
    }

}
