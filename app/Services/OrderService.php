<?php

namespace App\Services;

use App\Events\OrderCreated;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;

class OrderService  {

    public function store($data): Order
    {

        $order = Order::create($data);

        event(new OrderCreated($order));
        return $order;

    }

    public function getAll(int $userId) :Collection
    {
        return Order::orderBy('created_at', 'desc')->where('user_id' , $userId)->get();
    }

    public function getById(int $orderId) : Order
    {
        return Order::findOrFail($orderId);
    }



}
