<?php
/**
 * InfoPengarahService File.
 *
 * PHP Version 8.0
 *
 * @category InfoPengarahService
 * @package  InfoPengarahService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Template\InfoPengarah\InfoPengarahUpdated;
use App\Models\Tandatangan;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class InfoPengarahService.
 *
 * @category InfoPengarahService
 * @package  InfoPengarahService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class InfoPengarahService extends BaseService
{
    /**
     * KepalaSurat constructor.
     *
     * @param Tandatangan $tandatangan comment about this variable
     */
    public function __construct(Tandatangan $tandatangan)
    {
        $this->model = $tandatangan;
    }

    /**
     * Function update
     *
     * @param Tandatangan $tandatangan comment about this variable
     * @param array       $data        comment about this variable
     *
     * @return tandatangan
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(Tandatangan $tandatangan, array $data = []): Tandatangan
    {
        $name = $data['tandatangan']->getClientOriginalName();
        $tarikh_file = Carbon::now()->format('ymd_His');
        $explode_name = explode('.', $name);

        $nama_fail = '';
        for ($i=0; $i < count($explode_name)-1; $i++) {
            $nama_fail .= $explode_name[$i];
        }

        $name = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];

        DB::beginTransaction();
        if (array_key_exists("tandatangan", $data)!== false) {
            try {
                $tandatangan->update(
                    [
                        'tandatangan' => $name,
                        'nama' => $data['nama'],
                        'jawatan' => $data['jawatan'],
                        'path_tandatangan' => '/storage/tetapanTemplate/' .$name,
                    ]
                );
            } catch (Exception $e) {
                DB::rollBack();
                // throw new GeneralException(__($e));
                throw new GeneralException(__('Sila cuba semula.'));
            }
        } else {
            try {
                $tandatangan->update(
                    [
                        'nama' => $data['nama'],
                        'jawatan' => $data['jawatan'],
                    ]
                );
            } catch (Exception $e) {
                DB::rollBack();

                throw new GeneralException(__('Sila cuba semula.'));
            }
        }

        event(new InfoPengarahUpdated($tandatangan));

        DB::commit();

        return $tandatangan;
    }

}
