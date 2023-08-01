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
use App\Models\Pejabat;


class LaporanPenilai extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';
    public $year;
    public $bulan = [];


    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {   $this->year = date("Y");
        $month = date("m");
        if ($month >= 1 && $month <= 3){
            array_push($this->bulan, 1);
            array_push($this->bulan, 2);
            array_push($this->bulan, 3);
        }
        else if ($month >= 4 && $month <= 6){
            array_push($this->bulan, 4);
            array_push($this->bulan, 5);
            array_push($this->bulan, 6);
        }
        else if ($month >= 7 && $month <= 9){
            array_push($this->bulan, 7);
            array_push($this->bulan, 8);
            array_push($this->bulan, 9);
        }
        else if ($month >= 10 && $month <= 12){
            array_push($this->bulan, 10);
            array_push($this->bulan, 11);
            array_push($this->bulan, 12);
        }
        // $q->whereYear('created_at', '=', $this->year)->whereMonth('created_at', $this->bulan);
        $query = User::with([
                                'Penilai1' => function($q) {$q->where(function($q) {$q->whereYear('created_at', '<=', $this->year)->whereMonth('created_at', '<=', $this->bulan);})->Where(function($q) {$q->whereYear('tarikh_sah_laku', '=', $this->year)->whereMonth('tarikh_sah_laku', '>=', $this->bulan);}); },
                                'Penilai2' => function($q) {$q->where(function($q) {$q->whereYear('created_at', '<=', $this->year)->whereMonth('created_at', '<=', $this->bulan);})->Where(function($q) {$q->whereYear('tarikh_sah_laku', '=', $this->year)->whereMonth('tarikh_sah_laku', '>=', $this->bulan);}); },
                                'section',
                                'negeri'
                            ])
                    ->where('type','like','user');
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
            Column::make(__('Bil'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy('model_id', $direction);
                }),
            Column::make(__('Nama Pegawai'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy('name', $direction);
                })
                ->searchable(function (Builder $query, $term) {
                    return $query
                            ->where('name', 'like', '%'.$term.'%')
                            ->orWhere('email', 'like', '%'.$term.'%');
                }),
            Column::make(__('Email'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy('email', $direction);
                }),
            Column::make(__('Bahagian'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy(Pejabat::select('bahagian')->whereColumn('users.section_id', 'pejabat.id'), $direction);
                }),
            Column::make(__('Negeri'))                
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy(Negeri::select('negeri')->whereColumn('users.negeri_id', 'negeri.id'), $direction);
                }),
            Column::make(__('Penilai 1')),
            Column::make('Penilai 2'),
        ];
    }


    /**
     * Row view
     *
     * @return string
     */
    public function rowview(): string
    {
        return 'awas::livewire.laporan.laporan-penilai';
    }

    public function export()
    {
        $fileName = 'LaporanPenilai.csv';
        $query = User::with([
                    'Penilai1' => function($q) {$q->where(function($q) {$q->whereYear('created_at', '<=', $this->year)->whereMonth('created_at', '<=', $this->bulan);})->Where(function($q) {$q->whereYear('tarikh_sah_laku', '=', $this->year)->whereMonth('tarikh_sah_laku', '>=', $this->bulan);}); },
                    'Penilai2' => function($q) {$q->where(function($q) {$q->whereYear('created_at', '<=', $this->year)->whereMonth('created_at', '<=', $this->bulan);})->Where(function($q) {$q->whereYear('tarikh_sah_laku', '=', $this->year)->whereMonth('tarikh_sah_laku', '>=', $this->bulan);}); },
                    'section',
                    'negeri'
                ])
                ->where('type','like','user')->get();

        $headers = array(
            "Content-type"        => "text/xlsx",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No.','Nama Pegawai','Email','Bahagian','Negeri','Penilai 1','Penilai 2');

        $callback = function() use($query, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $bil = 0;
            foreach ($query as $query2) {
                $bil =  $bil+1;
                $row['No.']  =  $bil;
                $row['Nama Pegawai']    = $query2['name'];
                $row['Email']    = $query2['email'];
                if ($query2->section != null)
                {
                    $row['Bahagian']    = $query2->section['bahagian'];
                } else {
                    $row['Bahagian']    = "";
                }
                $row['Negeri']    = $query2->negeri['negeri'];
                $row['Penilai 1']  = $query2->Penilai1->count();
                $row['Penilai 2']  = $query2->Penilai2->count();

                fputcsv($file, array($row['No.'], $row['Nama Pegawai'], $row['Email'], $row['Bahagian'], $row['Negeri'], $row['Penilai 1'], $row['Penilai 2']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPDF()
    {
        $filename = 'LaporanPenilai.pdf';
        $detail =  User::with([
                        'Penilai1' => function($q) {$q->where(function($q) {$q->whereYear('created_at', '<=', $this->year)->whereMonth('created_at', '<=', $this->bulan);})->Where(function($q) {$q->whereYear('tarikh_sah_laku', '=', $this->year)->whereMonth('tarikh_sah_laku', '>=', $this->bulan);}); },
                        'Penilai2' => function($q) {$q->where(function($q) {$q->whereYear('created_at', '<=', $this->year)->whereMonth('created_at', '<=', $this->bulan);})->Where(function($q) {$q->whereYear('tarikh_sah_laku', '=', $this->year)->whereMonth('tarikh_sah_laku', '>=', $this->bulan);}); },
                        'section',
                        'negeri'
                    ])
                    ->where('type','like','user')->get();
        $bil = 0;
        $now = date("d/m/Y");
        $footer = '<div style="font-size: 9px; right: 0;">Janaan Sistem SPAQS Pada Tarikh ' . $now . '</div>';
        $view = \View::make('pdf_laporanpenilai', compact('detail','bil'));
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Laporan Penilai');
        $pdf::SetMargins(10, 10, 5, true);
        $pdf::AddPage('P');
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::setFooterCallback(function($pdf) use ($view,$footer) {
            $pdf->writeHTMLCell(0, 0, 130, -10,$footer);
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
