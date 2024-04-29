<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntikaeReviews extends Model
{
    use HasFactory;
    protected $table = 'antikae_reviews';
    protected $fillable = [
        'value',
        'comment',
        
    ];
    protected $hidden = [
        'remember_token',
    ];
}
