<?php
/**
 * AnnouncementTableFile
 *
 * PHP Version 8.0
 *
 * @category AnnouncementTable
 * @package  AnnouncementTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use App\Domains\Announcement\Models\Announcement;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class AnnouncementTable.
 *
 * @category AnnouncementTable
 * @package  AnnouncementTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AnnouncementTable extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Announcement::orderBy('enabled', 'desc');


        return $query;
    }

    /**
     * Column
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Pengumuman'), 'message')
                ->sortable()
                ->searchable(),
            Column::make(__('Active'), 'enabled')
                ->sortable(),
            Column::make(__('Tarikh Mula'), 'starts_at')
                ->sortable(),
            Column::make(__('Tarikh Akhir'), 'ends_at')
                ->sortable(),
            Column::make(__('Tindakan')),
        ];
    }

    /**
     * Row view
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.auth.announcement.includes.row';
    }
}
