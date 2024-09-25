@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.customer.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.customers.update", [$customer->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
            <label for="company_name">{{ trans('cruds.customer.fields.name') }}*</label>
            <input type="text" id="company_name" name="company_name" class="form-control" value="{{ old('name', isset($customer) ? $customer->company_name : '') }}" required>
            @if($errors->has('company_name'))
                <em class="invalid-feedback">
                    {{ $errors->first('company_name') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.customer.fields.name_helper') }}
            </p>
        </div>

        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
            <label for="address">{{ trans('cruds.customer.fields.address') }}</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($customer) ? $customer->address : '') }}">
            @if($errors->has('address'))
                <em class="invalid-feedback">
                    {{ $errors->first('address') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.customer.fields.address_helper') }}
            </p>
        </div>

        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
            <label for="city">{{ trans('cruds.customer.fields.city') }}</label>
            <input type="text" id="city" name="city" class="form-control" value="{{ old('city', isset($customer) ? $customer->city : '') }}">
            @if($errors->has('city'))
                <em class="invalid-feedback">
                    {{ $errors->first('city') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.customer.fields.city_helper') }}
            </p>
        </div>

        <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
            <label for="country">{{ trans('cruds.customer.fields.country') }}</label>
            <input type="text" id="country" name="country" class="form-control" value="{{ old('country', isset($customer) ? $customer->country : '') }}">
            @if($errors->has('country'))
                <em class="invalid-feedback">
                    {{ $errors->first('country') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.customer.fields.country_helper') }}
            </p>
        </div>

        <div class="form-group {{ $errors->has('zip') ? 'has-error' : '' }}">
            <label for="zip">{{ trans('cruds.customer.fields.zip') }}</label>
            <input type="text" id="zip" name="zip" class="form-control" value="{{ old('zip', isset($customer) ? $customer->zip : '') }}">
            @if($errors->has('zip'))
                <em class="invalid-feedback">
                    {{ $errors->first('zip') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.customer.fields.zip_helper') }}
            </p>
        </div>

        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
            <label for="phone">{{ trans('cruds.customer.fields.phone') }}</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($customer) ? $customer->phone : '') }}">
            @if($errors->has('phone'))
                <em class="invalid-feedback">
                    {{ $errors->first('phone') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.customer.fields.phone_helper') }}
            </p>
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="email">{{ trans('cruds.customer.fields.email') }}</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($customer) ? $customer->email : '') }}">
            @if($errors->has('email'))
                <em class="invalid-feedback">
                    {{ $errors->first('email') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.customer.fields.email_helper') }}
            </p>
        </div>

        <div class="form-group {{ $errors->has('contact_person') ? 'has-error' : '' }}">
            <label for="contact_person">{{ trans('cruds.customer.fields.contactperson') }}</label>
            <input type="text" id="contact_person" name="contact_person" class="form-control" value="{{ old('contact_person', isset($customer) ? $customer->contact_person : '') }}">
            @if($errors->has('contact_person'))
                <em class="invalid-feedback">
                    {{ $errors->first('contact_person') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.customer.fields.contactperson_helper') }}
            </p>
        </div>

        <div class="form-group {{ $errors->has('phone_contact_person') ? 'has-error' : '' }}">
            <label for="phone_contact_person">{{ trans('cruds.customer.fields.phonecontactperson') }}</label>
            <input type="text" id="phone_contact_person" name="phone_contact_person" class="form-control" value="{{ old('phone_contact_person', isset($customer) ? $customer->phone_contact_person : '') }}">
            @if($errors->has('phone_contact_person'))
                <em class="invalid-feedback">
                    {{ $errors->first('phone_contact_person') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.customer.fields.phonecontactperson_helper') }}
            </p>
        </div>

        <div class="form-group {{ $errors->has('email_contact_person') ? 'has-error' : '' }}">
            <label for="email_contact_person">{{ trans('cruds.customer.fields.contactpersonemail') }}</label>
            <input type="text" id="email_contact_person" name="email_contact_person" class="form-control" value="{{ old('email_contact_person', isset($customer) ? $customer->email_contact_person : '') }}">
            @if($errors->has('email_contact_person'))
                <em class="invalid-feedback">
                    {{ $errors->first('email_contact_person') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.customer.fields.contactpersonemail_helper') }}
            </p>
        </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection