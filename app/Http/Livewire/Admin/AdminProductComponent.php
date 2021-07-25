<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    public function productDelete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        session()->flash('msg', 'Product has been deleted!');
    }
    use WithPagination;
    public function render()
    {
        $products = Product::orderBy('id', "DESC")->paginate(5);
        return view('livewire.admin.admin-product-component', compact('products'))->layout('layouts.base');
    }
}
