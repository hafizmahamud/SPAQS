<?php
/**
 * BayaranTableFile
 *
 * PHP Version 8.0
 *
 * @category BayaranTable
 * @package  BayaranTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use Modules\Sisdant\Models\BayarKepada;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class BayaranTable.
 *
 * @category BayaranTable
 * @package  BayaranTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BayaranTable extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = BayarKepada::where('id', '!=', 4)->orderBy('created_at', 'asc');
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
            Column::make(__('Bayaran Kepada'), 'nama')
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
        return 'backend.auth.bayaran.includes.row';
    }
}
