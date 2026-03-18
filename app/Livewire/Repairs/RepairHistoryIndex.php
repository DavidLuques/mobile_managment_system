<?php

namespace App\Livewire\Repairs;

use App\Models\Repair;
use Livewire\Component;
use Livewire\WithPagination;

class RepairHistoryIndex extends Component
{
    use WithPagination;

    public function deleteRepair($id)
    {
        // Solo el admin podria eliminar historicos, o quizas ni eso. Lo validamos.
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $repair = Repair::findOrFail($id);
        $repair->delete();
        session()->flash('message', 'Orden historica eliminada con éxito.');
    }

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // En el historial van los que ya finalizaron su ciclo: reparado, no_reparable, entregado
        $repairs = Repair::with('user')
            ->whereIn('status', ['reparado', 'no_reparable', 'entregado'])
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                      ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_brand', 'like', '%' . $this->search . '%')
                      ->orWhere('phone_model', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
            
        return view('livewire.repairs.repair-history', compact('repairs'))->layout('layouts.app');
    }
}
