<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('textifyi_number_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="TextifyiNumber" format="csv" />
                <livewire:excel-export model="TextifyiNumber" format="xlsx" />
                <livewire:excel-export model="TextifyiNumber" format="pdf" />
            @endif


            @can('textifyi_number_create')
                <x-csv-import route="{{ route('admin.textifyi-numbers.csv.store') }}" />
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
{{ auth()->user()->owned_team }}
    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th>
                            {{ trans('cruds.textifyiNumber.fields.textifyi_numbers') }}
                            @include('components.table.sort', ['field' => 'textifyi_numbers'])
                        </th>
                        <th>
                            {{ trans('cruds.textifyiNumber.fields.created_at') }}
                            @include('components.table.sort', ['field' => 'created_at'])
                        </th>
                        <th>
                            {{ trans('cruds.textifyiNumber.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($textifyiNumbers as $textifyiNumber)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $textifyiNumber->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $textifyiNumber->textifyi_numbers }}
                            </td>
                            <td>
                                {{ $textifyiNumber->created_at }}
                            </td>
                            <td>
                                @if($textifyiNumber->team)
                                    <span class="badge badge-relationship">{{ $textifyiNumber->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('textifyi_number_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.textifyi-numbers.show', $textifyiNumber) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                    @can('textifyi_number_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.textifyi-numbers.edit', $textifyiNumber) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('textifyi_number_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $textifyiNumber->id }})" wire:loading.attr="disabled">
                                            <i class="fas fa-trash"></i>
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
            {{ $textifyiNumbers->links() }}
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
