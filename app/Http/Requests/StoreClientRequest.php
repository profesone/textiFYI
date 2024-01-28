<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('client_create'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            'client_name' => [
                'string',
                'required',
            ],
            'company_name' => [
                'string',
                'nullable',
            ],
            'main_contact_number' => [
                'string',
                'required',
            ],
            'email' => [
                'email:rfc',
                'required',
                'unique:clients,email',
            ],
            'texti_fyi_number_id' => [
                'integer',
                'exists:textifyi_numbers,id',
                'nullable',
            ],
            'default_message' => [
                'string',
                'nullable',
            ],
            'default_request_message' => [
                'string',
                'nullable',
            ],
            'default_zipcode_message' => [
                'string',
                'nullable',
            ],
            'email_address_response' => [
                'string',
                'nullable',
            ],
            'default_messages_module' => [
                'boolean',
            ],
            'default_message_notification' => [
                'boolean',
            ],
            'default_message_response' => [
                'boolean',
            ],
            'publish_keywords_module' => [
                'boolean',
            ],
            'leads_module' => [
                'boolean',
            ],
            'keyword_module' => [
                'boolean',
            ],
            'mls_listing_module' => [
                'boolean',
            ],
            'mls_agent_notification' => [
                'boolean',
            ],
            'tips_request_module' => [
                'boolean',
            ],
            'zip_code_module' => [
                'boolean',
            ],
            'default_zip_notification' => [
                'boolean',
            ],
            'email_address_module' => [
                'boolean',
            ],
            'default_email_notification' => [
                'boolean',
            ],
        ];
    }
}
