<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Client" format="csv" />
                <livewire:excel-export model="Client" format="xlsx" />
                <livewire:excel-export model="Client" format="pdf" />
            @endif


            @can('client_create')
                <x-csv-import route="{{ route('admin.clients.csv.store') }}" />
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
                        <th>
                            {{ trans('cruds.client.fields.client_name') }}
                            @include('components.table.sort', ['field' => 'client_name'])
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.company_name') }}
                            @include('components.table.sort', ['field' => 'company_name'])
                        </th>
                        <th>
                            {{ trans('contact number') }}
                            @include('components.table.sort', ['field' => 'main_contact_number'])
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.email') }}
                            @include('components.table.sort', ['field' => 'email'])
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.texti_fyi_number') }}
                            @include('components.table.sort', ['field' => 'texti_fyi_number.textifyi_numbers'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td>
                                {{ $client->client_name }}
                            </td>
                            <td>
                                {{ $client->company_name }}
                            </td>
                            <td>
                                {{ $client->main_contact_number }}
                            </td>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $client->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $client->email }}
                                </a>
                            </td>
                            <td>
                                @if($client->textiFyiNumber)
                                    <span class="badge badge-relationship">{{ $client->textiFyiNumber->textifyi_numbers ?? '' }}</span>
                                @else
                                    <span class="badge badge-relationship">This client has no TextiFYI Number.</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('client_show')
                                        <a class="btn btn-sm btn-indigo mr-2" href="{{ route('admin.clients.show', $client) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('client_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $client->id }})" wire:loading.attr="disabled">
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
            {{ $clients->links() }}
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
