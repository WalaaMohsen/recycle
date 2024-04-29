<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $fillable = [
        'name',
        'street',
        'building_num',
        'floor',
        'flat',
        
    ];
    protected $hidden = [
        'remember_token',
    ];
    

}
