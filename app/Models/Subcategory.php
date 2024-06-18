<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'subcategories';
    protected $fillable = [
        'name',
        'status',
        'image',
        'subcategory_id',
    ];
    public function category(){
        return $this->belongsTo(Category::class , 'subcategory_id' , 'id');

    }
    protected $hidden = [
        'remember_token',
    ];
}
