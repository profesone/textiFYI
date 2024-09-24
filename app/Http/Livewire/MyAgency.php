<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;

class MyAgency extends Component
{
    public string $agency;

    public function mount()
    {
        $this->agency = Team::find(auth()->user()->team_id)->name ?? '';
    }

    public function render()
    {
        return view('livewire.my-agency');
    }
}
