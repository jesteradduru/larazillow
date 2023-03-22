<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Listing extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price' ];

    public function owner() : HasOne
    {
        return $this->hasOne(User::class, 'by_user_id');
    }
}