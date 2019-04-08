<?php

namespace App;

use App\Traits\ModelValidateMethods;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Client extends Model
{
    use ModelValidateMethods;
    public $success_message = '';

    protected $fillable = [
        'name',
        'phone',
    ];

    public function rules()
    {
        $rules = [
            'name' => 'required|string',
            'phone' => 'required|max:255',
        ];

        switch (request()->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return $rules;
            default:
                return $rules;
        }
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
