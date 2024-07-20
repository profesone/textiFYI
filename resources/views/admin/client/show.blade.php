@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    Client:
                    @if($client->company_name)
                        {{ $client->company_name }}
                    @endif
                    @if($client->textiFyiNumber)
                        TextiFYI #
                        <span class="badge badge-relationship">{{ $client->textiFyiNumber->textifyi_numbers ?? '' }}</span>
                    @endif
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                    <tr>
                        <td>
                            Contact: {{ $client->client_name }}
                        </td>
                        <td>
                            {{ $client->main_contact_number }}
                        </td>
                        <td>
                            {{ $client->email }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ trans('cruds.client.fields.default_message') }}:<br>
                            {{ $client->default_message }}
                        </td>
                        <td>
                            {{ trans('cruds.client.fields.default_request_message') }}:<br>
                            {{ $client->default_request_message }}
                        </td>
                        <td>
                            {{ trans('cruds.client.fields.default_zipcode_message') }}:<br>
                            {{ $client->default_zipcode_message }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ trans('cruds.client.fields.email_address_response') }}:<br>
                            {{ $client->email_address_response }}
                        </td>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_messages_module ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.default_messages_module') }}
                        </td>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_message_notification ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.default_message_notification') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_message_response ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.default_message_response') }}
                        </td>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->publish_keywords_module ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.publish_keywords_module') }}
                        </td>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->leads_module ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.leads_module') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->keyword_module ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.keyword_module') }}
                        </td>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->mls_listing_module ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.mls_listing_module') }}
                        </td>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->mls_agent_notification ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.mls_agent_notification') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->tips_request_module ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.tips_request_module') }}
                        </td>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->zip_code_module ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.zip_code_module') }}
                        </td>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_zip_notification ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.default_zip_notification') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->email_address_module ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.email_address_module') }}
                        </td>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_email_notification ? 'checked' : '' }}>
                            {{ trans('cruds.client.fields.default_email_notification') }}
                        </td>
                        <td>

                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-sm">
                    Created {{ $client->updated_at }}
                @if($client->deleted_at)
                    Deleted on {{ $client->deleted_at }}
                @endif
                </div>
            </div>
            <div class="form-group">
                @can('client_edit')
                    <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }} Client
                    </a>
                @endcan
                <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
            <div class="pt-6"><hr class="max-w-full"></div>
            <div>
                <h6 class="card-title" style="padding-top: 30px">Text Responses</h6>
                @livewire('client.global-view',[$client->id])
            </div>
        </div>
    </div>
</div>
@endsection
