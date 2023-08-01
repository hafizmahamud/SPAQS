<?php
/**
 * SubBidangTable File
 *
 * PHP Version 8.0
 *
 * @category SubBidangTable
 * @package  SubBidangTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use Modules\Sisdant\Models\SubBidang;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class SubBidangTable.
 *
 * @category SubBidangTable
 * @package  SubBidangTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class SubidangTable extends DataTableComponent
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
        $this->bidang_id = $id;
    }
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = SubBidang::where('bidang_id', $this->bidang_id)->orderBy('kod', 'asc');


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
            Column::make(__('Sub Bidang'))
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
        return 'backend.auth.subBidang.includes.row';
    }
}
