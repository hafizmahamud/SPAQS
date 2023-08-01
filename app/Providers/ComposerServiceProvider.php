<?php
/**
 * ComposerServiceProvider File.
 *
 * PHP Version 8.0
 *
 * @category ComposerServiceProvider
 * @package  ComposerServiceProvider
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Providers;

use App\Domains\Announcement\Services\AnnouncementService;
use App\View\Composers\IklanComposer;
use App\View\Composers\PerananComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ComposerServiceProvider.
 *
 * @category ComposerServiceProvider
 * @package  ComposerServiceProvider
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @param AnnouncementService $announcementService comment about this variable
     *
     * @return AnnouncementService
     */
    public function boot(AnnouncementService $announcementService)
    {
        View::composer(
            '*', function ($view) {
                $view->with('logged_in_user', auth()->user());
            }
        );

        View::composer(
            '*', IklanComposer::class
        );

        View::composer(
            '*', PerananComposer::class
        );

        View::composer(
            ['frontend.index', 'frontend.layouts.app'], function ($view) use ($announcementService) {
                $view->with('announcements', $announcementService->getForFrontend());
            }
        );

        View::composer(
            ['backend.layouts.app'], function ($view) use ($announcementService) {
                $view->with('announcements', $announcementService->getForBackend());
            }
        );
    }
}
