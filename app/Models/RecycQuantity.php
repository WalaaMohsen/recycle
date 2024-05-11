<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecycQuantity extends Model
{
    use HasFactory;
    protected $table = 'recycquantity';
    protected $fillable = [
        'weight',
        'user_id',
        'recycle_id',
        'points'
    ];
    protected $hidden = [
        'remember_token',
    ];

}
