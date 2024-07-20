<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('textifyiNumber.textifyi_numbers') ? 'invalid' : '' }}">
        <label class="form-label required" for="textifyi_numbers">{{ trans('cruds.textifyiNumber.fields.textifyi_numbers') }}</label>
        <input class="form-control" type="tel" pattern="[0-9]{10}" name="textifyi_numbers" id="textifyi_numbers" required wire:model.defer="textifyiNumber.textifyi_numbers">
        <div class="validation-message">
            {{ $errors->first('textifyiNumber.textifyi_numbers') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.textifyiNumber.fields.textifyi_numbers_helper') }}
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
