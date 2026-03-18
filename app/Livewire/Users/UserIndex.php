<?php

namespace App\Livewire\Users;

use Livewire\Component;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserIndex extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ];

    public function createUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'tecnico',
        ]);

        $this->reset(['name', 'email', 'password']);
        session()->flash('message', 'Técnico creado con éxito.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'tecnico') {
            $user->delete();
            session()->flash('message', 'Técnico eliminado con éxito.');
        }
    }

    public function render()
    {
        return view('livewire.users.user-index', [
            'users' => User::where('role', 'tecnico')->latest()->get()
        ])->layout('layouts.app');
    }
}
