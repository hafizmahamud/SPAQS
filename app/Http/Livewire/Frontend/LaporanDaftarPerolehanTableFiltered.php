<?php
namespace App\Http\Livewire\Frontend;

// phpcs:ignoreFile -- this fail is generated by Laravel
/**
 * LaporanDaftarPerolehanTable File.
 *
 * PHP Version 8.0
 *
 * @category LaporanDaftarPerolehanTable
 * @package  LaporanDaftarPerolehanTable
 * @author   Muhamad Faris <faris@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
use App\Domains\Auth\Models\User;
use Modules\Sisdant\Models\PermohonanNomborPerolehan;
use Modules\Sisdant\Models\MatrikIklan;
use App\Models\Pejabat;
use App\Models\Negeri;
use Modules\Sisdant\Models\JenisIklan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;

// use Livewire\Component;
/**
 * Class LaporanDaftarPerolehanTable.
 *
 * @category LaporanDaftarPerolehanTable
 * @package  LaporanDaftarPerolehanTable
 * @author   Muhamad Faris <faris@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
class LaporanDaftarPerolehanTableFiltered extends DataTableComponent
{
    public string $defaultSortColumn = 'no_perolehan';
    public string $defaultSortDirection = 'desc';
    public string $emptyMessage = 'Tiada Data';

    public $status;
    public $j_iklan;
    public $negeri;
    public $bahagian;
    public $tarikhmula;
    public $tarikhakhir;

    public function mount($post)
    {
        $this->status = $post->status;
        $this->j_iklan = $post->j_iklan;
        $this->k_perolehan = $post->k_perolehan;
        $this->j_perolehan = $post->j_perolehan;
        $this->negeri = $post->negeri;
        $this->bahagian = $post->bahagian;
        $this->tarikhmula = $post->tarikhmula;
        $this->tarikhakhir = $post->tarikhakhir;

    }

    public function columns(): array
    {
        return [
            Column::make(__('Bil'), 'id_perolehan')
                ->sortable(),
            Column::make(__('Bahagian'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy(Pejabat::select('bahagian')->whereColumn('mohon_no_perolehan.section_id', 'pejabat.id'), $direction);
                }),
            Column::make(__('Tajuk'), 'tajuk_perolehan')
                ->sortable()
                ->searchable(function (Builder $query, $term) {
                    return $query
                            ->where('no_perolehan', 'like', '%'.$term.'%')
                            ->orWhere('tajuk_perolehan', 'like', '%'.$term.'%');
                }),
            Column::make(__('Nama Pemohon'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy(User::select('name')->whereColumn('mohon_no_perolehan.user_id', 'users.id'), $direction);
                }),
            Column::make(__('Jenis Iklan'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->join('matrik_iklan', 'mohon_no_perolehan.matrik_iklan_id', '=', 'matrik_iklan.id')
                        ->orderBy(KategoriPerolehan::select('nama')->whereColumn('matrik_iklan.kategori_perolehan_id', 'kategori_perolehan.id'), $direction);
                }),
            Column::make(__('Kategori Perolehan'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->join('matrik_iklan', 'mohon_no_perolehan.matrik_iklan_id', '=', 'matrik_iklan.id')
                    ->orderBy(KategoriPerolehan::select('nama')->whereColumn('matrik_iklan.kategori_perolehan_id', 'kategori_perolehan.id'), $direction);
                }),
            Column::make(__('Jenis Perolehan'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->join('matrik_iklan', 'mohon_no_perolehan.matrik_iklan_id', '=', 'matrik_iklan.id')
                    ->orderBy(JenisTender::select('nama')->whereColumn('jenis_tender.id', 'matrik_iklan.jenis_tender_id'), $direction);
                }),
            Column::make(__('Tahun Perolehan'), 'tahun_perolehan')
                ->sortable(),
            Column::make(__('Tarikh Kemaskini'), 'updated_at')
                ->sortable(),
            Column::make('Status'),
        ];
    }
    /**
     * Builder
     *
     * @return Builder
     */
    public function query(): Builder
    {   $statusquery = ['sah','batal','draf-iklan','iklan'];
        $query = PermohonanNomborPerolehan::with('section', 'matrikIklan.jenisIklan', 'matrikIklan.kategoriPerolehan', 'negeri', 'iklanPerolehan.statusIklan')
                ->whereHas('users', fn($query) => $query->Where('deleted_at', null))
                ->wherein('status',$statusquery);
        return $query
            ->when($this->status, fn($query, $tags) => $query
                = PermohonanNomborPerolehan::with('section', 'matrikIklan.jenisIklan', 'matrikIklan.kategoriPerolehan', 'negeri', 'iklanPerolehan.statusIklan')
                    ->whereHas('users', fn($query) => $query->Where('deleted_at', null))
                    ->where('status',$tags))
            ->when($this->j_iklan, fn($query, $tags) => $query
                ->whereHas('matrikIklan', fn($query) => $query
                    ->where('jenis_iklan_id', $tags)))
            ->when($this->k_perolehan, fn($query, $tags) => $query
                ->whereHas('matrikIklan', fn($query) => $query
                    ->where('kategori_perolehan_id', $tags)))
            ->when($this->j_perolehan, fn($query, $tags) => $query
                ->whereHas('matrikIklan', fn($query) => $query
                    ->where('jenis_tender_id', $tags)))
            ->when($this->negeri, fn($query, $tags) => $query
                ->where('negeri_id', $tags))
            ->when($this->bahagian, fn($query, $tags) => $query
                ->where('section_id', $tags))
            ->when($this->tarikhmula, fn($query, $tags) => $query
                ->whereDate('updated_at',  '>=',$this->tarikhmula)
                ->whereDate('updated_at',  '<=',$this->tarikhakhir))
            ->when($this->getFilter('search'), fn ($query, $term) => $query
                    ->where('no_perolehan', 'ilike', '%'.$term.'%')
                    ->orWhere('tajuk_perolehan', 'ilike', '%'.$term.'%'));
    }

    public function rowView(): string
    {
        return 'livewire.frontend.laporan_perolehan';
    }

    public function export()
    {
        $fileName = 'SenaraiPerolehan.csv';
        $statusquery = ['sah','batal','draf-iklan','iklan'];
        $query = PermohonanNomborPerolehan::with('section', 'matrikIklan.jenisIklan', 'matrikIklan.kategoriPerolehan', 'negeri', 'iklanPerolehan.statusIklan')
                ->whereHas('users', fn($query) => $query->Where('deleted_at', null))
                ->wherein('status',$statusquery)
                ->when($this->status, fn($query, $tags) => $query
                    = PermohonanNomborPerolehan::with('section', 'matrikIklan.jenisIklan', 'matrikIklan.kategoriPerolehan', 'negeri', 'iklanPerolehan.statusIklan')
                        ->whereHas('users', fn($query) => $query->Where('deleted_at', null))
                        ->where('status',$tags))
                ->when($this->j_iklan, fn($query, $tags) => $query
                    ->whereHas('matrikIklan', fn($query) => $query
                        ->where('jenis_iklan_id', $tags)))
                ->when($this->negeri, fn($query, $tags) => $query
                    ->where('negeri_id', $tags))
                ->when($this->bahagian, fn($query, $tags) => $query
                    ->where('section_id', $tags))
                ->when($this->tarikhmula, fn($query, $tags) => $query
                    ->whereDate('updated_at',  '>=',$this->tarikhmula)
                    ->whereDate('updated_at',  '<=',$this->tarikhakhir))
                ->when($this->getFilter('search'), fn ($query, $term) => $query
                    ->where('no_perolehan', 'ilike', '%'.$term.'%')
                    ->orWhere('tajuk_perolehan', 'ilike', '%'.$term.'%'))->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No.','Negeri','Bahagian','No Perolehan','Tajuk','Nama Pemohon','Jenis Iklan','Kategori Perolehan','Jenis Perolehan','Tahun Perolehan','Tarikh Kemaskini','Status');

        $callback = function() use($query, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $bil = 0;
            foreach ($query as $query2) {
                $bil =  $bil + 1;
                $row['No.']  =  $bil;
                $row['Negeri']    = $query2->negeri['negeri'];
                $row['Bahagian']    = $query2->section['bahagian'];
                $row['No Perolehan']  = $query2->no_perolehan;
                $row['Tajuk']  = $query2->tajuk_perolehan;
                $row['Nama Pemohon']  = $query2->users['name'];
                $row['Jenis Iklan']  = $query2->matrikIklan['jenisIklan']['nama'] ;
                $row['Kategori Perolehan']  = $query2->matrikIklan['kategoriPerolehan']['nama'] ;
                $row['Jenis Perolehan']  = $query2->matrikIklan['jenisTender']['nama'] ;
                $row['Tahun Perolehan']  = $query2->tahun_perolehan;
                $row['Tarikh Kemaskini']  = date('d/m/Y', strtotime($query2->updated_at));
                $row['Status']  = $query2->status;

                fputcsv($file, array($row['No.'], $row['Negeri'], $row['Bahagian'], $row['No Perolehan'], $row['Tajuk'], $row['Nama Pemohon'], $row['Jenis Iklan'], $row['Kategori Perolehan'], $row['Jenis Perolehan'], $row['Tahun Perolehan'], $row['Tarikh Kemaskini'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPDF()
    {
        $filename = 'SenaraiPerolehan.pdf';
        $statusquery = ['sah','batal','draf-iklan','iklan'];
        $detail = PermohonanNomborPerolehan::with('section', 'matrikIklan.jenisIklan', 'matrikIklan.kategoriPerolehan', 'negeri', 'iklanPerolehan.statusIklan')
            ->whereHas('users', fn($query) => $query->Where('deleted_at', null))
            ->wherein('status',$statusquery)
            ->when($this->status, fn($query, $tags) => $query
                = PermohonanNomborPerolehan::with('section', 'matrikIklan.jenisIklan', 'matrikIklan.kategoriPerolehan', 'negeri', 'iklanPerolehan.statusIklan')
                    ->whereHas('users', fn($query) => $query->Where('deleted_at', null))
                    ->where('status',$tags))
            ->when($this->j_iklan, fn($query, $tags) => $query
                ->whereHas('matrikIklan', fn($query) => $query
                    ->where('jenis_iklan_id', $tags)))
            ->when($this->negeri, fn($query, $tags) => $query
                ->where('negeri_id', $tags))
            ->when($this->bahagian, fn($query, $tags) => $query
                ->where('section_id', $tags))
            ->when($this->tarikhmula, fn($query, $tags) => $query
                ->whereDate('updated_at',  '>=',$this->tarikhmula)
                ->whereDate('updated_at',  '<=',$this->tarikhakhir))
            ->when($this->getFilter('search'), fn ($query, $term) => $query
                ->where('no_perolehan', 'ilike', '%'.$term.'%')
                ->orWhere('tajuk_perolehan', 'ilike', '%'.$term.'%'))->get();

        $bil = 0;
        $tarikhm = $this->tarikhmula;
        $tarikhA = $this->tarikhakhir;
        $now = date("d/m/Y");
        $footer = '<div style="font-size: 9px; right: 0;">Janaan Sistem SPAQS Pada Tarikh ' . $now . '</div>';
        $view = \View::make('pdf_laporan', compact('detail','bil','tarikhm','tarikhA'));
        $html = $view->render();

        $pdf = new TCPDF;

        $pdf::SetTitle('Laporan Daftar Perolehan');
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
