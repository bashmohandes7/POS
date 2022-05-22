<?php
namespace App\Http\Interfaces;

interface CategoryInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function edit($category);
    public function update($request,$category);
    public function destroy($category);
}
