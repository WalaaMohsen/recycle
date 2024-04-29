<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompSubscripe extends Model
{
    use HasFactory;
    protected $table = 'comp_subscripes';
    protected $fillable = [
        'patment',
        
        
    ];
    protected $hidden = [
        'remember_token',
    ];
}
