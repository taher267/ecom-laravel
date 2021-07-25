<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;


class AdminCategoryComponent extends Component
{
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        session()->flash('msg', 'Category has been deleted!');
    }
    use WithPagination;
    public function render()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(5);

        return view('livewire.admin.admin-category-component', compact('categories'))->layout('layouts.base');
    }
}
