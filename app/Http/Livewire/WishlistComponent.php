<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class WishlistComponent extends Component
{
    use ProductCart;
  public function removeFromWishlist($product_id)
  {
    $this->removeProductFromWishlist($product_id);
  }

  /**
   * Move Product wishlist to cart
   */
  public function moveWishlistToCart($rowId)
  {
      $this->moveProductWishlistToCart($rowId);

  }

    public function render()
    {
        return view('livewire.wishlist-component')->layout('layouts.base');
    }
}
