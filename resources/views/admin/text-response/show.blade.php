@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.textResponse.title_singular') }}:
                    {{ trans('cruds.textResponse.fields.id') }}
                    {{ $textResponse->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.id') }}
                            </th>
                            <td>
                                {{ $textResponse->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.client') }}
                            </th>
                            <td>
                                @if($textResponse->client)
                                    <span class="badge badge-relationship">{{ $textResponse->client->client_name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.campaign') }}
                            </th>
                            <td>
                                {{ $textResponse->campaign }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.response') }}
                            </th>
                            <td>
                                {{ $textResponse->response }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.notes') }}
                            </th>
                            <td>
                                {{ $textResponse->notes }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.notification_main') }}
                            </th>
                            <td>
                                {{ $textResponse->notification_main }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.notification_01') }}
                            </th>
                            <td>
                                {{ $textResponse->notification_01 }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.keywords') }}
                            </th>
                            <td>
                                @foreach($textResponse->keywords as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->keyword }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.main_keyword') }}
                            </th>
                            <td>
                                @if($textResponse->mainKeyword)
                                    <span class="badge badge-relationship">{{ $textResponse->mainKeyword->keyword ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.start_date') }}
                            </th>
                            <td>
                                {{ $textResponse->start_date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.end_date') }}
                            </th>
                            <td>
                                {{ $textResponse->end_date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.active') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $textResponse->active ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.created_at') }}
                            </th>
                            <td>
                                {{ $textResponse->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $textResponse->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $textResponse->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textResponse.fields.team') }}
                            </th>
                            <td>
                                @if($textResponse->team)
                                    <span class="badge badge-relationship">{{ $textResponse->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('text_response_edit')
                    <a href="{{ route('admin.text-responses.edit', $textResponse) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.text-responses.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection