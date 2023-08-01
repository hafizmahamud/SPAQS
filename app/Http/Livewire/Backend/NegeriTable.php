<?php
/**
 * NegeriTable File
 *
 * PHP Version 8.0
 *
 * @category NegeriTable
 * @package  NegeriTable
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use App\Models\Negeri;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class NegeriTable.
 *
 * @category NegeriTable
 * @package  NegeriTable
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class NegeriTable extends DataTableComponent
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
        'singkatan' => 'Singkatan',
        'negeri' => 'Negeri',
    ];

    /**
     * Filter name
     *
     * @var array|string[]
     */
    public array $filterNames = [
        'singkatan' => 'Singkatan',
        'negeri' => 'Negeri',
    ];

    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return Negeri::query()
        ->with('bahagian');
    }

    /**
     * Column
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Pejabat JPS'))
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
        return 'backend.auth.negeri.includes.row';
    }
}
