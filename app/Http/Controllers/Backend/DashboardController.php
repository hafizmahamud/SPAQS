<?php
/**
 * DashboardController File.
 *
 * PHP Version 8.0
 *
 * @category DashboardController
 * @package  DashboardController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Controllers\Backend;

/**
 * Class DashboardController.
 *
 * @category DashboardController
 * @package  DashboardController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class DashboardController
{
    /**
     * Dashboard Controller
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }
}
