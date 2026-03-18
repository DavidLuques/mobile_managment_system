<?php

namespace App\Livewire\Repairs;

use Livewire\Component;

use App\Models\Repair;

class RepairForm extends Component
{
    public ?Repair $repair = null;

    public $customer_name, $customer_phone, $customer_email;
    public $phone_brand, $phone_model, $phone_color;
    public $problem_description, $technical_notes, $repair_cost = 0;
    public $status = 'pendiente', $observations;

    protected function rules()
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'phone_brand' => 'required|string|max:255',
            'phone_model' => 'required|string|max:255',
            'phone_color' => 'nullable|string|max:255',
            'problem_description' => 'required|string',
            'technical_notes' => 'nullable|string',
            'repair_cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:pendiente,en_reparacion,reparado,no_reparable,entregado',
            'observations' => 'nullable|string',
        ];
    }

    public function mount(Repair $repair = null)
    {
        if ($repair && $repair->exists) {
            // Tecs cannot edit if status is reparado, no_reparable, or entregado
            if (in_array($repair->status, ['reparado', 'entregado', 'no_reparable']) && auth()->user()->role !== 'admin') {
                abort(403, 'Sólo el Administrador puede editar una orden que ya está en su fase final (Historial).');
            }

            $this->repair = $repair;
            $this->customer_name = $repair->customer_name;
            $this->customer_phone = $repair->customer_phone;
            $this->customer_email = $repair->customer_email;
            $this->phone_brand = $repair->phone_brand;
            $this->phone_model = $repair->phone_model;
            $this->phone_color = $repair->phone_color;
            $this->problem_description = $repair->problem_description;
            $this->technical_notes = $repair->technical_notes;
            $this->repair_cost = $repair->repair_cost;
            $this->status = $repair->status;
            $this->observations = $repair->observations;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'customer_email' => $this->customer_email,
            'phone_brand' => $this->phone_brand,
            'phone_model' => $this->phone_model,
            'phone_color' => $this->phone_color,
            'problem_description' => $this->problem_description,
            'technical_notes' => $this->technical_notes,
            'repair_cost' => $this->repair_cost ?: 0,
            'status' => $this->status,
            'observations' => $this->observations,
        ];

        if (!$this->repair || !$this->repair->exists) {
            $data['user_id'] = auth()->id();
            $data['entrada_date'] = now();
            if ($this->status === 'reparado') {
                $data['reparado_date'] = now();
            }
            if ($this->status === 'entregado') {
                $data['salida_date'] = now();
            }
            Repair::create($data);
            session()->flash('message', 'Orden de reparación creada con éxito.');
        } else {
            // Check if status changed to reparado
            if ($this->status === 'reparado' && $this->repair->status !== 'reparado') {
                $data['reparado_date'] = now();
            }
            if ($this->status === 'entregado' && $this->repair->status !== 'entregado') {
                $data['salida_date'] = now();
            }
            $this->repair->update($data);
            session()->flash('message', 'Orden de reparación actualizada con éxito.');
        }

        // If saved as a historical status, redirect to history instead of active
        if (in_array($this->status, ['reparado', 'entregado', 'no_reparable'])) {
            return redirect()->route('repairs.history');
        }

        return redirect()->route('repairs.index');
    }

    public function render()
    {
        return view('livewire.repairs.repair-form')->layout('layouts.app');
    }
}
