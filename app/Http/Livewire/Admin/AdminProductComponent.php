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
            //Delete Image of Phone
            if ( Storage::disk('local')->exists('products/' . $product->image ) ) {
                unlink('assets/images/products/'. $product->image);

            }
            if ($product->images) {
                if ( Storage::disk('local')->exists( "products/$product->slug" ) ) {
                       Storage::disk('local')->deleteDirectory( "products/$product->slug" );
                }

            }
            $product->pro_categories()->detach();
            /**
             * Exists Product gallery, delete it
             */
            // if ($product->images) {
            //     if ( Storage::disk('local')->exists("products/$product->slug" ) ) {
            //             Storage::disk('local')->delete("products/$product->slug" );


            //      }
            // }

            session()->flash('msg', 'Product has been deleted!');
        }

    }
    use WithPagination;
    public function render()
    {
        $products = Product::orderBy('id', "DESC")->paginate(5);
        return view('livewire.admin.admin-product-component', compact('products'))->layout('layouts.dashboard');
    }
}
