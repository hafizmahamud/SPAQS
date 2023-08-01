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
use Modules\Tunas\Models\KehadiranLawatanTapak;


class LaporanBIklanFiltered extends DataTableComponent
{
    public string $emptyMessage = 'Tiada Data';
    /**
     * Builder
     *
     * @return Builder
     */

    public $bahagian;
    public $negeri;
    public $tarikhmula;
    public $tarikhakhir;

    public function mount($post)
    {
        $this->negeri = $post->negeri2;
        $this->bahagian = $post->bahagian2;
        $this->tarikhmula = $post->tarikhmula2;
        $this->tarikhakhir = $post->tarikhakhir2;
    }
    public function query(): Builder
    {
        $query =  IklanPerolehan::where('status_iklan_id','>=',4)
                    ->where('status_iklan_id','<',7)
                    ->with(
                        'user',
                        'mohonNoPerolehan',
                        'mohonNoPerolehan.negeri',
                        'mohonNoPerolehan.matrikIklan.jenisIklan',
                        'mohonNoPerolehan.matrikIklan.kategoriPerolehan',
                        'statusIklan',
                        'kehadiranLawatanTapak',
                        'borangDaftarMinat',
                        'borangDaftarMinatBerjaya',
                        'jadualHarga'
                    )
                    ->whereHas('user', fn($query) => $query->Where('deleted_at', null));

        return $query
                ->when($this->negeri, fn($query, $tags) => $query
                    ->whereHas('mohonNoPerolehan', fn($query) => $query
                        ->where('negeri_id', $tags)))
                ->when($this->bahagian, fn($query, $tags) => $query
                    ->whereHas('mohonNoPerolehan', fn($query) => $query
                        ->where('section_id', $tags)))
                ->when($this->tarikhmula, fn($query, $tags) => $query
                    ->whereDate('tarikh_waktu_tutup',  '>=',$this->tarikhmula)
                    ->whereDate('tarikh_waktu_tutup',  '<=',$this->tarikhakhir));
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
            Column::make('Tarikh Tutup Iklan', 'tarikh_waktu_tutup')
                ->sortable(),
            Column::make('Hadir Lawatan'),
            Column::make('Daftar Saringan'),
            Column::make('Berjaya Saringan'),
            Column::make('Jadual Harga')
        ];
    }

    /**
     * Row view
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'tunas::livewire.laporan-iklan.laporanb-iklan-perolehan';
    }

    public function export()
    {
        $fileName = 'SenaraiIklanPerolehan-Laporan-Petender.csv';
        $query = IklanPerolehan::where('status_iklan_id','>=',4)
                    ->where('status_iklan_id','<',7)
                    ->with(
                        'user',
                        'mohonNoPerolehan',
                        'mohonNoPerolehan.negeri',
                        'mohonNoPerolehan.matrikIklan.jenisIklan',
                        'mohonNoPerolehan.matrikIklan.kategoriPerolehan',
                        'statusIklan',
                        'kehadiranLawatanTapak',
                        'borangDaftarMinat',
                        'borangDaftarMinatBerjaya',
                        'jadualHarga'
                    )
                    ->whereHas('user', fn($query) => $query->Where('deleted_at', null))
                    ->when($this->negeri, fn($query, $tags) => $query
                        ->whereHas('mohonNoPerolehan', fn($query) => $query
                            ->where('negeri_id', $tags)))
                    ->when($this->bahagian, fn($query, $tags) => $query
                        ->where('section_id', $tags))
                    ->when($this->tarikhmula, fn($query, $tags) => $query
                        ->whereDate('tarikh_waktu_tutup',  '>=',$this->tarikhmula)
                        ->whereDate('tarikh_waktu_tutup',  '<=',$this->tarikhakhir))
                    ->get();

        $headers = array(
            "Content-type"        => "text/xlsx",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No.','Negeri','No Perolehan','Tajuk','Tarikh Tutup Iklan','Hadir Lawatan','Daftar Saringan','Berjaya Saringan','Jadual Harga');

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
                $row['Tarikh Tutup Iklan']  = date('d/m/Y', strtotime($query2->tarikh_waktu_tutup));
                $row['Hadir Lawatan']  = $query2->kehadiranLawatanTapak->count();
                $row['Daftar Saringan']  = $query2->borangDaftarMinat->count();
                $row['Berjaya Saringan']  = $query2->borangDaftarMinatBerjaya->count();
                $row['Jadual Harga']  = number_format($query2->jadualHarga->sum('harga'),2);

                fputcsv($file, array($row['No.'], $row['Negeri'], $row['No Perolehan'], $row['Tajuk'], $row['Tarikh Tutup Iklan'], $row['Hadir Lawatan'], $row['Daftar Saringan'], $row['Berjaya Saringan'], $row['Jadual Harga']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPDF()
    {
        $filename = 'SenaraiIklanPerolehan-Laporan-Petender.pdf';
        $detail = IklanPerolehan::where('status_iklan_id','>=',4)->where('status_iklan_id','<',7)
            ->with(
                'user',
                'mohonNoPerolehan',
                'mohonNoPerolehan.negeri',
                'mohonNoPerolehan.matrikIklan.jenisIklan',
                'mohonNoPerolehan.matrikIklan.kategoriPerolehan',
                'statusIklan',
                'kehadiranLawatanTapak',
                'borangDaftarMinat',
                'borangDaftarMinatBerjaya',
                'jadualHarga'
            )
            ->whereHas('user', fn($query) => $query->Where('deleted_at', null))
            ->when($this->negeri, fn($query, $tags) => $query
                ->whereHas('mohonNoPerolehan', fn($query) => $query
                    ->where('negeri_id', $tags)))
            ->when($this->bahagian, fn($query, $tags) => $query
                ->where('section_id', $tags))
            ->when($this->tarikhmula, fn($query, $tags) => $query
                ->whereDate('tarikh_waktu_tutup',  '>=',$this->tarikhmula)
                ->whereDate('tarikh_waktu_tutup',  '<=',$this->tarikhakhir))
            ->get();

        $bil = 0;
        $tarikhm = $this->tarikhmula;
        $tarikhA = $this->tarikhakhir;
        $now = date("d/m/Y");
        $footer = '<div style="font-size: 9px; right: 0;">Janaan Sistem SPAQS Pada Tarikh ' . $now . '</div>';
        $view = \View::make('pdf_laporaniklanb', compact('detail','bil','tarikhm','tarikhA'));
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
