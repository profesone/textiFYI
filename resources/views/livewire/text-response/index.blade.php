<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('text_response_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="TextResponse" format="csv" />
                <livewire:excel-export model="TextResponse" format="xlsx" />
                <livewire:excel-export model="TextResponse" format="pdf" />
            @endif


            @can('text_response_create')
                <x-csv-import route="{{ route('admin.text-responses.csv.store') }}" />
            @endcan

        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.textResponse.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.client') }}
                            @include('components.table.sort', ['field' => 'client.client_name'])
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.campaign') }}
                            @include('components.table.sort', ['field' => 'campaign'])
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.response') }}
                            @include('components.table.sort', ['field' => 'response'])
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.notification_main') }}
                            @include('components.table.sort', ['field' => 'notification_main'])
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.notification_01') }}
                            @include('components.table.sort', ['field' => 'notification_01'])
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.keywords') }}
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.main_keyword') }}
                            @include('components.table.sort', ['field' => 'main_keyword.keyword'])
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.start_date') }}
                            @include('components.table.sort', ['field' => 'start_date'])
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.end_date') }}
                            @include('components.table.sort', ['field' => 'end_date'])
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.active') }}
                            @include('components.table.sort', ['field' => 'active'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($textResponses as $textResponse)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $textResponse->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $textResponse->id }}
                            </td>
                            <td>
                                @if($textResponse->client)
                                    <span class="badge badge-relationship">{{ $textResponse->client->client_name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $textResponse->campaign }}
                            </td>
                            <td>
                                {{ $textResponse->response }}
                            </td>
                            <td>
                                {{ $textResponse->notification_main }}
                            </td>
                            <td>
                                {{ $textResponse->notification_01 }}
                            </td>
                            <td>
                                @foreach($textResponse->keywords as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->keyword }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($textResponse->mainKeyword)
                                    <span class="badge badge-relationship">{{ $textResponse->mainKeyword->keyword ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $textResponse->start_date }}
                            </td>
                            <td>
                                {{ $textResponse->end_date }}
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $textResponse->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('text_response_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.text-responses.show', $textResponse) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('text_response_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.text-responses.edit', $textResponse) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('text_response_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $textResponse->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $textResponses->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush