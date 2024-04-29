<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleanUp extends Model
{
    use HasFactory;
    protected $table = 'clean_ups';
    protected $fillable = [
        'quantity',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
