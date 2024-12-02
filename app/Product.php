<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table = 'product';

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
        'updated_at'
    ];
}
