<?php
/**
 * LogTable File
 *
 * PHP Version 8.0
 *
 * @category LogTable
 * @package  LogTable
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Http\Livewire\Backend;

use App\Models\Log;
use App\Models\User;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class LogTable.
 *
 * @category LogTable
 * @package  LogTable
 * @author   Hafiz Mahamud <hafiz@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LogTable extends DataTableComponent
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
        'name' => 'Pengguna',
        'log_name' => 'Jenis Log',
        'created_at' => 'Masa'
    ];

    /**
     * Filter name
     *
     * @var array|string[]
     */
    public array $filterNames = [
        'log_name' => 'Jenis Log',
        'description' => 'Keterangan',
        'created_at' => 'Masa',
    ];

     /**
      * Filter
      *
      * @return array
      */
    public function filters(): array
    {
        return [
            'log_name' => Filter::make('Jenis Log')
                ->select(
                    [
                    '' => 'Semua',
                    'Login' => 'Login',
                    'Logout' => 'Logout',
                    'Tetapan' => 'Tetapan',
                    'Pengguna' => 'Pengguna',
                    ]
                ),
            'fromDate' => Filter::make('Dari')
                ->date(),
            'toDate' => Filter::make('Hingga')
                ->date(),
            ];
    }




    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Log::where('log_name', '!=', 'default')
            ->join('users', 'users.id', '=', 'activity_log.causer_id')
            ->select('activity_log.*', 'users.name')
            ->when($this->getFilter('fromDate'), fn($query, $date) => $query->whereDate('activity_log.created_at', '>=', $date))
            ->when($this->getFilter('toDate'), fn($query, $date) => $query->whereDate('activity_log.created_at', '<=', $date))
            ->when($this->getFilter('log_name'), fn ($query, $logname) => $query->where('activity_log.log_name', $logname));
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
            Column::make(__('Pengguna'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('Jenis Log'), 'log_name')
                ->sortable(),
            Column::make(__('Keterangan'), 'description')
                ->searchable(),
            Column::make(__('Masa'))
                ->sortable()
                ->excludeFromSelectable(),
        ];
    }

    /**
     * Row view
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.auth.log.includes.row';
    }
}
