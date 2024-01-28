<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('textResponse.client_id') ? 'invalid' : '' }}">
        <label class="form-label" for="client">{{ trans('cruds.textResponse.fields.client') }}</label>
        <x-select-list class="form-control" id="client" name="client" :options="$this->listsForFields['client']" wire:model="textResponse.client_id" />
        <div class="validation-message">
            {{ $errors->first('textResponse.client_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.client_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('textResponse.campaign') ? 'invalid' : '' }}">
        <label class="form-label required" for="campaign">{{ trans('cruds.textResponse.fields.campaign') }}</label>
        <input class="form-control" type="text" name="campaign" id="campaign" required wire:model.defer="textResponse.campaign">
        <div class="validation-message">
            {{ $errors->first('textResponse.campaign') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.campaign_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('textResponse.response') ? 'invalid' : '' }}">
        <label class="form-label required" for="response">{{ trans('cruds.textResponse.fields.response') }}</label>
        <textarea class="form-control" name="response" id="response" required wire:model.defer="textResponse.response" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('textResponse.response') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.response_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('textResponse.notes') ? 'invalid' : '' }}">
        <label class="form-label" for="notes">{{ trans('cruds.textResponse.fields.notes') }}</label>
        <textarea class="form-control" name="notes" id="notes" wire:model.defer="textResponse.notes" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('textResponse.notes') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.notes_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('textResponse.notification_main') ? 'invalid' : '' }}">
        <label class="form-label" for="notification_main">{{ trans('cruds.textResponse.fields.notification_main') }}</label>
        <input class="form-control" type="text" name="notification_main" id="notification_main" wire:model.defer="textResponse.notification_main">
        <div class="validation-message">
            {{ $errors->first('textResponse.notification_main') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.notification_main_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('textResponse.notification_01') ? 'invalid' : '' }}">
        <label class="form-label" for="notification_01">{{ trans('cruds.textResponse.fields.notification_01') }}</label>
        <input class="form-control" type="text" name="notification_01" id="notification_01" wire:model.defer="textResponse.notification_01">
        <div class="validation-message">
            {{ $errors->first('textResponse.notification_01') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.notification_01_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('keywords') ? 'invalid' : '' }}">
        <label class="form-label" for="keywords">{{ trans('cruds.textResponse.fields.keywords') }}</label>
        <x-select-list class="form-control" id="keywords" name="keywords" wire:model="keywords" :options="$this->listsForFields['keywords']" multiple />
        <div class="validation-message">
            {{ $errors->first('keywords') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.keywords_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('textResponse.main_keyword_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="main_keyword">{{ trans('cruds.textResponse.fields.main_keyword') }}</label>
        <x-select-list class="form-control" required id="main_keyword" name="main_keyword" :options="$this->listsForFields['main_keyword']" wire:model="textResponse.main_keyword_id" />
        <div class="validation-message">
            {{ $errors->first('textResponse.main_keyword_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.main_keyword_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('textResponse.start_date') ? 'invalid' : '' }}">
        <label class="form-label" for="start_date">{{ trans('cruds.textResponse.fields.start_date') }}</label>
        <x-date-picker class="form-control" wire:model="textResponse.start_date" id="start_date" name="start_date" picker="date" />
        <div class="validation-message">
            {{ $errors->first('textResponse.start_date') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.start_date_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('textResponse.end_date') ? 'invalid' : '' }}">
        <label class="form-label" for="end_date">{{ trans('cruds.textResponse.fields.end_date') }}</label>
        <x-date-picker class="form-control" wire:model="textResponse.end_date" id="end_date" name="end_date" picker="date" />
        <div class="validation-message">
            {{ $errors->first('textResponse.end_date') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.end_date_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('textResponse.active') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="active" id="active" wire:model.defer="textResponse.active">
        <label class="form-label inline ml-1" for="active">{{ trans('cruds.textResponse.fields.active') }}</label>
        <div class="validation-message">
            {{ $errors->first('textResponse.active') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textResponse.fields.active_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.text-responses.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>