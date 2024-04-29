<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Washlists extends Model
{
    use HasFactory;
    protected $table = 'Washlists';
    protected $hidden = [
        'remember_token',
    ];
}
