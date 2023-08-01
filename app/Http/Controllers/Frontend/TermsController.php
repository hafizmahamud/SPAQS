<?php
/**
 * TermsController File
 *
 * PHP Version 8.0
 *
 * @category TermsController
 * @package  TermsController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Controllers\Frontend;

/**
 * Class TermsController.
 *
 * @category TermsController
 * @package  TermsController
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class TermsController
{
    /**
     * Terms
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.pages.terms');
    }
}
