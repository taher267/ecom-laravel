<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
class CartComponent extends Component
{
    use ProductCart;
    public function increseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty       = $product->qty +1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function decreseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        if ($product->qty > 1) {
            $qty       = $product->qty -1;
            Cart::instance('cart')->update($rowId, $qty);
            $this->emitTo('cart-count-component', 'refreshComponent');
        }
    }

    public function removeToCart($rowId, $instanceIn)
    {
        $this->removeProductCart($rowId,  $instanceIn);
    }
    public function removeAllCart()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success_msg', 'All products have been deleted');
    }
     /**
   * Move Product Cart to Wishlist
   */
  public function moveCartToWishlist($rowId, $product_id, $product_name, $product_price, $instanceIn, $instanceTo )
  {
      $this->moveProductCartToWishlist($rowId, $product_id, $product_name, $product_price, $instanceTo, $instanceTo);

  }

  /**
   * Save For later of Cart added Product
   */
   public function switchProduct($rowId,$instanceIn, $instanceTo)
   {
       $this->switchProductCart($rowId, $instanceIn, $instanceTo );
   }
    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
