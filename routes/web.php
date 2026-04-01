<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', \App\Livewire\Users\UserIndex::class)->name('users.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/repairs/history', \App\Livewire\Repairs\RepairHistoryIndex::class)->name('repairs.history');
    Route::get('/repairs', \App\Livewire\Repairs\RepairIndex::class)->name('repairs.index');
    Route::get('/repairs/create', \App\Livewire\Repairs\RepairForm::class)->name('repairs.create');
    Route::get('/repairs/{repair}', \App\Livewire\Repairs\RepairShow::class)->name('repairs.show');
    Route::get('/repairs/{repair}/edit', \App\Livewire\Repairs\RepairForm::class)->name('repairs.edit');
    Route::get('/repairs/{repair}/invoice', [\App\Http\Controllers\InvoiceController::class, 'generate'])->name('repairs.invoice');

    // Sales Routes
    Route::get('/sales/history', \App\Livewire\Sales\SalePhoneHistory::class)->name('sales.history');
    Route::get('/sales', \App\Livewire\Sales\SalePhoneIndex::class)->name('sales.index');
    Route::get('/sales/create', \App\Livewire\Sales\SalePhoneForm::class)->name('sales.create');
    Route::get('/sales/{phone}', \App\Livewire\Sales\SalePhoneShow::class)->name('sales.show');
    Route::get('/sales/{phone}/edit', \App\Livewire\Sales\SalePhoneForm::class)->name('sales.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
