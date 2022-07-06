<?php

namespace App\Http\Interfaces;

interface ProductInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function edit($product);
    public function update($request,$product);
    public function destroy($product);
}
