<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('textifyiNumber.textifyi_numbers') ? 'invalid' : '' }}">
        <label class="form-label required" for="textifyi_numbers">{{ trans('cruds.textifyiNumber.fields.textifyi_numbers') }}</label>
        <input class="form-control" type="text" name="textifyi_numbers" id="textifyi_numbers" required wire:model.defer="textifyiNumber.textifyi_numbers">
        <div class="validation-message">
            {{ $errors->first('textifyiNumber.textifyi_numbers') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textifyiNumber.fields.textifyi_numbers_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('textifyiNumber.agency_id') ? 'invalid' : '' }}">
        <label class="form-label" for="agency">{{ trans('Agency') }}</label>
        <x-select-list class="form-control" id="agency" name="agency" :options="$this->listsForFields['agency']" wire:model="textifyiNumber.agency_id" />
        <div class="validation-message">
            {{ $errors->first('textifyiNumber.agency_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textifyiNumber.fields.agency_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.textifyi-numbers.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
