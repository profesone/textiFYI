@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.client.title_singular') }}:
                    {{ trans('cruds.client.fields.id') }}
                    {{ $client->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.id') }}
                            </th>
                            <td>
                                {{ $client->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.client_name') }}
                            </th>
                            <td>
                                {{ $client->client_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.company_name') }}
                            </th>
                            <td>
                                {{ $client->company_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.main_contact_number') }}
                            </th>
                            <td>
                                {{ $client->main_contact_number }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.email') }}
                            </th>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $client->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $client->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.texti_fyi_number') }}
                            </th>
                            <td>
                                @if($client->textiFyiNumber)
                                    <span class="badge badge-relationship">{{ $client->textiFyiNumber->textifyi_numbers ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.default_message') }}
                            </th>
                            <td>
                                {{ $client->default_message }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.default_request_message') }}
                            </th>
                            <td>
                                {{ $client->default_request_message }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.default_zipcode_message') }}
                            </th>
                            <td>
                                {{ $client->default_zipcode_message }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.email_address_response') }}
                            </th>
                            <td>
                                {{ $client->email_address_response }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.default_messages_module') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_messages_module ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.default_message_notification') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_message_notification ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.default_message_response') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_message_response ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.publish_keywords_module') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->publish_keywords_module ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.leads_module') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->leads_module ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.keyword_module') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->keyword_module ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.mls_listing_module') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->mls_listing_module ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.mls_agent_notification') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->mls_agent_notification ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.tips_request_module') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->tips_request_module ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.zip_code_module') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->zip_code_module ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.default_zip_notification') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_zip_notification ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.email_address_module') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->email_address_module ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.default_email_notification') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_email_notification ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.created_at') }}
                            </th>
                            <td>
                                {{ $client->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $client->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $client->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.client.fields.team') }}
                            </th>
                            <td>
                                @if($client->team)
                                    <span class="badge badge-relationship">{{ $client->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('client_edit')
                    <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection