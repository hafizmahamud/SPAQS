<?php
/**
 * NegeriService File.
 *
 * PHP Version 8.0
 *
 * @category NegeriService
 * @package  NegeriService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Negeri\NegeriCreated;
use App\Domains\Auth\Events\Negeri\NegeriDeleted;
use App\Domains\Auth\Events\Negeri\NegeriUpdated;
use App\Models\Negeri;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class NegeriService.
 *
 * @category NegeriService
 * @package  NegeriService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class NegeriService extends BaseService
{
    /**
     * NegeriService constructor.
     *
     * @param Negeri $negeri comment about this variable
     */
    public function __construct(Negeri $negeri)
    {
        $this->model = $negeri;
    }

    /**
     * Function store
     *
     * @param array $data comment about this variable
     *
     * @return Negeri
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Negeri
    {
        DB::beginTransaction();

        try {
            $negeri = $this->model::create(
                [
                    'singkatan' => $data['singkatan'],
                    'negeri' => $data['negeri'],
                    'alamat' => $data['alamat'],
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new NegeriCreated($negeri));

        activity('Tetapan')
            ->performedOn($negeri)
            ->log(':causer.name menambah negeri :subject.negeri');

        DB::commit();

        return $negeri;
    }

    /**
     * Function update
     *
     * @param Negeri $negeri comment about this variable
     * @param array  $data   comment about this variable
     *
     * @return negeri
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(Negeri $negeri, array $data = []): Negeri
    {
        DB::beginTransaction();

        try {
            $negeri->update(
                [
                    'negeri' => $data['negeri'],
                    'alamat' => $data['alamat'],
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new NegeriUpdated($negeri));

        activity('Tetapan')
            ->performedOn($negeri)
            ->log(':causer.name mengemaskini negeri :subject.negeri');

        DB::commit();

        return $negeri;
    }

    /**
     * Function destroy
     *
     * @param Negeri $negeri comment about this variable
     *
     * @return bool
     *
     * @throws GeneralException
     */
    public function destroy(Negeri $negeri): bool
    {

        if ($this->deleteById($negeri->id)) {
            event(new NegeriDeleted($negeri));

            return true;
        }

        throw new GeneralException(__('Sila cuba semula.'));
    }
}
