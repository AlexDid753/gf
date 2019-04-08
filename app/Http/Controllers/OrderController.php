<?php

namespace App\Http\Controllers;


use App\Day;
use App\Order;
use App\Client;
use App\Rate;
use Illuminate\Http\Request;

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
        $clientResponse = $client->validate($data);
        if ($clientResponse->getStatusCode() != 200)
            return $clientResponse;

        $day = Day::where(['number' => request('day_number')])->firstOrFail();
        $data['day_id'] = $day->id;
        $data['client_id'] = $client->id;

        return $model->validate($data);
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
