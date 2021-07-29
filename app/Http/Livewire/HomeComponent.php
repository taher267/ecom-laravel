<?php

namespace App\Http\Livewire;

use App\Models\HomeSlider;
use App\Models\Product;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $slider = HomeSlider::where('status', 1)->get();
        $latest_product = Product::orderBy('created_at', 'DESC')->get()->take(8);
        return view('livewire.home-component', compact('slider', 'latest_product'))->layout('layouts.base');
    }
}
