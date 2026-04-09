<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

class Country extends Model
{
    protected $fillable = ['name'];
    
    public function state()
    {
        return $this->hasMany(State::class);
    }
}
