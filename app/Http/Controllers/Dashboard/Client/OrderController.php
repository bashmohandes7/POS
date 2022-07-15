<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderInterface;
use App\Http\Requests\Dashboard\OrderRequest;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    } // end of construct

    public function create(Client $client)
    {
        return $this->orderInterface->create($client);
    } // end of create

    public function store(OrderRequest $request, Client $client)
    {
        return $this->orderInterface->store($request, $client);
    } // end of store

    public function edit(Client $client, Order $order)
    {
        return $this->orderInterface->edit($client, $order);
    } // end of edit

    public function update(OrderRequest $request, Client $client, Order $order)
    {
        return $this->orderInterface->update($request,$client, $order );
    } // end of update



} // end of class
