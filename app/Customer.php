<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'no_ktp',
        'nama',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    public function rental(){
        return $this->hasMany('App\Rental');
    }
}
