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

    public function days_numbers()
    {
        return $this->days->sortBy('number')->pluck('number');
    }
}
