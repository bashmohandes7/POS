<?php
namespace App\Http\Interfaces;

interface OrderInterface
{
    public function create($client);
    public function store($request, $client);
    public function edit($client, $order);
    public function update($request,$client, $order);
    public function destroy($client, $order);
}
