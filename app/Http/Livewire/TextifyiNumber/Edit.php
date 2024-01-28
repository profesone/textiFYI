<?php

namespace App\Http\Livewire\TextifyiNumber;

use App\Models\Team;
use App\Models\TextifyiNumber;
use Livewire\Component;

class Edit extends Component
{
    public array $listsForFields = [];

    public TextifyiNumber $textifyiNumber;

    public function mount(TextifyiNumber $textifyiNumber)
    {
        $this->textifyiNumber = $textifyiNumber;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.textifyi-number.edit');
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
                'unique:textifyi_numbers,textifyi_numbers,' . $this->textifyiNumber->id,
            ],
            'textifyiNumber.used' => [
                'boolean',
            ],
            'textifyiNumber.team_id' => [
                'integer',
                'exists:teams,id',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['team'] = Team::pluck('name', 'id')->toArray();
    }
}
