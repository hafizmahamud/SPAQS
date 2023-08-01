<?php
/**
 * NegeriController File.
 *
 * PHP Version 8.0
 *
 * @category LogController
 * @package  LogController
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\TetapanSistem;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;

/**
 * Class LogController.
 *
 * @category NegeriController
 * @package  NegeriController
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class NegeriController extends Controller
{
    
    //
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $query = Log::join('users', 'users.id', '=', 'activity_log.causer_id')
            ->select('users.name')
            ->get();

        return view('backend.auth.log.index');
    }

}
