@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.keyword.title_singular') }}:
                    {{ trans('cruds.keyword.fields.id') }}
                    {{ $keyword->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.keyword.fields.id') }}
                            </th>
                            <td>
                                {{ $keyword->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.keyword.fields.keyword') }}
                            </th>
                            <td>
                                {{ $keyword->keyword }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.keyword.fields.client') }}
                            </th>
                            <td>
                                @if($keyword->client)
                                    <span class="badge badge-relationship">{{ $keyword->client->client_name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.keyword.fields.team') }}
                            </th>
                            <td>
                                @if($keyword->team)
                                    <span class="badge badge-relationship">{{ $keyword->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('keyword_edit')
                    <a href="{{ route('admin.keywords.edit', $keyword) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.keywords.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection