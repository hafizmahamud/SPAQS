<?php
/**
 * AlamatService File.
 *
 * PHP Version 8.0
 *
 * @category AlamatService
 * @package  AlamatService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Alamat\AlamatCreated;
use App\Domains\Auth\Events\Alamat\AlamatDeleted;
use App\Domains\Auth\Events\Alamat\AlamatUpdated;
use App\Models\SenaraiAlamat;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class AlamatService.
 *
 * @category AlamatService
 * @package  AlamatService
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AlamatService extends BaseService
{
    /**
     * AlamatService constructor.
     *
     * @param SenaraiAlamat $alamat comment about this variable
     */
    public function __construct(SenaraiAlamat $alamat)
    {
        $this->model = $alamat;
    }

    /**
     * Function store
     *
     * @param array $data comment about this variable
     *
     * @return SenaraiAlamat
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): SenaraiAlamat
    {
        DB::beginTransaction();

        try {
            $alamat = $this->model::create(
                [
                    'jenis_alamat' => $data['jenis_alamat'],
                    'alamat' => $data['alamat'],
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new AlamatCreated($alamat));

        activity('Tetapan')
            ->performedOn($alamat)
            ->log(':causer.name menambah alamat :subject.jenis_alamat');

        DB::commit();

        return $alamat;
    }

    /**
     * Function update
     *
     * @param SenaraiAlamat $alamat comment about this variable
     * @param array         $data   comment about this variable
     *
     * @return alamat
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(SenaraiAlamat $alamat, array $data = []): SenaraiAlamat
    {
        DB::beginTransaction();

        try {
            $alamat->update(
                [
                    'jenis_alamat' => $data['jenis_alamat'],
                    'alamat' => $data['alamat'],
                ]
            );
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new AlamatUpdated($alamat));

        activity('Tetapan')
            ->performedOn($alamat)
            ->log(':causer.name mengemaskini alamat :subject.jenis_alamat');

        DB::commit();

        return $alamat;
    }

    /**
     * Function destroy
     *
     * @param SenaraiAlamat $alamat comment about this variable
     *
     * @return bool
     *
     * @throws GeneralException
     */
    public function destroy(SenaraiAlamat $alamat): bool
    {
        activity('Tetapan')
            ->performedOn($alamat)
            ->log(':causer.name memadam alamat :'.$alamat->jenis_alamat);

        if ($this->deleteById($alamat->id)) {
            event(new AlamatDeleted($alamat));
            
            return true;
        }

       

        throw new GeneralException(__('Sila cuba semula.'));
    }
}
