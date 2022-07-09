<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\ClientInterface;
use App\Http\Requests\Dashboard\ClientRequest;

class ClientController extends Controller
{
    public $clientInterface;
    public function __construct(ClientInterface $clientInterface)
    {
        $this->clientInterface = $clientInterface;
    } // end of construct

    public function index(Request $request)
    {
        return $this->clientInterface->index($request);

    }// end of index

    public function create()
    {
        return $this->clientInterface->create();

    } // end of create

    public function store(ClientRequest $request)
    {
        return $this->clientInterface->store($request);
    } // end of store

    public function edit(Client $client)
    {
        return $this->clientInterface->edit($client);

    } // end of edit

    public  function update(ClientRequest $request, Client $client)
    {
        return $this->clientInterface->update($request, $client);
    } // end of update

    public function destroy(Client $client)
    {
        return $this->clientInterface->destroy($client);
    } // end of destroy
} // end of class
