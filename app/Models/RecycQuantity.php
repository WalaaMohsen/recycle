<?php

namespace App\Models;

use App\Models\User;
use App\Models\Recycle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecycQuantity extends Model
{
    use HasFactory;
    protected $table = 'recycquantity';
    protected $fillable = [
        'weight',
        'user_id',
        'recycle_id',
        'points',
        'remember_token',

    ];
    public function user(){
        return $this->belongsTo(User::class);

    }
    public function recycle(){
        return $this->belongsTo(Recycle::class);

    }


}
