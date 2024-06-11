<?php

namespace App\Models;

use App\Models\Companies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function user(){
        return $this->belongsTo(User::class);

    }
    public function company(){
        return $this->belongsTo(Companies::class);

    }

}
