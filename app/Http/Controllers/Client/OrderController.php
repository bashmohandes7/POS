<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderInterface;
use App\Models\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    } // end of construct

    public function index(Request $request)
    {
        return $this->orderInterface->index($request);
    } // end of index

    public function create(Client $client)
    {
        return $this->orderInterface->create($client);
    } // end of create


} // end of class
