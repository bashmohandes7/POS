<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\OrderInterface;
use App\Models\Category;
use App\Models\Order;

class OrderRepository implements OrderInterface

{
    public function index($request)
    {
        $orders = Order::all();
        return view('dashboard.orders.index', compact('orders'));
    }

    public function create($client)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create', compact('client', 'categories'));
    }

    public function store($request, $client, $order)
    {
        // TODO: Implement store() method.
    }

    public function edit($client, $order)
    {
        // TODO: Implement edit() method.
    }

    public function update($request, $client, $order)
    {
        // TODO: Implement update() method.
    }

    public function destroy($client, $order)
    {
        // TODO: Implement destroy() method.
    }
} // end of class
