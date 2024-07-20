<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use App\Models\TextifyiNumber;
use Livewire\Component;

class Create extends Component
{
    public Client $client;

    public array $listsForFields = [];

    public function mount(Client $client)
    {
        $this->client                               = $client;
        $this->client->default_messages_module      = false;
        $this->client->default_message_notification = false;
        $this->client->default_message_response     = false;
        $this->client->publish_keywords_module      = false;
        $this->client->leads_module                 = false;
        $this->client->keyword_module               = false;
        $this->client->mls_listing_module           = false;
        $this->client->mls_agent_notification       = false;
        $this->client->tips_request_module          = false;
        $this->client->zip_code_module              = false;
        $this->client->default_zip_notification     = false;
        $this->client->email_address_module         = false;
        $this->client->default_email_notification   = false;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.client.create');
    }

    public function submit()
    {
        $this->validate();

        $this->client->save();

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
                'required',
            ],
            'client.email' => [
                'email:rfc',
                'required',
                'unique:clients,email',
            ],
            'client.texti_fyi_number_id' => [
                'integer',
                'exists:textifyi_numbers,id',
                'nullable',
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
        ];
    }

    protected function initListsForFields(): void
    {
        if (auth()->user()->is_admin) {
            $this->listsForFields['texti_fyi_number'] = TextifyiNumber::whereNull('team_id')
                ->pluck('textifyi_numbers', 'id')->toArray();
        } else {
            $this->listsForFields['texti_fyi_number'] = TextifyiNumber::where('team_id', auth()->user()->team_id)
                ->pluck('textifyi_numbers', 'id')
                ->toArray();
        }
    }
}
