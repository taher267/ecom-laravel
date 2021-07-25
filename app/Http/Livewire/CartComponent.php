<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
class CartComponent extends Component
{
    public function increseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty       = $product->qty +1;
        Cart::update($rowId, $qty);
    }

    public function decreseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        if ($product->qty > 1) {
            $qty       = $product->qty -1;
            Cart::update($rowId, $qty);
        }
    }

    public function removeToCart($rowId)
    {
        // $product = Cart::get($rowId);
        // $qty       = 0;
        // Cart::update($rowId, $qty);
        Cart::remove($rowId);
        session()->flash('success_msg', 'Product has been deleted');
    }
    public function removeAllCart()
    {
        Cart::destroy();
        session()->flash('success_msg', 'All products have been deleted');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
