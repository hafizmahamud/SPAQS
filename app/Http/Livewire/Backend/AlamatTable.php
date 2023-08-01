<?php
/**
 * AlamatTable File
 *
 * PHP Version 8.0
 *
 * @category AlamatTable
 * @package  AlamatTable
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use App\Models\SenaraiAlamat;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class AlamatTable.
 *
 * @category AlamatTable
 * @package  AlamatTable
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class AlamatTable extends DataTableComponent
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
        'jenis_alamat' => 'Jenis Alamat',
        'alamat' => 'Alamat',
    ];

    /**
     * Filter name
     *
     * @var array|string[]
     */
    public array $filterNames = [
        'jenis_alamat' => 'Jenis Alamat',
        'alamat' => 'Alamat',
    ];

    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return SenaraiAlamat::query();
    }

    /**
     * Column
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Jenis Alamat'))
                ->sortable()
                ->searchable(),
            Column::make(__('Alamat'))
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
        return 'backend.auth.alamat.includes.row';
    }
}
