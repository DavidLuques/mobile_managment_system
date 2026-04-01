<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use App\Models\SalePhone;
use Livewire\WithPagination;

class SalePhoneIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deletePhone($id)
    {
        $phone = SalePhone::findOrFail($id);
        $phone->delete();
        session()->flash('message', 'Equipo eliminado del inventario.');
    }

    public function render()
    {
        $phones = SalePhone::whereIn('status', ['en_preparacion', 'en_venta'])
            ->where(function ($query) {
                $query->where('brand', 'like', '%' . $this->search . '%')
                      ->orWhere('model', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.sales.sale-phone-index', compact('phones'))->layout('layouts.app');
    }
}
