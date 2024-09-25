<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $table = 'customer';

    protected $fillable = [
        'id',
        'company_name',
        'address',
        'city',
        'country',
        'zip',
        'phone',
        'email',
        'contact_person',
        'phone_contact_person',
        'email_contact_person',
        'created_at',
        'updated_at'
    ];

}
