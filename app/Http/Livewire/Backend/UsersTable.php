<?php
/**
 * UsersTable File
 *
 * PHP Version 8.0
 *
 * @category UsersTable
 * @package  UsersTable
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class UsersTable.
 *
 * @category UsersTable
 * @package  UsersTable
 * @author   Norain Ahmad <norain@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class UsersTable extends DataTableComponent
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
        'email_verified_at' => 'Verified',
    ];

    /**
     * Filter name
     *
     * @var array|string[]
     */
    public array $filterNames = [
        'type' => 'User Type',
        'verified' => 'E-mail Verified',
    ];

    /**
     * Status
     *
     * @param string $status comment about this variable
     *
     * @return status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = User::with('roles', 'twoFactorAuth')->withCount('twoFactorAuth');
        if ($this->status === 'deleted') {
            $query = $query->onlyTrashed();
        } elseif ($this->status === 'deactivated') {
            $query = $query->onlyDeactivated();
        } else {
            $query = $query->onlyActive();
        }

        return $query
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term))
            ->when($this->getFilter('type'), fn ($query, $type) => $query->where('type', $type))
            ->when($this->getFilter('active'), fn ($query, $active) => $query->where('active', $active === 'yes'));
    }

    /**
     * Filter user type
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            'type' => Filter::make('User Type')
                ->select(
                    [
                    '' => 'Any',
                    User::TYPE_ADMIN => 'Administrators',
                    User::TYPE_USER => 'Users',
                    ]
                ),
            'active' => Filter::make('Active')
                ->select(
                    [
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                    ]
                ),
        ];
    }

    /**
     * Column
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Type'))
                ->sortable(),
            Column::make(__('Name'))
                ->sortable(),
            Column::make(__('E-mail'), 'email')
                ->sortable(),
            Column::make(__('Roles')),
            Column::make(__('Actions')),
        ];
    }

    /**
     * Row view
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.auth.user.includes.row';
    }
}
