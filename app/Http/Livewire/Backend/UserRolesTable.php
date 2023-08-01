<?php
// phpcs:ignoreFile -- this fail is generated by Laravel
/**
 * UserRolesTable File.
 *
 * PHP Version 8.0
 *
 * @category UserRolesTable
 * @package  UserRolesTable
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use App\Models\ModelHasRoles;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UserRolesTable.
 *
 * @category UserRolesTable
 * @package  UserRolesTable
 * @author   Mimi Khalid <mimi@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UserRolesTable extends DataTableComponent
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
        $this->user_id = $id;
    }

    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = User::whereIn('id', $this->user_id)->orderBy('name', 'asc');
        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make(__('Nama'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('E-mel'), 'email')
                ->searchable(),
        ];
    }

    public function rowView(): string
    {
        return 'backend.auth.role.includes.viewuser';
    }
}
