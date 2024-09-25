@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.customer.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.id') }}
                        </th>
                        <td>
                            {{ $customer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.name') }}
                        </th>
                        <td>
                            {{ $customer->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.address') }}
                        </th>
                        <td>
                            {{ $customer->address }}
                        </td>   
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.city') }}
                        </th>
                        <td>
                            {{ $customer->city }}
                        </td>   
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.country') }}
                        </th>
                        <td>
                            {{ $customer->country }}
                        </td>   
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.zip') }}
                        </th>
                        <td>
                            {{ $customer->zip }}
                        </td>   
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.phone') }}
                        </th>
                        <td>
                            {{ $customer->phone }}
                        </td>   
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.email') }}
                        </th>
                        <td>
                            {{ $customer->email }}
                        </td>   
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.contactperson') }}
                        </th>
                        <td>
                            {{ $customer->contact_person }}
                        </td>   
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.phonecontactperson') }}
                        </th>
                        <td>
                            {{ $customer->phone_contact_person }}
                        </td>   
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.contactpersonemail') }}
                        </th>
                        <td>
                            {{ $customer->email_contact_person }}
                        </td>   
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection