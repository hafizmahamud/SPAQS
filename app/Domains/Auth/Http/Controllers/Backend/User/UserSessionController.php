<?php
/**
 * UserSessionController File.
 *
 * PHP Version 8.0
 *
 * @category UserSessionController
 * @package  UserSessionController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Domains\Auth\Http\Controllers\Backend\User;

use App\Domains\Auth\Http\Requests\Backend\User\ClearUserSessionRequest;
use App\Domains\Auth\Models\User;

/**
 * Class UserSessionController.
 *
 * @category UserSessionController
 * @package  UserSessionController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UserSessionController
{
    /**
     * Clear session
     *
     * @param ClearUserSessionRequest $request comment about this variable
     * @param User                    $user    comment about this variable
     *
     * @return mixed
     */
    public function update(ClearUserSessionRequest $request, User $user)
    {
        $user->update(['to_be_logged_out' => true]);

        return redirect()->back()->withFlashSuccess(__('The user\'s session was successfully cleared.'));
    }
}
