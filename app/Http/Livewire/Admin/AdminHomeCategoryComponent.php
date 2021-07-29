<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    // public $product_id, $category_id;
    public $sel_categories =[], $no_of_products;
    public function render()
    {
        return view('livewire.admin.admin-home-category-component');
    }
}
