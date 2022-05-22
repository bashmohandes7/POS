<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    } // end of construct

    public function index(Request $request)
    {
        return $this->categoryInterface->index($request);
    } // end of index
    public function create()
    {
        return $this->categoryInterface->create();
    } // end of create
    public function store(CategoryRequest $request)
    {
        return $this->categoryInterface->store($request);
    } // end of store
    public function edit(Category $category)
    {
        return $this->categoryInterface->edit($category);
    } // end of edit
    public function update(CategoryRequest $request, Category $category)
    {
        return $this->categoryInterface->update($request, $category);
    } // end of update
    public function destroy(Category $category)
    {
        return $this->categoryInterface->destroy($category);
    }// end of destroy
}
