<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\Product;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $selected_categories =[];
    public $numberofproducts;
    public function mount()
    {
        $category                   = HomeCategory::find(1);
        $this->selected_categories  = explode(',', $category->sel_categories);
        $this->numberofproducts     = $category->no_of_products;
    }

    public function updateHomeCategory()
    {
        // $this->validate([
        //     'sel_categories'    => 'required',
        //     'no_of_products'    => 'required|numeric',
        // ]);
        $category   = HomeCategory::find(1);
        $category->sel_categories = implode(',', $this->selected_categories);
        $category->no_of_products = $this->numberofproducts;
        $category->save();
        session()->flash('msg', 'HomeCaregory has been updated successfully');
    }
    public function render()
    {
        $categories  = Category::all();
        return view('livewire.admin.admin-home-category-component', compact('categories'))->layout('layouts.base');
    }
}
