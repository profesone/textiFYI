@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.create') }}
                    {{ trans('cruds.client.title_singular') }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('client.create')
        </div>
    </div>
</div>
@endsection