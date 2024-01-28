<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('keyword.keyword') ? 'invalid' : '' }}">
        <label class="form-label required" for="keyword">{{ trans('cruds.keyword.fields.keyword') }}</label>
        <input class="form-control" type="text" name="keyword" id="keyword" required wire:model.defer="keyword.keyword">
        <div class="validation-message">
            {{ $errors->first('keyword.keyword') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.keyword.fields.keyword_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('keyword.client_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="client">{{ trans('cruds.keyword.fields.client') }}</label>
        <x-select-list class="form-control" required id="client" name="client" :options="$this->listsForFields['client']" wire:model="keyword.client_id" />
        <div class="validation-message">
            {{ $errors->first('keyword.client_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.keyword.fields.client_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('keyword.team_id') ? 'invalid' : '' }}">
        <label class="form-label" for="team">{{ trans('cruds.keyword.fields.team') }}</label>
        <x-select-list class="form-control" id="team" name="team" :options="$this->listsForFields['team']" wire:model="keyword.team_id" />
        <div class="validation-message">
            {{ $errors->first('keyword.team_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.keyword.fields.team_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.keywords.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>