<?php
/**
 * AccountController File
 *
 * PHP Version 8.0
 *
 * @category AccountController
 * @package  AccountController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Controllers\Frontend\User;
use App\Models\Negeri;
use App\Models\Pejabat;
use Auth;
use App\Domains\Auth\Models\User;
use Illuminate\Http\Request;
/**
 * Class AccountController.
 *
 * @category AccountController
 * @package  AccountController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AccountController
{
    /**
     * Display account user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $user  = User::where('id', $user->id)->first();

        $listpejabat = Pejabat::where('negeri_id', $user->negeri_id)
            ->select('id', 'bahagian', 'singkatan')
            ->orderBy('bahagian', 'asc')
            ->get();

        $listnegeri = Negeri::select('id', 'negeri', 'singkatan')
            ->orderBy('negeri', 'asc')
            ->get();
        return view('frontend.user.account', compact('listnegeri', 'listpejabat', 'user'));
    }

    /**
     * Update profile user.
     *
     * @param Request $request comment about this variable
     *
     * @return Renderable
     */
    public function getPejabat(Request $request)
    {
        $negeri = $request->negeri;
        $pejabat = Pejabat::where('negeri_id', $negeri)
            ->orderBy('bahagian', 'asc')
            ->get();

        return response()->json([$pejabat]);
    }

}
