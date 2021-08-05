<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\OnSale;
use App\Models\Product;
use Livewire\Component;


class HomeComponent extends Component
{
    public function render()
    {
        $slider             = HomeSlider::where('status', 1)->get();
        $latest_product     = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $c_products         = Product::all();
        $s_products         = Product::where('sale_price', '>', 0)->inRandomOrder()->get()->take(8);
        $category           = HomeCategory::find(1);
        $cats               = explode(',', $category->sel_categories);
        $categories         = Category::whereIn('id', $cats)->get();
        $no_of_products     = $category->no_of_products;
        $onsale             = OnSale::find(1);
        return view('livewire.home-component', compact('slider', 'latest_product', 'categories', 'c_products','s_products','no_of_products', 'onsale'))->layout('layouts.base');
    }
}
