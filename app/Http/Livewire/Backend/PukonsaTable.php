<?php
/**
 * PukonsaTableFile
 *
 * PHP Version 8.0
 *
 * @category PukonsaTable
 * @package  PukonsaTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use Modules\Sisdant\Models\KelasPukonsa;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class PukonsaTable.
 *
 * @category PukonsaTable
 * @package  PukonsaTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class PukonsaTable extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = KelasPukonsa::orderBy('id', 'asc')
                    ->with('subPukonsa');
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
            Column::make(__('Tajuk'))
                ->sortable()
                ->searchable(),
            Column::make(__('Keterangan'))
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
        return 'backend.auth.pukonsa.includes.row';
    }
}
