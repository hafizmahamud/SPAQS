<?php

namespace Modules\Awas\Http\Livewire\Laporan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Models\Negeri;
use App\Models\ModelHasRoles;
use Modules\Awas\Models\PenilaianPerolehan;
use Modules\Tunas\Models\BorangDaftarMinat;
use Illuminate\Support\Facades\DB;


class LaporanPetender extends Component
{
    protected $paginationTheme = 'bootstrap';
    public string $emptyMessage = 'Tiada Data';
    public $sortField = 'id'; // default sorting field
    public $sortAsc = false; // default sort direction

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $perPage = 5;
        $petender = BorangDaftarMinat::select('no_syarikat',DB::raw('count(*) as count'))->groupBy('no_syarikat')
                        ->where('status_petender', '=', 'berjaya')
                        ->paginate(10);
        $jadualharga = BorangDaftarMinat::with('jadualharga')->select('no_syarikat',DB::raw('count(*) as count'))->groupBy('no_syarikat')
                        ->whereHas('jadualharga')
                        ->get();

        $keputusan = PenilaianPerolehan::select('*')->with('borangDaftarMinat')->whereNotNull('keputusan_akhir')->get();
        $countKeputusan = [];
        $countMasuk = [];
        $namaSyarikat = [];
        for($j = 0; $j < count($petender); $j++){
            $menangBool = false;
            $bilMenang = 0;
            for($i = 0; $i < count($keputusan); $i++){
                if ($petender[$j]['no_syarikat'] == $keputusan[$i]->borangDaftarMinat['no_syarikat'])
                {
                    $menangBool = true;
                    $bilMenang = $bilMenang + 1;
                }
            }
            for($i = 0; $i < count($jadualharga); $i++){
                if ($petender[$j]['no_syarikat'] == $jadualharga[$i]['no_syarikat'])
                {
                    $countMasuk[$petender[$j]['no_syarikat']] = $jadualharga[$i]['count'];
                }
            }
            $namaSyarikat[$petender[$j]['no_syarikat']] = BorangDaftarMinat::select('nama_syarikat')->where('no_syarikat', '=', $petender[$j]['no_syarikat'])->first();;
            if ($menangBool)
            {
                $countKeputusan[$petender[$j]['no_syarikat']] = $bilMenang;
            }
            else
            {
                $countKeputusan[$petender[$j]['no_syarikat']] = 0 ;
            }
        }

        return view('awas::livewire.laporan.laporan-petender', compact('petender', 'countKeputusan', 'namaSyarikat', 'countMasuk'));
    }

    public function export()
    {
        $fileName = 'LaporanPetender.csv';
        $petender = BorangDaftarMinat::select('no_syarikat',DB::raw('count(*) as count'))->groupBy('no_syarikat')
                    ->where('status_petender', '=', 'berjaya')
                    ->get();
        
        $jadualharga = BorangDaftarMinat::with('jadualharga')->select('no_syarikat',DB::raw('count(*) as count'))->groupBy('no_syarikat')
                    ->whereHas('jadualharga')
                    ->get();

        $keputusan = PenilaianPerolehan::select('*')->with('borangDaftarMinat')->whereNotNull('keputusan_akhir')->get();
        $countKeputusan = [];
        $countMasuk = [];
        $namaSyarikat = [];
        for($j = 0; $j < count($petender); $j++){
            $menangBool = false;
            $bilMenang = 0;
            for($i = 0; $i < count($keputusan); $i++){
                if ($petender[$j]['no_syarikat'] == $keputusan[$i]->borangDaftarMinat['no_syarikat'])
                {
                    $menangBool = true;
                    $bilMenang = $bilMenang + 1;
                }
            }
            for($i = 0; $i < count($jadualharga); $i++){
                if ($petender[$j]['no_syarikat'] == $jadualharga[$i]['no_syarikat'])
                {
                    $countMasuk[$petender[$j]['no_syarikat']] = $jadualharga[$i]['count'];
                }
            }
            $namaSyarikat[$petender[$j]['no_syarikat']] = BorangDaftarMinat::select('nama_syarikat')->where('no_syarikat', '=', $petender[$j]['no_syarikat'])->first();;
            if ($menangBool)
            {
                $countKeputusan[$petender[$j]['no_syarikat']] = $bilMenang;
            }
            else
            {
                $countKeputusan[$petender[$j]['no_syarikat']] = 0 ;
            }
        }
        $headers = array(
            "Content-type"        => "text/xlsx",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No.','No Syarikat','Nama Syarikat','Minat','Masuk','Menang');

        $callback = function() use($petender, $countKeputusan, $namaSyarikat, $countMasuk, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $bil = 0;
            foreach ($petender as $petender2) {
                $bil =  $bil+1;
                $row['No.']  =  $bil;
                $row['No Syarikat']    = $petender2['no_syarikat'];
                $row['Nama Syarikat']  = $namaSyarikat[$petender2['no_syarikat']]['nama_syarikat'];
                $row['Minat']  = $petender2['count'];
                $row['Masuk']  = $countMasuk[$petender2['no_syarikat']];
                $row['Menang']  = $countKeputusan[$petender2['no_syarikat']];

                fputcsv($file, array($row['No.'], $row['No Syarikat'], $row['Nama Syarikat'], $row['Minat'], $row['Masuk'], $row['Menang']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPDF()
    {
        $filename = 'LaporanPetender.pdf';
        $petender = BorangDaftarMinat::select('no_syarikat',DB::raw('count(*) as count'))->groupBy('no_syarikat')
                    ->where('status_petender', '=', 'berjaya')
                    ->get();
        
        $jadualharga = BorangDaftarMinat::with('jadualharga')->select('no_syarikat',DB::raw('count(*) as count'))->groupBy('no_syarikat')
                    ->whereHas('jadualharga')
                    ->get();

        $keputusan = PenilaianPerolehan::select('*')->with('borangDaftarMinat')->whereNotNull('keputusan_akhir')->get();
        $countKeputusan = [];
        $namaSyarikat = [];
        for($j = 0; $j < count($petender); $j++){
            $menangBool = false;
            $bilMenang = 0;
            for($i = 0; $i < count($keputusan); $i++){
                if ($petender[$j]['no_syarikat'] == $keputusan[$i]->borangDaftarMinat['no_syarikat'])
                {
                    $menangBool = true;
                    $bilMenang = $bilMenang + 1;
                }
            }
            for($i = 0; $i < count($jadualharga); $i++){
                if ($petender[$j]['no_syarikat'] == $jadualharga[$i]['no_syarikat'])
                {
                    $countMasuk[$petender[$j]['no_syarikat']] = $jadualharga[$i]['count'];
                }
            }
            $namaSyarikat[$petender[$j]['no_syarikat']] = BorangDaftarMinat::select('nama_syarikat')->where('no_syarikat', '=', $petender[$j]['no_syarikat'])->first();;
            if ($menangBool)
            {
                $countKeputusan[$petender[$j]['no_syarikat']] = $bilMenang;
            }
            else
            {
                $countKeputusan[$petender[$j]['no_syarikat']] = 0 ;
            }
        }
        $bil = 0;
        $now = date("d/m/Y");
        $footer = '<div style="font-size: 9px; right: 0;">Janaan Sistem SPAQS Pada Tarikh ' . $now . '</div>';
        $view = \View::make('pdf_laporanpetender', compact('petender','bil','countKeputusan','namaSyarikat','countMasuk'));
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

    // /**
    //  * Builder
    //  *
    //  * @return Builder
    //  */
    // public function query(): Builder
    // {
    //     $query = BorangDaftarMinat::select('no_syarikat',DB::raw('count(*) as count'))->groupBy('no_syarikat')
    //                 ->where('status_petender', '=', 'berjaya');

    //     return $query;
    // }


    // /**
    //  * Column
    //  *
    //  * @return array
    //  */
    // public function columns(): array
    // {
    //     return [
    //         Column::make(__('Bil'))
    //             ->sortable(),
    //         Column::make(__('No Syarikat'), 'no_syarikat')
    //             ->sortable(),
    //         Column::make(__('Masuk'), 'count')
    //             ->sortable(),
    //     ];
    // }


    // /**
    //  * Row view
    //  *
    //  * @return string
    //  */
    // public function rowview(): string
    // {
    //     return 'awas::livewire.laporan.laporan-petender';
    // }

}
