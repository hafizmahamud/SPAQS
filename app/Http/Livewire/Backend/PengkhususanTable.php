<?php
/**
 * PengkhususanTable File
 *
 * PHP Version 8.0
 *
 * @category PengkhususanTable
 * @package  PengkhususanTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use Modules\Sisdant\Models\Pengkhususan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class PengkhususanTable.
 *
 * @category PengkhususanTable
 * @package  PengkhususanTable
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class PengkhususanTable extends DataTableComponent
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
        $this->kelas_id = $id;
    }
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Pengkhususan::where('kelas_id', $this->kelas_id)->orderBy('kod', 'asc');


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
            Column::make(__('Pengkhususan'))
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
        return 'backend.auth.pengkhususan.includes.row';
    }
}
