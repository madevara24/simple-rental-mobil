<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'no_ktp',
        'plat_nomor',
        'mulai_rental',
        'selesai_rental',
      ];

    public function car(){
        return $this->belongsTo('App\Car');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
