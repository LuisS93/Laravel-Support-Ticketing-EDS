<?php

namespace App\Http\Requests;

use App\SerialNumber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySerialNumberRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('serial_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array'
        ];
    }
}
