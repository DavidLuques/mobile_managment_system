<?php

namespace App\Livewire\Repairs;

use App\Models\Repair;
use Livewire\Component;

class RepairShow extends Component
{
    public Repair $repair;

    public function mount(Repair $repair)
    {
        $this->repair = $repair;
    }

    public function render()
    {
        return view('livewire.repairs.repair-show')->layout('layouts.app');
    }
}
