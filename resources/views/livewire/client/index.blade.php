<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('client_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

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
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.client.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.company_name') }}
                            @include('components.table.sort', ['field' => 'company_name'])
                        </th>
                        <th>
                            Contact Number/s
                            @include('components.table.sort', ['field' => 'main_contact_number'])
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.email') }}
                            @include('components.table.sort', ['field' => 'email'])
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.texti_fyi_number') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.default_message') }}--}}
{{--                            @include('components.table.sort', ['field' => 'default_message'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.default_request_message') }}--}}
{{--                            @include('components.table.sort', ['field' => 'default_request_message'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.default_zipcode_message') }}--}}
{{--                            @include('components.table.sort', ['field' => 'default_zipcode_message'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.email_address_response') }}--}}
{{--                            @include('components.table.sort', ['field' => 'email_address_response'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.default_messages_module') }}--}}
{{--                            @include('components.table.sort', ['field' => 'default_messages_module'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.default_message_notification') }}--}}
{{--                            @include('components.table.sort', ['field' => 'default_message_notification'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.default_message_response') }}--}}
{{--                            @include('components.table.sort', ['field' => 'default_message_response'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.publish_keywords_module') }}--}}
{{--                            @include('components.table.sort', ['field' => 'publish_keywords_module'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.leads_module') }}--}}
{{--                            @include('components.table.sort', ['field' => 'leads_module'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.keyword_module') }}--}}
{{--                            @include('components.table.sort', ['field' => 'keyword_module'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.mls_listing_module') }}--}}
{{--                            @include('components.table.sort', ['field' => 'mls_listing_module'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.mls_agent_notification') }}--}}
{{--                            @include('components.table.sort', ['field' => 'mls_agent_notification'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.tips_request_module') }}--}}
{{--                            @include('components.table.sort', ['field' => 'tips_request_module'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.zip_code_module') }}--}}
{{--                            @include('components.table.sort', ['field' => 'zip_code_module'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.default_zip_notification') }}--}}
{{--                            @include('components.table.sort', ['field' => 'default_zip_notification'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.email_address_module') }}--}}
{{--                            @include('components.table.sort', ['field' => 'email_address_module'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.default_email_notification') }}--}}
{{--                            @include('components.table.sort', ['field' => 'default_email_notification'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.created_at') }}--}}
{{--                            @include('components.table.sort', ['field' => 'created_at'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.updated_at') }}--}}
{{--                            @include('components.table.sort', ['field' => 'updated_at'])--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.client.fields.deleted_at') }}--}}
{{--                            @include('components.table.sort', ['field' => 'deleted_at'])--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.client.fields.team') }}
                            @include('components.table.sort', ['field' => 'team.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($clients as $client)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $client->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $client->id }}
                            </td>
                           <td>
                                {{ $client->company_name }}<br>
                                <span class="text-xs">{{ $client->client_name }}</span>
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
                                @foreach($client->textiFyiNumber as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->textifyi_numbers }}</span>
                                @endforeach
                            </td>
{{--                            <td>--}}
{{--                                {{ $client->default_message }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ $client->default_request_message }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ $client->default_zipcode_message }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ $client->email_address_response }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_messages_module ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_message_notification ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_message_response ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->publish_keywords_module ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->leads_module ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->keyword_module ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->mls_listing_module ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->mls_agent_notification ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->tips_request_module ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->zip_code_module ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_zip_notification ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->email_address_module ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $client->default_email_notification ? 'checked' : '' }}>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ $client->created_at }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ $client->updated_at }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ $client->deleted_at }}--}}
{{--                            </td>--}}
                            <td>
                                @if($client->team)
                                    <span class="badge badge-relationship">{{ $client->team->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('client_show')
                                        <a class="btn btn-sm btn-indigo mr-2" href="{{ route('admin.clients.show', $client) }}">
                                            <i class="fas fa-search"></i>
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
