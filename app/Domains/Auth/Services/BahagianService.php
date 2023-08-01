<?php
/**
 * BahagianService File.
 *
 * PHP Version 8.0
 *
 * @category BahagianService
 * @package  BahagianService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Bahagian\BahagianCreated;
use App\Domains\Auth\Events\Bahagian\BahagianDeleted;
use App\Domains\Auth\Events\Bahagian\BahagianUpdated;
use App\Models\Pejabat;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class BahagianService.
 *
 * @category BahagianService
 * @package  BahagianService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BahagianService extends BaseService
{
    /**
     * BahagianService constructor.
     *
     * @param Pejabat $bahagian comment about this variable
     */
    public function __construct(Pejabat $bahagian)
    {
        $this->model = $bahagian;
    }

    /**
     * Function store
     *
     * @param array $data comment about this variable
     *
     * @return Pejabat
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Pejabat
    {
        DB::beginTransaction();

        try {
            $bahagian = $this->model::create(
                [
                    'singkatan' => $data['singkatan'],
                    'bahagian' => $data['bahagian'],
                    'negeri_id' => $data['negeri_id'],
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new BahagianCreated($bahagian));

        activity('Tetapan')
            ->performedOn($bahagian)
            ->log(':causer.name menambah bahagian :subject.bahagian');

        DB::commit();

        return $bahagian;
    }

    /**
     * Function update
     *
     * @param Bahagian $bahagian comment about this variable
     * @param array    $data     comment about this variable
     *
     * @return Bahagian
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(Pejabat $bahagian, array $data = []): Pejabat
    {
        DB::beginTransaction();

        try {
            $bahagian->update(
                [
                    'bahagian' => $data['bahagian']
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new BahagianUpdated($bahagian));

        activity('Tetapan')
            ->performedOn($bahagian)
            ->log(':causer.name mengemaskini bahagian :subject.bahagian');

        DB::commit();

        return $bahagian;
    }

    /**
     * Function destroy
     *
     * @param Bahagian $bahagian comment about this variable
     *
     * @return bool
     *
     * @throws GeneralException
     */
    public function destroy(Pejabat $bahagian): bool
    {

        if ($this->deleteById($bahagian->id)) {
            event(new BahagianDeleted($bahagian));

            return true;
        }

        throw new GeneralException(__('Sila cuba semula.'));
    }
}
