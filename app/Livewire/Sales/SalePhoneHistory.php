<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use App\Models\SalePhone;
use Livewire\WithPagination;

class SalePhoneHistory extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $phones = SalePhone::where('status', 'vendido')
            ->where(function ($query) {
                $query->where('brand', 'like', '%' . $this->search . '%')
                      ->orWhere('model', 'like', '%' . $this->search . '%');
            })
            ->orderByDesc('sold_at')
            ->paginate(10);

        // Calculate monthly profit for the current month
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $monthlyProfit = SalePhone::where('status', 'vendido')
            ->whereBetween('sold_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('SUM(sale_price - (purchase_price + repair_cost)) as total_profit')
            ->value('total_profit') ?? 0;

        return view('livewire.sales.sale-phone-history', [
            'phones' => $phones,
            'monthlyProfit' => $monthlyProfit,
            'currentMonthName' => ucfirst(now()->translatedFormat('F Y'))
        ])->layout('layouts.app');
    }
}
