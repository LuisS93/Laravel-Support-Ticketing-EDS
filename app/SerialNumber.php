<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    use HasFactory;
    public $table = 'serial_number';

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
        'updated_at'
    ];
}
