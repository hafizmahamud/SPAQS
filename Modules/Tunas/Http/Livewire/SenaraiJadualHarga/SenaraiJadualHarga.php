<?php

namespace Modules\Tunas\Http\Livewire\SenaraiJadualHarga;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Tunas\Models\JadualHarga as JH;
use Modules\Sisdant\Models\IklanPerolehan;

class SenaraiJadualHarga extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $iklan_perolehan_id;
    public $latitud;

    protected $listeners = [
        'iklanPerolehan'
    ];

    public $sortField = 'rujukan'; // default sorting field
    public $sortAsc = true; // default sort direction

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

     /**
     * Mount
     *
     * @param int $id comment about this variable
     *
     * @return string
     */

    public function iklanPerolehan($id)
    {
        if(!is_null($id)){
            $this->iklan_perolehan_id = $id;
        } else {
            $this->iklan_perolehan_id = '';
        }
    }

    public function render()
    {
        $perPage = 5;
        if($this->iklan_perolehan_id ){
            $iklantutup  = IklanPerolehan::where('id', $this->iklan_perolehan_id)->with('mohonNoPerolehan.negeri', 'mohonNoPerolehan.matrikIklan.jenisIklan', 'mohonNoPerolehan.matrikIklan.kategoriPerolehan')
                    ->get();
            $jadualharga = JH::where('iklan_perolehan_id', $this->iklan_perolehan_id)->get();
            $jadulHargaCount = $jadualharga->count();

            $jadualHarga = JH::where('iklan_perolehan_id', $this->iklan_perolehan_id)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate(25);
        } else {
            $iklantutup = collect([]);
            $jadualHarga = collect([]);
            $jadulHargaCount = 0;

        }
        return view('tunas::livewire.senarai-jadual-harga.senarai-jadual-harga', ['jadualHarga' => $jadualHarga, 'iklantutup' => $iklantutup, 'jadualT' => $jadulHargaCount ]);
    }

}
