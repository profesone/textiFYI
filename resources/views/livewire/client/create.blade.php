<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('client.client_name') ? 'invalid' : '' }}">
        <label class="form-label required" for="client_name">{{ trans('cruds.client.fields.client_name') }}</label>
        <input class="form-control" type="text" name="client_name" id="client_name" required wire:model.defer="client.client_name">
        <div class="validation-message">
            {{ $errors->first('client.client_name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.client.fields.client_name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('client.company_name') ? 'invalid' : '' }}">
        <label class="form-label required" for="company_name">{{ trans('cruds.client.fields.company_name') }}</label>
        <input class="form-control"
               type="text"
               name="company_name"
               id="company_name"
               placeholder="If no company name, provide a unique identifier."
               required wire:model.defer="client.company_name">
        <div class="validation-message">
            {{ $errors->first('client.company_name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.client.fields.company_name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('client.main_contact_number') ? 'invalid' : '' }}">
        <label class="form-label required"
               for="main_contact_number">{{ trans('cruds.client.fields.main_contact_number') }}
        </label>
        <textarea class="form-control"
                  name="main_contact_number"
                  id="main_contact_number"
                  required
                  wire:model.defer="client.main_contact_number"
                  rows="2">
        </textarea>
        <div class="validation-message">
            {{ $errors->first('client.main_contact_number') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.client.fields.main_contact_number_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('client.email') ? 'invalid' : '' }}">
        <label class="form-label required" for="email">{{ trans('cruds.client.fields.email') }}</label>
        <input class="form-control" type="email" name="email" id="email" required wire:model.defer="client.email">
        <div class="validation-message">
            {{ $errors->first('client.email') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.client.fields.email_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('texti_fyi_number') ? 'invalid' : '' }}">
        <label class="form-label" for="texti_fyi_number">{{ trans('cruds.client.fields.texti_fyi_number') }}</label>
        <x-select-list class="form-control" id="texti_fyi_number" name="texti_fyi_number" wire:model="texti_fyi_number" :options="$this->listsForFields['texti_fyi_number']" multiple />
        <div class="validation-message">
            {{ $errors->first('texti_fyi_number') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.client.fields.texti_fyi_number_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('client.default_message') ? 'invalid' : '' }}">
        <label class="form-label" for="default_message">{{ trans('cruds.client.fields.default_message') }}</label>
        <textarea class="form-control" name="default_message" id="default_message" wire:model.defer="client.default_message" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('client.default_message') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.client.fields.default_message_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('client.default_request_message') ? 'invalid' : '' }}">
        <label class="form-label" for="default_request_message">{{ trans('cruds.client.fields.default_request_message') }}</label>
        <textarea class="form-control" name="default_request_message" id="default_request_message" wire:model.defer="client.default_request_message" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('client.default_request_message') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.client.fields.default_request_message_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('client.default_zipcode_message') ? 'invalid' : '' }}">
        <label class="form-label" for="default_zipcode_message">{{ trans('cruds.client.fields.default_zipcode_message') }}</label>
        <textarea class="form-control" name="default_zipcode_message" id="default_zipcode_message" wire:model.defer="client.default_zipcode_message" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('client.default_zipcode_message') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.client.fields.default_zipcode_message_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('client.email_address_response') ? 'invalid' : '' }}">
        <label class="form-label" for="email_address_response">{{ trans('cruds.client.fields.email_address_response') }}</label>
        <textarea class="form-control" name="email_address_response" id="email_address_response" wire:model.defer="client.email_address_response" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('client.email_address_response') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.client.fields.email_address_response_helper') }}
        </div>
    </div>
{{--    <div class="form-group {{ $errors->has('client.default_messages_module') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="default_messages_module" id="default_messages_module" wire:model.defer="client.default_messages_module">--}}
{{--        <label class="form-label inline ml-1" for="default_messages_module">{{ trans('cruds.client.fields.default_messages_module') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.default_messages_module') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.default_messages_module_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.default_message_notification') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="default_message_notification" id="default_message_notification" wire:model.defer="client.default_message_notification">--}}
{{--        <label class="form-label inline ml-1" for="default_message_notification">{{ trans('cruds.client.fields.default_message_notification') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.default_message_notification') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.default_message_notification_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.default_message_response') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="default_message_response" id="default_message_response" wire:model.defer="client.default_message_response">--}}
{{--        <label class="form-label inline ml-1" for="default_message_response">{{ trans('cruds.client.fields.default_message_response') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.default_message_response') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.default_message_response_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.publish_keywords_module') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="publish_keywords_module" id="publish_keywords_module" wire:model.defer="client.publish_keywords_module">--}}
{{--        <label class="form-label inline ml-1" for="publish_keywords_module">{{ trans('cruds.client.fields.publish_keywords_module') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.publish_keywords_module') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.publish_keywords_module_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.leads_module') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="leads_module" id="leads_module" wire:model.defer="client.leads_module">--}}
{{--        <label class="form-label inline ml-1" for="leads_module">{{ trans('cruds.client.fields.leads_module') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.leads_module') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.leads_module_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.keyword_module') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="keyword_module" id="keyword_module" wire:model.defer="client.keyword_module">--}}
{{--        <label class="form-label inline ml-1" for="keyword_module">{{ trans('cruds.client.fields.keyword_module') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.keyword_module') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.keyword_module_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.mls_listing_module') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="mls_listing_module" id="mls_listing_module" wire:model.defer="client.mls_listing_module">--}}
{{--        <label class="form-label inline ml-1" for="mls_listing_module">{{ trans('cruds.client.fields.mls_listing_module') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.mls_listing_module') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.mls_listing_module_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.mls_agent_notification') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="mls_agent_notification" id="mls_agent_notification" wire:model.defer="client.mls_agent_notification">--}}
{{--        <label class="form-label inline ml-1" for="mls_agent_notification">{{ trans('cruds.client.fields.mls_agent_notification') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.mls_agent_notification') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.mls_agent_notification_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.tips_request_module') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="tips_request_module" id="tips_request_module" wire:model.defer="client.tips_request_module">--}}
{{--        <label class="form-label inline ml-1" for="tips_request_module">{{ trans('cruds.client.fields.tips_request_module') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.tips_request_module') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.tips_request_module_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.zip_code_module') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="zip_code_module" id="zip_code_module" wire:model.defer="client.zip_code_module">--}}
{{--        <label class="form-label inline ml-1" for="zip_code_module">{{ trans('cruds.client.fields.zip_code_module') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.zip_code_module') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.zip_code_module_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.default_zip_notification') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="default_zip_notification" id="default_zip_notification" wire:model.defer="client.default_zip_notification">--}}
{{--        <label class="form-label inline ml-1" for="default_zip_notification">{{ trans('cruds.client.fields.default_zip_notification') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.default_zip_notification') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.default_zip_notification_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.email_address_module') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="email_address_module" id="email_address_module" wire:model.defer="client.email_address_module">--}}
{{--        <label class="form-label inline ml-1" for="email_address_module">{{ trans('cruds.client.fields.email_address_module') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.email_address_module') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.email_address_module_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group {{ $errors->has('client.default_email_notification') ? 'invalid' : '' }}">--}}
{{--        <input class="form-control" type="checkbox" name="default_email_notification" id="default_email_notification" wire:model.defer="client.default_email_notification">--}}
{{--        <label class="form-label inline ml-1" for="default_email_notification">{{ trans('cruds.client.fields.default_email_notification') }}</label>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('client.default_email_notification') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.client.fields.default_email_notification_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
