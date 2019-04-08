<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'rate_id',
        'day_id',
        'address',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function rules()
    {
        $rules = [
            'client_id' => 'required|integer',
            'rate_id' => 'required|integer',
            'day_id' => 'required|min:1|max:30',
            'address' => 'required|string',
        ];

        switch (request()->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
//                        'game_id' => 'required|integer|exists:games,id',
//                        'title' => [
//                            'required',
//                            Rule::unique('games')->ignore(request()->title, 'title') //должен быть уникальным, за исключением себя же
//                        ]
                    ] + $rules; // и берем все остальные правила
            // case 'PATCH':
//            case 'DELETE':
//                return [
//                    'game_id' => 'required|integer|exists:games,id'
//                ];
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
