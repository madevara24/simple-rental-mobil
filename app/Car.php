<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'plat_nomor',
        'tipe',
    ];
    
    public function rental(){
        return $this->hasMany('App\Rental');
    }
}
