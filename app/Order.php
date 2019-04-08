<?php

namespace App;

use App\Traits\ModelValidateMethods;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use ModelValidateMethods;
    public $success_message = 'Спасибо за заказ';

    protected $fillable = [
        'client_id',
        'rate_id',
        'day_id',
        'address',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function rules()
    {
        $days_ids = Rate::find(request('rate_id'))->days_ids();

        $rules = [
            'client_id' => 'required|integer',
            'rate_id' => 'required|integer',
            'day_id' => 'required|in:'.$days_ids->implode(','),
            'address' => 'required|string',
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

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function rate()
    {
        return $this->belongsTo('App\Rate');
    }

    public function day()
    {
        return $this->belongsTo('App\Day');
    }
}
