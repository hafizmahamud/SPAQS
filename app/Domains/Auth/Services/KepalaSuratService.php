<?php
/**
 * KepalaSurat File.
 *
 * PHP Version 8.0
 *
 * @category KepalaSurat
 * @package  KepalaSurat
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Template\KepalaSurat\KepalaSuratUpdated;
use App\Models\HeaderSurat;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class KepalaSurat.
 *
 * @category KepalaSurat
 * @package  KepalaSurat
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class KepalaSuratService extends BaseService
{
    /**
     * KepalaSurat constructor.
     *
     * @param HeaderSurat $headersurat comment about this variable
     */
    public function __construct(HeaderSurat $headersurat)
    {
        $this->model = $headersurat;
    }

    /**
     * Function update
     *
     * @param HeaderSurat $headersurat comment about this variable
     * @param array       $data        comment about this variable
     *
     * @return lantikanpenilai
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(HeaderSurat $headersurat, array $data = []): HeaderSurat
    {
        DB::beginTransaction();

        // jata negara
        $name_jatanegara = $data['jata_negara']->getClientOriginalName();
        $tarikh_file = Carbon::now()->format('ymd_His');
        $explode_name = explode('.', $name_jatanegara);

        $nama_fail = '';
        for ($i=0; $i < count($explode_name)-1; $i++) {
            $nama_fail .= $explode_name[$i];
        }

        $name_jatanegara = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];

        // image memo
        $name_image_memo = $data['img_memo']->getClientOriginalName();
        $tarikh_file = Carbon::now()->format('ymd_His');
        $explode_name = explode('.', $name_image_memo);

        $nama_fail = '';
        for ($i=0; $i < count($explode_name)-1; $i++) {
            $nama_fail .= $explode_name[$i];
        }

        $name_image_memo = $nama_fail.'-'.$tarikh_file.'.'.$explode_name[count($explode_name)-1];

        if ((array_key_exists("jata_negara", $data) !== false) && (array_key_exists("img_memo", $data) !== false)) {
            try {
                $headersurat->update(
                    [
                        'jata_negara' => $name_jatanegara,
                        'img_memo' => $name_image_memo,
                        'jabatan' => $data['jabatan'],
                        'kementerian' => $data['kementerian'],
                        'alamat' => $data['alamat'],
                        'laman_web' => $data['laman_web'],
                        'no_tel' => $data['no_tel'],
                        'no_fax' => $data['no_fax'],
                        'email' => $data['email'],
                        'path_jata_negara' => '/storage/tetapanTemplate/' .$name_jatanegara,
                        'path_img_memo' => '/storage/tetapanTemplate/' .$name_image_memo,
                    ]
                );
            } catch (Exception $e) {
                DB::rollBack();
                throw new GeneralException(__('Sila cuba semula.'));
            }
        } elseif (array_key_exists("jata_negara", $data) !== false) {
            try {
                $headersurat->update(
                    [
                        'jata_negara' => $name_jatanegara,
                        'jabatan' => $data['jabatan'],
                        'kementerian' => $data['kementerian'],
                        'alamat' => $data['alamat'],
                        'laman_web' => $data['laman_web'],
                        'no_tel' => $data['no_tel'],
                        'no_fax' => $data['no_fax'],
                        'email' => $data['email'],
                        'path_jata_negara' => '/storage/tetapanTemplate/' .$name_jatanegara,
                    ]
                );
            } catch (Exception $e) {
                DB::rollBack();
                throw new GeneralException(__('Sila cuba semula.'));
            }
        } elseif (array_key_exists("img_memo", $data) !== false) {
            try {
                $headersurat->update(
                    [
                        'img_memo' => $name_image_memo,
                        'jabatan' => $data['jabatan'],
                        'kementerian' => $data['kementerian'],
                        'alamat' => $data['alamat'],
                        'laman_web' => $data['laman_web'],
                        'no_tel' => $data['no_tel'],
                        'no_fax' => $data['no_fax'],
                        'email' => $data['email'],
                        'path_img_memo' => '/storage/tetapanTemplate/' .$name_image_memo,
                    ]
                );
            } catch (Exception $e) {
                DB::rollBack();
                throw new GeneralException(__('Sila cuba semula.'));
            }
        } else {
            try {
                $headersurat->update(
                    [
                        'jabatan' => $data['jabatan'],
                        'kementerian' => $data['kementerian'],
                        'alamat' => $data['alamat'],
                        'laman_web' => $data['laman_web'],
                        'no_tel' => $data['no_tel'],
                        'no_fax' => $data['no_fax'],
                        'email' => $data['email'],
                    ]
                );
            } catch (Exception $e) {
                DB::rollBack();

                throw new GeneralException(__('Sila cuba semula.'));
            }
        }

        event(new KepalaSuratUpdated($headersurat));

        DB::commit();

        return $headersurat;
    }

}
