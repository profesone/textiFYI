<div>
    @if ($responses)
        <div>
            <button class="btn btn-sm btn-success mr-2"
                    wire:click="createResponse()">
                    Create New Text Response <i class=" fas fa-plus"></i>
            </button>
        </div>
        <div class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-index w-full">
                    <thead>
                    <tr>
                        <th></th>
                        <th>
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
                        <th class="w-12">
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
                                <button class="btn btn-sm btn-rose mr-2 fas fa-trash"
                                        wire:click="deleteResponse({{ $textResponse->id }})">
                                </button>
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" {{ $textResponse->active ? 'checked' : '' }}>
                            </td>
                            <td> <!-- CAMPAIGN -->
                                @if ($editedRowIndex === $textResponse->id && $editedRowField === 'campaign')
                                    <input type="text" wire:model="edited"/>
                                    <div class="float-right">
                                        <button class="btn btn-sm btn-indigo mr-2 fas fa-save"
                                                wire:click="saveField({{$index}})">
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-times-circle"
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
                                        <button class="btn btn-sm btn-indigo mr-2 fas fa-save"
                                                wire:click="saveField({{$index}})">
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-times-circle"
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
                                        <button class="btn btn-sm btn-indigo mr-2 fas fa-save"
                                                wire:click="saveField({{$index}})">
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-times-circle"
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
                                        <button class="btn btn-sm btn-indigo mr-2 fas fa-save"
                                                wire:click="saveField({{$index}})">
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-times-circle"
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
                            @if ($editedRowIndex === $textResponse->id && $editedRowField === 'notification_01')
                                    <input type="text" wire:model="edited"/>
                                    <div class="float-right">
                                        <button class="btn btn-sm btn-indigo mr-2 fas fa-save"
                                                wire:click="saveField({{$index}})">
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-times-circle"
                                                wire:click="$toggle('editedRowField')">
                                        </button>
                                    </div>
                                    @if ($errors->has('textResponse.' . $textResponse->id . '.notification_01'))
                                        {{ $errors->first('textResponse.' . $textResponse->id . '.notification_01') }}
                                    @endif
                                @else
                                    <button class="badge badge-relationship mr-2"
                                            type="button"notes
                                            wire:loading.attr="disabled"
                                            wire:click="editedRowField({{ $textResponse->id }}, 'notification_01')">
                                        {{ $textResponse->notification_01 }}
                                    </button>
                                @endif
                            </td>
                            <td> <!-- MAIN KEYWORD -->
                                @if ($editedRowIndex === $textResponse->id && $editedRowField === 'mainKeyword')
                                    <input type="text" wire:model="edited"/>
                                    <div class="float-right">
                                        <button class="btn btn-sm btn-indigo mr-2 fas fa-save"
                                                wire:click="addMainKeyword('{{ $edited }}', {{ $textResponse->id }})">
                                        </button>
                                        <button class="btn btn-sm btn-rose mr-2 fas fa-times-circle"
                                                wire:click="$toggle('editedRowField')">
                                        </button>
                                    </div>
                                @else
                                    <button class="badge badge-relationship mr-2"
                                            type="button"
                                            wire:loading.attr="disabled"
                                            wire:click="editedRowField({{ $textResponse->id }}, 'mainKeyword')">
                                        {{ $textResponse->mainKeyword->keyword ?? ''  }}
                                    </button>
                                @endif
                            </td>
                            <td class="w-12"> <!-- KEYWORDS -->
                                @if ($editedRowIndex === $textResponse->id && $editedRowField === 'keyword')
                                    <input type="text" wire:model="newKeyword"/>
                                        <div class="float-right">
                                            <a class="btn btn-sm btn-success mr-2 fas fa-plus"
                                                wire:click="addKeyword('{{ $newKeyword }}', {{ $textResponse->id }}), $set('editedRowField', 'keyword')">
                                            </a>
                                            <a class="btn btn-sm btn-rose mr-2 fas fa-times-circle"
                                               wire:click="$set('editedRowField', 'textResponse->id')"></a>
                                            <br>
                                        </div>
                                @endif
                                @if(!$editedRowField)
                                    <a class="btn btn-sm btn-success mr-2 fas fa-plus"
                                        wire:click="editedRowField({{ $textResponse->id }}, 'keyword')">
                                    </a>
                                @endif

                                @foreach($textResponse->keywords as $key => $entry)
                                    <div>
                                        <span class="badge badge-relationship mr-2">
                                            <a class="text-rose-600 mr-2 fas fa-times-circle float-left"
                                            wire:click="removeKeyword({{ $textResponse->id }}, {{ $entry->id }})"></a>
                                            {{ $entry->keyword }}
                                        </span>
                                    </div>
                                @endforeach
                            </td>
                            <td> <!-- SCHEDULES -->

                                @if ($editedRowIndex === $textResponse->id && $editedRowField === 'start_date')
                                    <input type="date" wire:model="start_date"/> Start Date<br>
                                    <input type="date" wire:model="end_date"/> End Date
                                    @if($start_date > 0)
                                        <div class="float-right">
                                            <button class="btn btn-sm btn-indigo mr-2 fas fa-save"
                                                    wire:click="updateSchedule({{ $textResponse->id }})">
                                            </button>
                                            <button class="btn btn-sm btn-rose mr-2 fas fa-times-circle"
                                                    wire:click="$toggle('editedRowField')">
                                            </button>
                                        </div>
                                    @endif
                                @else
                                @if (empty($textResponse->start_date) || empty($textResponse->end_date))
                                    <button class="btn btn-sm btn-rose mr-2"
                                        wire:loading.attr="disabled"
                                        wire:click="editedRowField({{ $textResponse->id }}, 'start_date')">
                                        Not Scheduled
                                    </button>
                                    @else
                                        <button class="badge badge-relationship mr-2"
                                            wire:loading.attr="disabled"
                                            wire:click="editedRowField({{ $textResponse->id }}, 'start_date')">Start {{ $textResponse->start_date }}</button> <br>
                                        <button class="badge badge-relationship mr-2"
                                            wire:loading.attr="disabled"
                                            wire:click="editedRowField({{ $textResponse->id }}, 'start_date')">Ends {{ $textResponse->end_date }}</button>
                                    @endif
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

