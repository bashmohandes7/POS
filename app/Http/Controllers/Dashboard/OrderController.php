<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::whenSearch($request->search)->paginate(5);

        return view('dashboard.orders.index', compact('orders'));

    } // end of index

    public function products(Order $order)
    {
        $products = $order->products;
        return view('dashboard.orders._products', compact('products', 'order'));
    }// end of products

    public function destroy(Order $order)
    {
        foreach ($order->products as $product)
        {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);

        } // end of foreach

        $order->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return to_route('dashboard.orders.index');

    } // end of destroy
}
