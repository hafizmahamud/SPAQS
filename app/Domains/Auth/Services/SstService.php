<?php
/**
 * SstService File.
 *
 * PHP Version 8.0
 *
 * @category SstService
 * @package  SstService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Template\SST\SstUpdated;
use App\Models\TemplatSST;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class SstService.
 *
 * @category SstService
 * @package  SstService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SstService extends BaseService
{
    /**
     * TemplatSST constructor.
     *
     * @param TemplatSST $templatsst comment about this variable
     */
    public function __construct(TemplatSST $templatsst)
    {
        $this->model = $templatsst;
    }

    /**
     * Function update
     *
     * @param TemplatSST $templatsst comment about this variable
     * @param array      $data       comment about this variable
     *
     * @return templatsst
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(TemplatSST $templatsst, array $data = []): TemplatSST
    {
        $name = $data['path']->getClientOriginalName();
        $tarikh_file = Carbon::now()->format('ymd_His');
        $explode_name = explode('.', $name);

        $nama_fail = '';
        for ($i=0; $i < count($explode_name)-1; $i++) {
            $nama_fail .= $explode_name[$i];
        }

        $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];
        DB::beginTransaction();
        try {
            $templatsst->update(
                [
                    'name' => $name,
                    'path' => '/storage/tetapanTemplate/' .$name,
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new SstUpdated($templatsst));

        DB::commit();

        return $templatsst;
    }

}
