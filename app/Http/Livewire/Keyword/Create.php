<?php

namespace App\Http\Livewire\Keyword;

use App\Models\Client;
use App\Models\Keyword;
use Livewire\Component;

class Create extends Component
{
    public Keyword $keyword;

    public array $listsForFields = [];

    public function mount(Keyword $keyword)
    {
        $this->keyword = $keyword;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.keyword.create');
    }

    public function submit()
    {
        $this->validate();

        $this->keyword->save();

        return redirect()->route('admin.keywords.index');
    }

    protected function rules(): array
    {
        return [
            'keyword.keyword' => [
                'string',
                'max:120',
                'required',
            ],
            'keyword.client_id' => [
                'integer',
                'exists:clients,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['client'] = Client::pluck('client_name', 'id')->toArray();
    }
}
