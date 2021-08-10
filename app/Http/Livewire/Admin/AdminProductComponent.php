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
        if ($product->images) {
            if ( Storage::disk('local')->exists( "products/$product->slug" ) ) {
                    // Storage::disk('local')->delete("products/$product->slug" );
                   Storage::disk('local')->deleteDirectory( "products/$product->slug" );
            }
        }

        if ($product->delete()) {
            $product->pro_categories()->detach();
            //Delete Image of Phone
            if ( Storage::disk('local')->exists('products/' . $product->image ) ) {
                Storage::disk('local')->delete('products/'. $product->image);

            }

            /**
             * Exists Product gallery, delete it
             */
            if ($product->images) {
                if ( Storage::disk('local')->exists("products/$product->slug" ) ) {
                        Storage::disk('local')->delete("products/$product->slug" );


                    }
            //     foreach(  explode(',' , str_replace(' ', '', $product->images)) as $pro_gallery):
            //         if ( Storage::disk('local')->exists("products/$product->slug/$pro_gallery" ) ) {
            //             Storage::disk('local')->delete("products/$product->slug/$pro_gallery" );
            //             // dd('yes');

            //         }
            // endforeach;
            // dd($del_img);
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
