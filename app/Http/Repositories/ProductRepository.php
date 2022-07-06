<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductRepository implements ProductInterface
{

    /**
     *  search by product name, category filter
    */
    public function index($request)
    {
        $products = Product::whenSearch($request->search)
        ->filter($request->category_id)
        ->latest()->paginate(5);
        $categories = Category::all();
        return view('dashboard.products.index', compact('products', 'categories'));
    } // end of index

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    } // end of create

    public function store($request)
    {
        $request_data = $request->all();

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if

        Product::create($request_data);

        session()->flash('success', __('site.added_successfully'));

        return to_route('dashboard.products.index');

    } // end of store

    public function edit($product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }// end of edit


    public function update($request, $product)
    {
        $request_data = $request->all();
        if ($request->image) {

            if ($product->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);

            }//end of inner if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of external if

        $product->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return to_route('dashboard.products.index');

    }// end of update
    public function destroy($product)
    {

        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return to_route('dashboard.products.index');
    }// end of delete
}
