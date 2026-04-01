<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use App\Models\SalePhone;
use Livewire\WithFileUploads;

class SalePhoneForm extends Component
{
    use WithFileUploads;

    public ?SalePhone $phone = null;

    public $brand, $model;
    public $purchase_price = 0, $repair_cost = 0, $repair_description;
    public $sale_price = 0, $status = 'en_preparacion';
    
    public $photos = [];
    public $existing_images = [];

    protected function rules()
    {
        return [
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'repair_cost' => 'required|numeric|min:0',
            'repair_description' => 'nullable|string',
            'sale_price' => 'required|numeric|min:0',
            'status' => 'required|in:en_preparacion,en_venta,vendido',
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'image|max:5120',
        ];
    }

    public function mount(SalePhone $phone = null)
    {
        if ($phone && $phone->exists) {
            $this->phone = $phone;
            $this->brand = $phone->brand;
            $this->model = $phone->model;
            $this->purchase_price = $phone->purchase_price;
            $this->repair_cost = $phone->repair_cost;
            $this->repair_description = $phone->repair_description;
            $this->sale_price = $phone->sale_price;
            $this->status = $phone->status;
            $this->existing_images = $phone->images ?? [];
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'brand' => $this->brand,
            'model' => $this->model,
            'purchase_price' => $this->purchase_price ?: 0,
            'repair_cost' => $this->repair_cost ?: 0,
            'repair_description' => $this->repair_description,
            'sale_price' => $this->sale_price ?: 0,
            'status' => $this->status,
        ];

        if (count($this->existing_images) + count($this->photos) > 5) {
            $this->addError('photos', 'No puedes guardar más de 5 imágenes en total.');
            return;
        }

        $imagePaths = $this->existing_images;
        foreach ($this->photos as $photo) {
            $imagePaths[] = $photo->store('sales', 'public');
        }
        $data['images'] = $imagePaths;

        if ($this->status === 'vendido') {
            if (!$this->phone || !$this->phone->exists || $this->phone->status !== 'vendido') {
                $data['sold_at'] = now();
            }
        } else {
            $data['sold_at'] = null;
        }

        if (!$this->phone || !$this->phone->exists) {
            SalePhone::create($data);
            session()->flash('message', 'Equipo creado y agregado al inventario.');
        } else {
            $this->phone->update($data);
            session()->flash('message', 'Equipo actualizado con éxito.');
        }

        if ($this->status === 'vendido') {
            return redirect()->route('sales.history');
        }

        return redirect()->route('sales.index');
    }

    public function render()
    {
        return view('livewire.sales.sale-phone-form')->layout('layouts.app');
    }
}
