<?php
/**
 * BahagianTable File
 *
 * PHP Version 8.0
 *
 * @category BahagianTable
 * @package  BahagianTable
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use App\Models\Pejabat;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class BahagianTable.
 *
 * @category BahagianTable
 * @package  BahagianTable
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class BahagianTable extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';
    /**
     * Status
     *
     * @var
     */
    public $status;

    /**
     * Sort Names
     *
     * @var array|string[]
     */
    public array $sortNames = [
        'bahagian' => 'Bahagian',
        'singkatan' => 'Singkatan',
    ];

    /**
     * Filter name
     *
     * @var array|string[]
     */
    public array $filterNames = [
        'bahagian' => 'Bahagian',
        'singkatan' => 'Singkatan',
    ];

    /**
     * Mount
     *
     * @param int $id comment about this variable
     *
     * @return string
     */
    public function mount($id)
    {
        $this->negeri_id = $id;
    }

    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Pejabat::where('negeri_id', $this->negeri_id)->orderBy('bahagian', 'asc');
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
            Column::make(__('Bahagian'))
                ->sortable()
                ->searchable(),
            Column::make(__('Singkatan'))
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
        return 'backend.auth.bahagian.includes.row';
    }
}
