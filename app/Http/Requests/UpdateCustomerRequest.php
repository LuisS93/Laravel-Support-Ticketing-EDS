<?php

namespace App\Http\Requests;

use App\Customer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        //abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'company_name'                 => [
                'required',             // Nome della compagnia obbligatorio
                'string',               // Deve essere una stringa
                'max:100',              // Massimo 100 caratteri
            ],
            'address'              => [
                'nullable',             // Campo facoltativo
                'string',               // Deve essere una stringa
                'max:100',              // Massimo 100 caratteri
            ],
            'city'                 => [
                'nullable',             // Campo facoltativo
                'string',               // Deve essere una stringa
                'max:100',              // Massimo 100 caratteri
            ],
            'country'              => [
                'nullable',             // Campo facoltativo
                'string',               // Deve essere una stringa
                'size:2',               // Deve essere un codice paese di 2 caratteri
            ],
            'zip'                  => [
                'nullable',             // Campo facoltativo
                'string',               // Deve essere una stringa
                'max:10',               // Massimo 10 caratteri
            ],
            'phone'                => [
                'nullable',             // Campo facoltativo
                'string',               // Deve essere una stringa
                'max:50',               // Massimo 50 caratteri
            ],
            'email'                => [
                'required',             // Campo obbligatorio
                'email',                // Deve essere un'email valida
                'max:80',               // Massimo 80 caratteri
                'unique:customer,email,' . request()->route('customer')->id, // Deve essere univoco nella tabella customers
            ],
            'contact_person'        => [
                'nullable',             // Campo facoltativo
                'string',               // Deve essere una stringa
                'max:100',              // Massimo 100 caratteri
            ],
            'phone_contact_person'  => [
                'nullable',             // Campo facoltativo
                'string',               // Deve essere una stringa
                'max:50',               // Massimo 50 caratteri
            ],
            'email_contact_person'  => [
                'nullable',             // Campo facoltativo
                'email',                // Deve essere un'email valida
                'max:80',               // Massimo 80 caratteri
            ],
        ];
    }

    
}
