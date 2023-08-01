<?php

namespace Modules\Tunas\Http\Livewire\JadualHarga;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Tunas\Models\JadualHarga as JH;
use Modules\Tunas\Models\KehadiranLawatanTapak;
use Modules\Tunas\Models\BorangDaftarMinat;

class Jadualharga extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $iklan_perolehan_id;
    public $sortField = 'rujukan'; // default sorting field
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

        $syar = [];
        $jadualHarga = JH::where('iklan_perolehan_id', $this->iklan_perolehan_id)
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->paginate(25);

        $jadualharga = JH::where('iklan_perolehan_id', $this->iklan_perolehan_id)->get();

        for ($i=0; $i < count($jadualharga); $i++) {
            $syarikat_id = $jadualharga[$i]->syarikat_id;
            array_push($syar, $syarikat_id);
        }

        $jadulHargaCount = $jadualharga->count();

        $syarikat  = BorangDaftarMinat::where('iklan_perolehan_id', $this->iklan_perolehan_id)->where('status_resit', 'sah')
                        ->whereNotIn('id', $syar)
                        ->get();

        $iklan_perolehan_id = $this->iklan_perolehan_id;

        return view('tunas::livewire.jadual-harga.jadualharga', compact('jadualHarga', 'syarikat', 'iklan_perolehan_id', 'jadulHargaCount'));
    }
}
