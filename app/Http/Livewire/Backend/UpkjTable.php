<?php
/**
 * UpkjTableFile
 *
 * PHP Version 8.0
 *
 * @category UpkjTable
 * @package  UpkjTable
 * @author   Faris <faris@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use Modules\Sisdant\Models\KelasUpkj;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UpkjTable.
 *
 * @category UpkjTable
 * @package  UpkjTable
 * @author   Faris <faris@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UpkjTable extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = KelasUpkj::with('subKelasUpkj')->orderBy('id', 'asc');
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
                ->sortable(
                    function (Builder $query, $direction) {
                        return KelasUpkj::orderBy('tajuk', $direction);
                    }
                )
                ->searchable(),
            Column::make(__('Keterangan'))
                ->sortable(
                    function (Builder $query, $direction) {
                        return KelasUpkj::orderBy('keterangan', $direction);
                    }
                )
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
        return 'backend.auth.upkj.includes.row';
    }
}
