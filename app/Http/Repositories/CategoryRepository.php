<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{

    public function index($request)
    {
        $categories = Category::whenSearch($request->search)->latest()->paginate(5);
        return view('dashboard.categories.index', compact('categories'));
    } // end of index

    public function create()
    {
        return view('dashboard.categories.create');
    } // end of create

    public function store($request)
    {
        Category::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return to_route('dashboard.categories.index');
    }// end of store

    public function edit($category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }// end of edit


    public function update($request, $category)
    {
        $category->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return to_route('dashboard.categories.index');

    }// end of update
    public function destroy($category)
    {

        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return to_route('dashboard.categories.index');
    }// end of delete

}
