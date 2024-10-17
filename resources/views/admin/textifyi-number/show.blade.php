@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.textifyiNumber.title_singular') }}:
                    {{ trans('cruds.textifyiNumber.fields.id') }}
                    {{ $textifyiNumber->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.textifyiNumber.fields.id') }}
                            </th>
                            <td>
                                {{ $textifyiNumber->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textifyiNumber.fields.textifyi_numbers') }}
                            </th>
                            <td>
                                {{ $textifyiNumber->textifyi_numbers }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textifyiNumber.fields.used') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $textifyiNumber->used ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textifyiNumber.fields.created_at') }}
                            </th>
                            <td>
                                {{ $textifyiNumber->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textifyiNumber.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $textifyiNumber->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.textifyiNumber.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $textifyiNumber->deleted_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('Agency') }}
                            </th>
                            <td>
                                @if($textifyiNumber->team)
                                    <span class="badge badge-relationship">{{ $textifyiNumber->team->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('textifyi_number_edit')
                    <a href="{{ route('admin.textifyi-numbers.edit', $textifyiNumber) }}" class="btn btn-indigo mr-2">
                        <i class="fas fa-edit"></i>
                    </a>
                @endcan
                <a href="{{ route('admin.textifyi-numbers.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
