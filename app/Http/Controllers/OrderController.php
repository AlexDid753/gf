<?php

namespace App\Http\Controllers;


use App\Day;
use App\Order;
use App\Client;
use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $model = new Order();
        $client = Client::firstOrNew(
            ['phone' => request('phone')],
            ['name' => request('name')]
        );
        $client->name = request('name');
        $client->save();

        $day = Day::where(['number' => request('day_number')])->firstOrFail();

        $data['day_id'] = $day->id;
        $data['client_id'] = $client->id;

        $validator = Validator::make($data, $model->rules());

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error)
                $errors[$error] = $error;

            $info =  implode('</br>', $errors);
            return response($info)->setStatusCode(400);
        } else {
            $model->fill($data);
            if ($model->save())
                return response('Спасибо за заказ')->setStatusCode(200);
        }
        return response('Ошибка')->setStatusCode(500);
    }

    public function create()
    {
        $rates = Rate::with('days')
            ->orderBy('name')
            ->get();

        $days = Day::all();

        return view('order.create',
            [
                'rates' =>  $rates,
                'days' => $days
            ]);
    }
}
