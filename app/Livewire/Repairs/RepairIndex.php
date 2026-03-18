<?php

namespace App\Livewire\Repairs;

use Livewire\Component;

use App\Models\Repair;
use Livewire\WithPagination;

class RepairIndex extends Component
{
    use WithPagination;

    public function deleteRepair($id)
    {
        $repair = Repair::findOrFail($id);
        $repair->delete();
        session()->flash('message', 'Orden de reparación eliminada con éxito.');
    }

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $repairs = Repair::with('user')
            ->whereNotIn('status', ['reparado', 'entregado', 'no_reparable'])
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                      ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_brand', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_model', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
        return view('livewire.repairs.repair-index', compact('repairs'))->layout('layouts.app');
    }
}
