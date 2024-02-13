<?php

namespace App\Http\Livewire\TextResponse;

use App\Models\Client;
use App\Models\Keyword;
use App\Models\TextResponse;
use Livewire\Component;

class Create extends Component
{
    public array $keywords = [];

    public string $add_keyword = '';

    public array $listsForFields = [];

    public TextResponse $textResponse;

    public function mount(TextResponse $textResponse)
    {
        $this->textResponse         = $textResponse;
        $this->textResponse->active = false;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.text-response.create');
    }

    public function add()
    {
        $this->addButton = "Processing..";


        // Add the string keyword if it's not already there.
        if (
            Keyword::where('keyword', $this->add_keyword)->where('client_id', $this->textResponse->client_id)->first()
            || "Keyword already in list." === $this->add_keyword
        )
        {
            $this->add_keyword = "Keyword already in list.";
            return;
        }

        // Update the current keywords array
        if (!empty($this->add_keyword))
        {
            $keyword = new Keyword;
            $keyword->client_id = $this->textResponse->client_id;
            $keyword->keyword = strtolower($this->add_keyword);
            $keyword->save();

            // Update the keyword list
            $this->initListsForFields();

            // Auto add to selected keywords
            $this->listsForFields[] = $this->add_keyword;
            $this->keywords[] = max(array_keys($this->listsForFields['keywords']));
            $this->add_keyword = '';
        }


        $this->addButton = "Add";
    }
    public function submit()
    {
        $this->validate();

        $this->textResponse->save();
        $this->textResponse->keywords()->sync($this->keywords);

        return redirect()->route('admin.text-responses.index');
    }

    protected function rules(): array
    {
        return [
            'textResponse.client_id' => [
                'integer',
                'exists:clients,id',
                'nullable',
            ],
            'textResponse.campaign' => [
                'string',
                'max:100',
                'required',
            ],
            'textResponse.response' => [
                'string',
                'required',
            ],
            'textResponse.notes' => [
                'string',
                'nullable',
            ],
            'textResponse.notification_main' => [
                'string',
                'nullable',
            ],
            'textResponse.notification_01' => [
                'string',
                'nullable',
            ],
            'keywords' => [
                'array',
            ],
            'keywords.*.id' => [
                'integer',
                'exists:keywords,id',
            ],
            'textResponse.main_keyword_id' => [
                'integer',
                'exists:keywords,id',
                'required',
            ],
            'textResponse.start_date' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'textResponse.end_date' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'textResponse.active' => [
                'boolean',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['client']       = Client::pluck('client_name', 'id')->toArray();
        $this->listsForFields['keywords']     = Keyword::pluck('keyword', 'id')->toArray();
        $this->listsForFields['main_keyword'] = Keyword::pluck('keyword', 'id')->toArray();
    }
}
