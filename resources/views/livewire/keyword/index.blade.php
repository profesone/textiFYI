<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('keyword_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Keyword" format="csv" />
                <livewire:excel-export model="Keyword" format="xlsx" />
                <livewire:excel-export model="Keyword" format="pdf" />
            @endif


            @can('keyword_create')
                <x-csv-import route="{{ route('admin.keywords.csv.store') }}" />
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
                            {{ trans('cruds.keyword.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.keyword.fields.keyword') }}
                            @include('components.table.sort', ['field' => 'keyword'])
                        </th>
                        <th>
                            {{ trans('cruds.keyword.fields.client') }}
                            @include('components.table.sort', ['field' => 'client.client_name'])
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.company_name') }}
                            @include('components.table.sort', ['field' => 'client.company_name'])
                        </th>
                        <th>
                            {{ trans('cruds.keyword.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keywords as $keyword)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $keyword->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $keyword->id }}
                            </td>
                            <td>
                                {{ $keyword->keyword }}
                            </td>
                            <td>
                                @if($keyword->client)
                                    <span class="badge badge-relationship">{{ $keyword->client->client_name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($keyword->client)
                                    {{ $keyword->client->company_name ?? '' }}
                                @endif
                            </td>
                            <td>
                                @if($keyword->team)
                                    <span class="badge badge-relationship">{{ $keyword->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('keyword_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.keywords.show', $keyword) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('keyword_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.keywords.edit', $keyword) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('keyword_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $keyword->id }})" wire:loading.attr="disabled">
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
            {{ $keywords->links() }}
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