<?php

namespace App\Http\Livewire\TextifyiNumber;

use App\Models\TextifyiNumber;
use Livewire\Component;

class Create extends Component
{
    public TextifyiNumber $textifyiNumber;

    public function mount(TextifyiNumber $textifyiNumber)
    {
        $this->textifyiNumber = $textifyiNumber;
    }

    public function render()
    {
        return view('livewire.textifyi-number.create');
    }

    public function submit()
    {
        $this->validate();

        $this->textifyiNumber->save();

        return redirect()->route('admin.textifyi-numbers.index');
    }

    protected function rules(): array
    {
        return [
            'textifyiNumber.textifyi_numbers' => [
                'string',
                'max:30',
                'required',
                'unique:textifyi_numbers,textifyi_numbers',
            ],
        ];
    }
}
