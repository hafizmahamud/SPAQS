<?php
/**
 * SubKelasPukonsaTable File
 *
 * PHP Version 8.0
 *
 * @category SubKelasPukonsaTable
 * @package  SubKelasPukonsaTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use Modules\Sisdant\Models\SubKelasPukonsa;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class SubKelasPukonsaTable.
 *
 * @category SubKelasPukonsaTable
 * @package  SubKelasPukonsaTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SubKelasPukonsaTable extends DataTableComponent
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
        $this->pukonsa_id = $id;
    }
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = SubKelasPukonsa::where('tajuk_id', $this->pukonsa_id)->orderBy('id', 'asc');


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
            Column::make(__('Tajuk Kecil'), 'tajuk_kecil')
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
        return 'backend.auth.subKelasPukonsa.includes.row';
    }
}
