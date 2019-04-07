<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    public function days()
    {
        return $this->belongsToMany('App\Day');
    }
}
