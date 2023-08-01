<?php

namespace Modules\Awas\Http\Livewire\Laporan;

use Livewire\Component;
use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Models\Negeri;
use App\Models\ModelHasRoles;
use Modules\Awas\Models\PenilaianPerolehan;
use Illuminate\Support\Facades\DB;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Sisdant\Models\IklanPerolehan;


class SenaraiPetenderBerjaya extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';

    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = PenilaianPerolehan::where('status_penilaian','syor_tamat')
        ->with('iklanPerolehan.mohonNoPerolehan')
        ->with('iklanPerolehan.mohonNoPerolehan.negeri');

        return $query;

    }

    /**
     * Column
     *
     * @return column
     */
    public function columns(): array
    {
        return [
            Column::make('Bil','id')
            ->sortable(),
            Column::make('Negeri')
            ->sortable(function(Builder $query, $direction) {
                return $query->orderBy(IklanPerolehan::select('mohon_no_perolehan_id')
                ->whereColumn('iklan_perolehan.id', 'penilaian_perolehan.iklan_perolehan_id')
                ->orderBy(PermohonanNomborPerolehan::select('mohon_no_perolehan_id')
                ->whereColumn('mohon_no_perolehan.id_perolehan', 'iklan_perolehan.mohon_no_perolehan_id')
                ->orderBy(Negeri::select('negeri')->whereColumn('negeri.id', 'mohon_no_perolehan.negeri_id'), $direction)));
            }),
            Column::make(__('No Tender/Projek'))
            ->sortable(function(Builder $query, $direction) {
                return $query->orderBy(IklanPerolehan::select('mohon_no_perolehan_id')
                                ->whereColumn('iklan_perolehan.id', 'penilaian_perolehan.iklan_perolehan_id')
                                ->orderBy(PermohonanNomborPerolehan::select('no_perolehan')->whereColumn('mohon_no_perolehan.id_perolehan', 'iklan_perolehan.mohon_no_perolehan_id'), $direction));
            })
            ->searchable(function (Builder $query, $term) {
                return $query->where(
                    fn ($query) => $query->whereHas('mohonNoPerolehan', fn($query) => $query
                            ->where('no_perolehan', 'ilike', '%'.$term.'%')
                            ->orWhere('tajuk_perolehan', 'ilike', '%'.$term.'%')
                        )
                    );
                }),
            Column::make('Tarikh Keputusan LP','tarikh_result')
                ->sortable(),
            Column::make('Tarikh Tamat Sah Tender','tarikh_serah_dokumen_penilaian'),
        ];
    }




    public function rowView(): string
    {
        return 'livewire.frontend.senarai_petender_berjaya';
    }
}
