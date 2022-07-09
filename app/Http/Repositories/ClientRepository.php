<?php

namespace App\Http\Repositories;

use App\Models\Client;
use App\Http\Interfaces\ClientInterface;

class ClientRepository implements ClientInterface
{
    public function index($request)
    {
        $clients = Client::whenSearch($request->search)->latest()->paginate(5);
        return view('dashboard.clients.index', compact('clients'));
    } // end of index

    public function create()
    {
        return view('dashboard.clients.create');
    } // end of create

    public function store($request)
    {
        $client_data = $request->all();
        $client_data['phone'] = array_filter($request->phone);
        Client::create($client_data);

        session()->flash('success', __('site.added_successfully'));

        return to_route('dashboard.clients.index');

    } // end of store

    public function edit($client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }  // end of edit

    public function update($request, $client)
    {
        $client_data = $request->all();
        $client_data['phone'] = array_filter($request->phone);
        $client->update($client_data);

        session()->flash('success', __('site.added_successfully'));

        return to_route('dashboard.clients.index');
    } // end of update

    public function destroy($client)
    {
        $client->delete();
        session()->flash('success', __('site.deleted_successfully'));

        return to_route('dashboard.clients.index');

    } // end of destroy
} // end of class ClientRepository
