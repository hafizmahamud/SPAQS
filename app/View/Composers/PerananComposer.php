<?php
/**
 * PerananComposer File.
 *
 * PHP Version 8.0
 *
 * @category PerananComposer
 * @package  PerananComposer
 * @author   Nurul Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\ModelHasRoles;

/**
 * Class IklanComposer.
 *
 * PHP Version 8.0
 *
 * @category PerananComposer
 * @package  PerananComposer
 * @author   Nurul Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class PerananComposer
{
    /**
     * Get Status
     *
     * @param View $view comment disabled
     *
     * @return Renderable
     */
    public function compose(View $view)
    {

        $user = auth()->user();
        $type = "";
        $type_array = [];
        if ($user) {
            $checkrole = ModelHasRoles::where('model_id', $user->id)->get();

            for ($i=0; $i < count($checkrole); $i++) {
                if ($checkrole[$i]->role_id  == "2") {
                    $type = "PENTADBIR SISTEM";
                } else if ($checkrole[$i]->role_id  == "3") {
                    $type = "PENGESAH NOMBOR PEROLEHAN";
                } else if ($checkrole[$i]->role_id  == "4") {
                    $type = "PENGIKLAN";
                } else if ($checkrole[$i]->role_id  == "5") {
                    $type = "PENYARING PETENDER";
                } else if ($checkrole[$i]->role_id  == "6") {
                    $type = "PENDAFTAR JADUAL HARGA";
                } else if ($checkrole[$i]->role_id  == "7") {
                    $type = "PENDAFTAR PENILAI";
                } else if ($checkrole[$i]->role_id  == "8") {
                    $type = "PEGAWAI PENILAI 1";
                } else if ($checkrole[$i]->role_id  == "9") {
                    $type = "PEGAWAI PENILAI 2";
                } else if ($checkrole[$i]->role_id  == "10") {
                    $type = "PENDAFTAR KEPUTUSAN LP";
                } else if ($checkrole[$i]->role_id  == "11") {
                    $type = "PENYEDIA DOKUMEN";
                } else if ($checkrole[$i]->role_id  == "12") {
                    $type = "PELAKSANA";
                } else if ($checkrole[$i]->role_id  == "13") {
                    $type = "KETUA PENILAI";
                }

                array_push($type_array, $type);
            }
        }

        $view->with('peranan', $type_array);
    }
}
