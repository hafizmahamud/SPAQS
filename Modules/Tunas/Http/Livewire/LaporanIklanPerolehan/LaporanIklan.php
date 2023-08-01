<?php

namespace Modules\Tunas\Http\Livewire\LaporanIklanPerolehan;

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
use Elibyy\TCPDF\Facades\TCPDF;

class LaporanIklan extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = IklanPerolehan::where('status_iklan_id','>=',2)->where('status_iklan_id','<',7)
                    ->with('mohonNoPerolehan','mohonNoPerolehan.negeri', 'mohonNoPerolehan.matrikIklan.jenisIklan', 'mohonNoPerolehan.matrikIklan.kategoriPerolehan', 'statusIklan')
                    ->whereHas('user', fn($query) => $query->Where('deleted_at', null));

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
            Column::make(__('Kategori Perolehan'))
                ->sortable(function(Builder $query, $direction) {
                    return $query
                    ->join('mohon_no_perolehan', 'mohon_no_perolehan.id_perolehan', '=', 'iklan_perolehan.mohon_no_perolehan_id')
                    ->join('matrik_iklan', 'matrik_iklan.id', '=', 'mohon_no_perolehan.matrik_iklan_id')
                    ->orderBy(KategoriPerolehan::select('nama')->whereColumn('kategori_perolehan.id', 'matrik_iklan.kategori_perolehan_id'), $direction);
                }),
            Column::make(__('Jenis Perolehan'))
                ->sortable(function(Builder $query, $direction) {
                    return $query
                    ->join('mohon_no_perolehan', 'mohon_no_perolehan.id_perolehan', '=', 'iklan_perolehan.mohon_no_perolehan_id')
                    ->join('matrik_iklan', 'matrik_iklan.id', '=', 'mohon_no_perolehan.matrik_iklan_id')
                    ->orderBy(JenisTender::select('nama')->whereColumn('jenis_tender.id', 'matrik_iklan.jenis_tender_id'), $direction);
                }),
            Column::make('Status'),

        ];
    }


    /**
     * Row view
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'tunas::livewire.laporan-iklan.laporan-iklan-perolehan';
    }

    public function export()
    {
        $fileName = 'SenaraiIklanPerolehan-Laporan-Perolehan.csv';
        $query=IklanPerolehan::where('status_iklan_id','>=',2)->where('status_iklan_id','<',7)
                    ->with('user','mohonNoPerolehan','mohonNoPerolehan.negeri', 'mohonNoPerolehan.matrikIklan.jenisIklan', 'mohonNoPerolehan.matrikIklan.kategoriPerolehan', 'statusIklan')
                    ->whereHas('user', fn($query) => $query->Where('deleted_at', null))
                    ->get();

        $headers = array(
            "Content-type"        => "text/xlsx",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No.','Negeri','No Perolehan','Tajuk','Tarikh Iklan','Tarikh Tutup','Jenis Iklan','Kategori Perolehan','Jenis Perolehan','Status');

        $callback = function() use($query, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $bil = 0;
            foreach ($query as $query2) {
                $bil =  $bil+1;
                $row['No.']  =  $bil;
                $row['Negeri']    = $query2->mohonNoPerolehan->negeri['negeri'];
                $row['No Perolehan']  = $query2->mohonNoPerolehan['no_perolehan'];
                $row['Tajuk']  = $query2->mohonNoPerolehan['tajuk_perolehan'];
                $row['Tarikh Iklan']  = date('d/m/Y', strtotime($query2->tarikh_keluar_iklan));
                $row['Tarikh Tutup']  = date('d/m/Y', strtotime($query2->tarikh_waktu_tutup));
                $row['Jenis Iklan']  = $query2->mohonNoPerolehan->matrikIklan->jenisIklan['nama'];
                $row['Kategori Perolehan']  = $query2->mohonNoPerolehan->matrikIklan->kategoriPerolehan['nama'];
                $row['Jenis Perolehan']  = $query2->mohonNoPerolehan->matrikIklan->jenisTender['nama'];
                $row['Status']  = $query2->statusIklan['status'];

                fputcsv($file, array($row['No.'], $row['Negeri'], $row['No Perolehan'], $row['Tajuk'], $row['Tarikh Iklan'], $row['Tarikh Tutup'], $row['Jenis Iklan'], $row['Kategori Perolehan'], $row['Jenis Perolehan'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPDF()
    {
        $filename = 'SenaraiIklanPerolehan-Laporan-Perolehan.pdf';
        $detail = IklanPerolehan::where('status_iklan_id','>=',2)->where('status_iklan_id','<',7)
                    ->with('user','mohonNoPerolehan','mohonNoPerolehan.negeri', 'mohonNoPerolehan.matrikIklan.jenisIklan', 'mohonNoPerolehan.matrikIklan.kategoriPerolehan', 'statusIklan')
                    ->whereHas('user', fn($query) => $query->Where('deleted_at', null))
                    ->get();
        $bil = 0;
        $tarikhm = "";
        $tarikhA = "";
        $now = date("d/m/Y");
        $footer = '<div style="font-size: 9px; right: 0;">Janaan Sistem SPAQS Pada Tarikh ' . $now . '</div>';
        $view = \View::make('pdf_laporaniklan', compact('detail','bil','tarikhm','tarikhA'));
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Laporan Iklan Perolehan');
        $pdf::SetMargins(5, 10, 5, true);
        $pdf::AddPage('L');
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::setFooterCallback(function($pdf) use ($view,$footer) {
            $pdf->writeHTMLCell(0, 0, 220, -10,$footer);
        });

        try {
            mkdir(base_path('/storage/app/public/download'));
        } catch (\Throwable $th) {
            //throw $th;
        }
        $path = storage_path().'/app/public/download/';

        $pdf::Output($path . $filename, 'F');

        return response()->download($path . $filename);
    }
}
