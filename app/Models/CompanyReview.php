<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    use HasFactory;
    protected $table = 'company_reviews';
    protected $fillable = [
        'value',
        'comment',
        'user_id',
        'company_id'
        
    ];

}
