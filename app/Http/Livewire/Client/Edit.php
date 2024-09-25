<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use App\Models\Team;
use App\Models\TextifyiNumber;
use Livewire\Component;

class Edit extends Component
{
    public Client $client;

    public array $listsForFields = [];

    public array $texti_fyi_number = [];

    public function mount(Client $client)
    {
        $this->client           = $client;
        $this->texti_fyi_number = $this->client->textiFyiNumber()->pluck('id')->toArray();
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.client.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->client->save();
        $this->client->textiFyiNumber()->sync($this->texti_fyi_number);

        return redirect()->route('admin.clients.index');
    }

    protected function rules(): array
    {
        return [
            'client.client_name' => [
                'string',
                'required',
            ],
            'client.company_name' => [
                'string',
                'nullable',
            ],
            'client.main_contact_number' => [
                'string',
                'nullable',
            ],
            'client.email' => [
                'email:rfc',
                'required',
                'unique:clients,email,' . $this->client->id,
            ],
            'texti_fyi_number' => [
                'array',
            ],
            'texti_fyi_number.*.id' => [
                'integer',
                'exists:textifyi_numbers,id',
            ],
            'client.default_message' => [
                'string',
                'nullable',
            ],
            'client.default_request_message' => [
                'string',
                'nullable',
            ],
            'client.default_zipcode_message' => [
                'string',
                'nullable',
            ],
            'client.email_address_response' => [
                'string',
                'nullable',
            ],
            'client.default_messages_module' => [
                'boolean',
            ],
            'client.default_message_notification' => [
                'boolean',
            ],
            'client.default_message_response' => [
                'boolean',
            ],
            'client.publish_keywords_module' => [
                'boolean',
            ],
            'client.leads_module' => [
                'boolean',
            ],
            'client.keyword_module' => [
                'boolean',
            ],
            'client.mls_listing_module' => [
                'boolean',
            ],
            'client.mls_agent_notification' => [
                'boolean',
            ],
            'client.tips_request_module' => [
                'boolean',
            ],
            'client.zip_code_module' => [
                'boolean',
            ],
            'client.default_zip_notification' => [
                'boolean',
            ],
            'client.email_address_module' => [
                'boolean',
            ],
            'client.default_email_notification' => [
                'boolean',
            ],
            'client.team_id' => [
                'integer',
                'exists:teams,id',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['texti_fyi_number'] = TextifyiNumber::pluck('textifyi_numbers', 'id')->toArray();
        $this->listsForFields['team']             = Team::pluck('name', 'id')->toArray();
    }
}
