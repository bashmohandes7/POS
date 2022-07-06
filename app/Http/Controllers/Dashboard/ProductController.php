<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ProductInterface;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productInterface;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    } // end of construct

    public function index(Request $request)
    {
        return $this->productInterface->index($request);
    } // end of index

    public function create()
    {
        return $this->productInterface->create();
    } // end of create
    public function store( ProductRequest $request)
    {
        return $this->productInterface->store($request);
    } // end of store

    public function edit(Product $product)
    {
        return $this->productInterface->edit($product);
    } // end of edit

    public function update(ProductRequest $request, Product $product)
    {
        return $this->productInterface->update($request, $product);
    }  // end of update
    public function destroy(Product $product)
    {
        return $this->productInterface->destroy($product);
    } // end of delete

} // end of class
