<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recycle extends Model
{
    use HasFactory;
    protected $table = 'recycle';
    protected $fillable = [
        'type',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
