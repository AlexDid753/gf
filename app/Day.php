<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = [
        'number'
    ];

    public function rates()
    {
        return $this->belongsToMany('App\Rate');
    }
}
