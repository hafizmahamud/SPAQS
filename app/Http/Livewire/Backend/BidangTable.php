<?php
/**
 * BidangTableFile
 *
 * PHP Version 8.0
 *
 * @category BidangTable
 * @package  BidangTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use Modules\Sisdant\Models\Bidang;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class BidangTable.
 *
 * @category BidangTable
 * @package  BidangTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BidangTable extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Bidang::orderBy('kod', 'asc')
                    ->with('subBidang');
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
            Column::make(__('Kod'))
                ->sortable()
                ->searchable(),
            Column::make(__('Bidang'))
                ->sortable()
                ->searchable(),
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
        return 'backend.auth.bidang.includes.row';
    }
}
