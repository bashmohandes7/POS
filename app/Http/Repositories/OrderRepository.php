<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\OrderInterface;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class OrderRepository implements OrderInterface

{
    public function create($client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact('client', 'categories', 'orders'));
    }

    public function store($request, $client)
    {
        $this->attach_order($request, $client);
        session()->flash('success', __('site.added_successfully'));
        return to_route('dashboard.orders.index');
    } // end of store

    public function edit($client, $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.edit', compact('client', 'order', 'categories', 'orders'));
    }

    public function update($request, $client, $order)
    {
        $this->detach_order($order);
        $this->attach_order($request, $client);

        session()->flash('success', __('site.updated_successfully'));

        return to_route('dashboard.orders.index');
    }

    public function destroy($client, $order)
    {
        // TODO: Implement destroy() method.
    }

    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);
        $total_price = 0;
        foreach ($request->products as $id => $quantity){
            $product = Product::findOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];


            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);

        } // end of foreach
        $order->update([
            'total_price' => $total_price
        ]);
    } // end of attach order

    private function detach_order($order)
    {
        foreach ($order->products as $product)
        {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);

        } // end of foreach

        $order->delete();
    }
} // end of class
