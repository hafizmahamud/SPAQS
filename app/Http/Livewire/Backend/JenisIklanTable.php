<?php
// phpcs:ignoreFile -- this fail is generated by Laravel
/**
 * JenisIklanTable File.
 *
 * PHP Version 8.0
 *
 * @category JenisIklanTable
 * @package  JenisIklanTable
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;
use App\Domains\Auth\Models\User;
use Modules\Sisdant\Models\JenisIklan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class JenisIklanTable.
 *
 * @category JenisIklanTable
 * @package  JenisIklanTable
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class JenisIklanTable extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';

    public function columns(): array
    {
        return [
            Column::make('Nama', 'nama')
                ->sortable()
                ->searchable(),
            Column::make(__('Tindakan')),
        ];
    }

    public function query(): Builder
    {
        return JenisIklan::query();
    }

    public function rowView(): string
    {
        return 'backend.auth.iklan.includes.row_jenis_iklan';
    }
}
