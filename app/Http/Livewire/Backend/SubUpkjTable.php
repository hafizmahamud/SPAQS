<?php
/**
 * SubUpkjTable File
 *
 * PHP Version 8.0
 *
 * @category SubUpkjTable
 * @package  SubUpkjTable
 * @author   Faris <faris@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use Modules\Sisdant\Models\SubKelasUpkj;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class SubUpkjTable.
 *
 * @category SubUpkjTable
 * @package  SubUpkjTable
 * @author   Faris <faris@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SubUpkjTable extends DataTableComponent
{

    public string $emptyMessage = 'Tiada Data';
    /**
     * Mount
     *
     * @param int $id comment about this variable
     *
     * @return string
     */
    public function mount($id)
    {
        $this->upkj_id = $id;
    }
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = SubKelasUpkj::where('tajuk_id', $this->upkj_id)->orderBy('id', 'asc');

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
            Column::make(__('Tajuk Kecil'))
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
        return 'backend.auth.subUpkj.includes.row';
    }
}
