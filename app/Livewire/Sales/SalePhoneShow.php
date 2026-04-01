<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use App\Models\SalePhone;

class SalePhoneShow extends Component
{
    public $phone;

    public function mount(SalePhone $phone)
    {
        $this->phone = $phone;
    }

    public function render()
    {
        return view('livewire.sales.sale-phone-show')->layout('layouts.app');
    }
}
