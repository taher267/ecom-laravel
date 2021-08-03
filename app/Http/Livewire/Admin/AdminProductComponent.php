<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class AdminProductComponent extends Component
{
    public function deleteproduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->delete()) {
            $product->pro_categories()->detach();
            //Delete Image of Phone
            if ( Storage::disk('local')->exists('products/' . $product->image ) ) {
                Storage::disk('local')->delete('products/'. $product->image);

            }
            session()->flash('msg', 'Product has been deleted!');
        }

    }
    use WithPagination;
    public function render()
    {
        $products = Product::orderBy('id', "DESC")->paginate(5);
        return view('livewire.admin.admin-product-component', compact('products'))->layout('layouts.base');
    }
}
