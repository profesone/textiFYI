<div>
    @if ($responses)
        <div class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-index w-full">
                    <thead>
                    <tr>
                        <th class="w-9">
                            {{ trans('cruds.textResponse.fields.active') }}
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.campaign') }}
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.response') }}
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.notes') }}
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.notification_main') }}
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.notification_01') }}
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.main_keyword') }}
                        </th>
                        <th>
                            {{ trans('cruds.textResponse.fields.keywords') }}
                        </th>
                        <th>
                            Scheduled
                        </th>
                        <th>
                            Created
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($responses as $index => $textResponse)
                        <tr>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" {{ $textResponse->active ? 'checked' : '' }}>
                            </td>
                            <td> <!-- CAMPAIGN -->
                                @if ($editedRowIndex === $textResponse->id && $editedRowField === 'campaign')
                                    <input type="text" wire:model="edited"/>
                                    <div class="float-right">
                                        <button class="btn btn-sm btn-indigo mr-2"
                                                wire:click="saveField({{$index}})">
                                            Save
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-window-close"
                                                wire:click="$toggle('editedRowField')">
                                        </button>
                                    </div>
                                    @if ($errors->has('textResponse.' . $textResponse->id . '.campaign'))
                                        {{ $errors->first('textResponse.' . $textResponse->id . '.campaign') }}
                                    @endif
                                @else
                                   <button class="badge badge-relationship mr-2"
                                           type="button"
                                           wire:loading.attr="disabled"
                                           wire:click="editedRowField({{ $textResponse->id }}, 'campaign')">
                                       {{ $textResponse->campaign }}
                                   </button>
                                @endif
                            </td>
                            <td> <!-- RESPONSE TEXT -->
                                @if ($editedRowIndex === $textResponse->id && $editedRowField === 'response')
                                    <input type="text" wire:model="edited"/>
                                    <div class="float-right">
                                        <button class="btn btn-sm btn-indigo mr-2"
                                                wire:click="saveField({{$index}})">
                                            Save
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-window-close"
                                                wire:click="$toggle('editedRowField')">
                                        </button>
                                    </div>
                                    @if ($errors->has('textResponse.' . $textResponse->id . '.response'))
                                        {{ $errors->first('textResponse.' . $textResponse->id . '.response') }}
                                    @endif
                                @else
                                    <button class="badge badge-relationship mr-2"
                                            type="button"
                                            wire:loading.attr="disabled"
                                            wire:click="editedRowField({{ $textResponse->id }}, 'response')">
                                        {{ $textResponse->response }}
                                    </button>
                                @endif
                            </td>
                            <td>
                                @if ($editedRowIndex === $textResponse->id && $editedRowField === 'notes')
                                    <input type="text" wire:model="edited"/>
                                    <div class="float-right">
                                        <button class="btn btn-sm btn-indigo mr-2"
                                                wire:click="saveField({{$index}})">
                                            Save
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-window-close"
                                                wire:click="$toggle('editedRowField')">
                                        </button>
                                    </div>
                                    @if ($errors->has('textResponse.' . $textResponse->id . '.notes'))
                                        {{ $errors->first('textResponse.' . $textResponse->id . '.notes') }}
                                    @endif
                                @else
                                    <button class="badge badge-relationship mr-2"
                                            type="button"
                                            wire:loading.attr="disabled"
                                            wire:click="editedRowField({{ $textResponse->id }}, 'notes')">
                                        {{ $textResponse->notes }}
                                    </button>
                                @endif
                            </td>
                            <td> <!-- NOTIFICATION MAIN -->
                                @if ($editedRowIndex === $textResponse->id && $editedRowField === 'notification_main')
                                    <input type="text" wire:model="edited"/>
                                    <div class="float-right">
                                        <button class="btn btn-sm btn-indigo mr-2"
                                                wire:click="saveField({{$index}})">
                                            Save
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-window-close"
                                                wire:click="$toggle('editedRowField')">
                                        </button>
                                    </div>
                                    @if ($errors->has('textResponse.' . $textResponse->id . '.notification_main'))
                                        {{ $errors->first('textResponse.' . $textResponse->id . '.notification_main') }}
                                    @endif
                                @else
                                    <button class="badge badge-relationship mr-2"
                                            type="button"notes
                                            wire:loading.attr="disabled"
                                            wire:click="editedRowField({{ $textResponse->id }}, 'notification_main')">
                                        {{ $textResponse->notification_main }}
                                    </button>
                                @endif
                            </td>
                            <td> <!-- NOTIFICATION 01 -->
                                c
                            </td>
                            <td> <!-- MAIN KEYWORD -->
                                @if ($editedRowIndex === $textResponse->id && $editedRowField === 'mainKeyword')
                                    <input type="text" wire:model="edited"/>
                                    <div class="float-right">
                                        <button class="btn btn-sm btn-indigo mr-2"
                                                wire:click="saveField({{$index}})">
                                            Save
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-window-close"
                                                wire:click="$toggle('editedRowField')">
                                        </button>
                                    </div>
                                @else
                                    <button class="badge badge-relationship mr-2"
                                            type="button"
                                            wire:loading.attr="disabled"
                                            wire:click="editedRowField({{ $textResponse->id }}, 'mainKeyword')">
                                        {{ $textResponse->mainKeyword->keyword  }}
                                    </button>
                                @endif
                            </td>
                            <td> <!-- KEYWORDS -->
                                <input type="text" wire:model="newKeyword"/>
                                 @if(strlen({{ $newKeyword }}) > 1)
                                    <button class="btn btn-sm btn-rose mr-2 fas fa-add"
                                        wire:click="addKeyword({{ newKeyword }})">
                                    </button>
                                     <button class="btn btn-sm btn-rose mr-2 fas fa-close"
                                        wire:click="reset({{ newKeyword }})">
                                    </button>
                                @endif
                                @foreach($textResponse->keywords as $key => $entry)
                                    <button
                                        model:click="saveKeyword({{ $entry->keyword }})"
                                        class="badge badge-relationship mr-2">
                                        <span wire:hover="removeKeyword({{ $key }})">x </span>
                                        {{ $entry->keyword }}
                                    </button>
                                @endforeach
                            </td>
                            <td> <!-- SCHEDULES -->
                                @if (empty($textResponse->start_date) || empty($textResponse->end_date))
                                    <button class="btn btn-sm btn-rose mr-2" type="button" wire:loading.attr="disabled">
                                        Not Scheduled
                                    </button>
                                @else
                                    Started {{ $textResponse->start_date }} <br>
                                    Ends {{ $textResponse->end_date }}
                                @endif

                            </td>
                            <td>
                                @if($textResponse->created_at)
                                    <span class="badge">{{ $textResponse->created_at }}</span>
                                @endif
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
   @endif
</div>

