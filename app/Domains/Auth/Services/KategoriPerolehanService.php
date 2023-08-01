<?php
// phpcs:ignoreFile -- this fail is generated by Laravel
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Iklan\KategoriPerolehanCreated;
use App\Domains\Auth\Events\Iklan\KategoriPerolehanUpdated;
use App\Domains\Auth\Events\Iklan\KategoriPerolehanDeleted;
use Modules\Sisdant\Models\KategoriPerolehan;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class KategoriPerolehanService.
 */
class KategoriPerolehanService extends BaseService
{
    /**
     * KategoriPerolehan constructor.
     *
     * @param KategoriPerolehan $jenisIklan
     */
    public function __construct(KategoriPerolehan $kategoriPerolehan)
    {
        $this->model = $kategoriPerolehan;
    }

    /**
     * @param  array $data
     * @return KategoriPerolehan
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): KategoriPerolehan
    {
        DB::beginTransaction();

        try {
            $maxId = KategoriPerolehan::max('id');
            $kategoriPerolehan = $this->model::create(['id' => $maxId + 1, 'nama' => $data['nama']]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Sila cuba semula.'));
        }

        event(new KategoriPerolehanCreated($kategoriPerolehan));

        activity('Tetapan')
        ->performedOn($kategoriPerolehan)
        ->log(':causer.name menambah kategori perolehan :subject.nama');

        DB::commit();

        return $kategoriPerolehan;
    }

    /**
     * @param  KategoriPerolehan $kategoriPerolehan
     * @param  array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(KategoriPerolehan $kategoriPerolehan, array $data = []): KategoriPerolehan
    {
        DB::beginTransaction();

        try {
            $kategoriPerolehan->update(['nama' => $data['nama']]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Sila cuba semula'));
        }

        event(new KategoriPerolehanUpdated($kategoriPerolehan));

        activity('Tetapan')
        ->performedOn($kategoriPerolehan)
        ->log(':causer.name mengemaskini kategori perolehan :subject.nama');

        DB::commit();

        return $kategoriPerolehan;
    }

    /**
     * @param  KategoriPerolehan $kategoriPerolehan
     * @return bool
     *
     * @throws GeneralException
     */
    public function destroy(KategoriPerolehan $kategoriPerolehan): bool
    {
        if ($this->deleteById($kategoriPerolehan->id)) {
            event(new KategoriPerolehanDeleted($kategoriPerolehan));

            return true;
        }

        throw new GeneralException(__('Sila cuba semula'));
    }
}
