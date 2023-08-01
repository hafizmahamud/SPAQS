<?php

namespace Modules\Tunas\Http\Livewire\JadualHarga;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Tunas\Models\JadualHarga as JH;
use Modules\Sisdant\Models\IklanPerolehan;

class ModalJadualharga extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $iklan_perolehan_id;
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

    public function mount($id)
    {
        $this->iklan_perolehan_id = $id;
    }

    public function render()
    {
        $perPage = 5;
        $iklantutup  = IklanPerolehan::where('id', $this->iklan_perolehan_id)->with('mohonNoPerolehan.negeri', 'mohonNoPerolehan.matrikIklan.jenisIklan', 'mohonNoPerolehan.matrikIklan.kategoriPerolehan')
                ->get();
        $jadualHarga = JH::where('iklan_perolehan_id', $this->iklan_perolehan_id)
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->paginate(25);

        $jadualharga = JH::where('iklan_perolehan_id', $this->iklan_perolehan_id)->get();

        $jadulHargaCount = $jadualharga->count();

        return view('tunas::livewire.jadual-harga.modal-jadualharga', ['jadualHarga' => $jadualHarga, 'iklantutup' => $iklantutup, 'jadualT' => $jadulHargaCount ]);
    }
}
