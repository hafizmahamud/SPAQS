<?php

namespace Modules\Tunas\Http\Livewire\IklanTelahTutup;

use Livewire\Component;
use App\Domains\Auth\Models\User;
use Modules\Sisdant\Models\IklanPerolehan;
use App\Models\Negeri;
use Modules\Sisdant\Models\JenisIklan;
use Modules\Sisdant\Models\KategoriPerolehan;
use Modules\Sisdant\Models\MatrikIklan;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class IklanTelahTutup extends DataTableComponent
{

    public string $emptyMessage = 'Tiada Data';
     /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $today = date("Y-m-d");
        $query = IklanPerolehan::where('status_iklan_id', 5)
                    ->with('user')
                    ->whereHas(
                        'user', function ($query) {
                                $query->where('deleted_at', null);
                        }
                    )
                    ->whereDate('tarikh_waktu_tutup', '<=', $today)
                    ->whereDate('tarikh_tutup_list', '>=', $today)
                    ->orderBy('tarikh_waktu_tutup', 'desc')
                    ->with('mohonNoPerolehan','mohonNoPerolehan.negeri', 'mohonNoPerolehan.matrikIklan.jenisIklan', 'mohonNoPerolehan.matrikIklan.kategoriPerolehan');

        return $query
            ->when($this->getFilter('jenis_iklan'), fn($query, $tags) => $query
                ->join('mohon_no_perolehan', 'mohon_no_perolehan.id_perolehan', '=', 'iklan_perolehan.mohon_no_perolehan_id')
                ->join('matrik_iklan', 'matrik_iklan.id', '=', 'mohon_no_perolehan.matrik_iklan_id')
                ->whereHas('mohonNoPerolehan.matrikIklan', fn($query) => $query->whereIn('matrik_iklan.jenis_iklan_id', $tags)));
    }

    /**
     * Column
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make('Bil', 'id')
                ->sortable(),
            Column::make('Negeri')
                ->sortable(function(Builder $query, $direction) {
                    return $query->join('mohon_no_perolehan', 'mohon_no_perolehan.id_perolehan', '=', 'iklan_perolehan.mohon_no_perolehan_id')
                    ->orderBy(Negeri::select('negeri')->whereColumn('negeri.id', 'mohon_no_perolehan.negeri_id'), $direction);
                }),
            Column::make(__('No Tender/Projek'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy(PermohonanNomborPerolehan::select('no_perolehan')->whereColumn('mohon_no_perolehan.id_perolehan', 'iklan_perolehan.mohon_no_perolehan_id'), $direction);
                })
                ->searchable(function (Builder $query, $term) {
                    return $query->where(
                        fn ($query) => $query->whereHas(
                            'mohonNoPerolehan',
                            function (
                                $query
                            ) use ($term) {
                                $query->where('no_perolehan', 'like', '%'.$term.'%')
                                ->orWhere('tajuk_perolehan', 'like', '%'.$term.'%');
                            }
                        )
                    );
                }),
            Column::make('Tarikh Iklan', 'tarikh_keluar_iklan')
                ->sortable(),
            Column::make('Tarikh Tutup', 'tarikh_waktu_tutup')
                ->sortable(),
            Column::make(__('Jenis Iklan'))
                ->sortable(function(Builder $query, $direction) {
                    return $query
                    ->join('mohon_no_perolehan', 'mohon_no_perolehan.id_perolehan', '=', 'iklan_perolehan.mohon_no_perolehan_id')
                    ->join('matrik_iklan', 'matrik_iklan.id', '=', 'mohon_no_perolehan.matrik_iklan_id')
                    ->orderBy(JenisIklan::select('nama')->whereColumn('jenis_iklan.id', 'matrik_iklan.jenis_iklan_id'), $direction);
                }),
            // Column::make(__('Kategori Perolehan'))
            //     ->sortable(function(Builder $query, $direction) {
            //         return $query
            //         ->join('mohon_no_perolehan', 'mohon_no_perolehan.id_perolehan', '=', 'iklan_perolehan.mohon_no_perolehan_id')
            //         ->join('matrik_iklan', 'matrik_iklan.id', '=', 'mohon_no_perolehan.matrik_iklan_id')
            //         ->orderBy(KategoriPerolehan::select('nama')->whereColumn('kategori_perolehan.id', 'matrik_iklan.kategori_perolehan_id'), $direction);
            //     }),
            Column::make('Tarikh Kemaskini', 'updated_at')
                ->sortable(),

        ];
    }

    /**

     * Filter jenis iklan

     *

     * @return array

     */

    public function filters(): array

    {

        return [
            'jenis_iklan' => Filter::make('JENIS PEROLEHAN')
                ->multiSelect(
                    JenisIklan::query()
                    ->orderBy('nama')
                    ->get()
                    ->keyBy('id')
                    ->map(fn($tag) => $tag->nama)
                    ->toArray()
                ),
        ];
    }

    /**
     * Row view
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'tunas::livewire.iklan-telah-tutup.iklan-telah-tutup';
    }
}
