<?php
namespace App\Http\Livewire;

use Livewire\Component;
// use App\Models\Product;
use Cart;

trait ProductCart {
    /**
     * Add product in for all instance
     * @return int product id
     * @return int number of product
     * @return string name of product
     */
    public function addProductInAllInstance($product_id, $product_name, $product_price, $instanceIn)//
    {
        if ($instanceIn) {
            Cart::instance($instanceIn)->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
            $this->emitTo('wishlist-count-component', 'refreshComponent');
            $this->emitTo('cart-count-component', 'refreshComponent');
        }
        else {
            dd('Something went Wrong!');
        }

    }
     /**
     * Remove Cart Product of Save for later
     * @param  string  $rowId
     * @param  string  $instanceIn
     */

    public function removeProductCart($rowId, $instanceIn)
    {
        if ($instanceIn != null ) {
            Cart::instance($instanceIn)->remove($rowId);
            $this->emitTo('cart-count-component', 'refreshComponent');
            session()->flash('success_msg', 'Product has been deleted form '. $instanceIn);
        }
    }

    /**
     * Remove Wishlist of Product
     */
    public function removeProductFromWishlist($product_id){

        foreach(Cart::instance('wishlist')->content() as $witem){
            if ($product_id == $witem->id) {
                Cart::instance('wishlist')->remove($witem->rowId);
            }
        }
        $this->emitTo('wishlist-count-component', 'refreshComponent');
    }

    public function removeProductFromCart($rowId){
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    /**
     * Add product in Wishlist
     * @return int product id
     * @return int number of product
     * @return string name of product
     */
    public function addProductInWishlist( $product_id, $product_name, $product_price )
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component', 'refreshComponent');

    }



    /**
     * Product move form wishlist to Cart
     */
    public function moveProductWishlistToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);
        // dd($item);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component', 'refreshComponent');
        $this->emitTo('cart-count-component', 'refreshComponent');
    }
    /**
     * Product Switch Save for later
     * $rowId string
     * $instance Cart:: instace
     */
    public function switchProductCart($rowId, $instanceIn = null, $instanceTo=null)
    {
        $item = Cart::instance($instanceIn)->get($rowId);
        // dd($item);
        Cart::instance($instanceIn)->remove($rowId);
        Cart::instance($instanceTo)->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component', 'refreshComponent');
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    /**
     * Product move form Cart to Wishlist
     */
    public function moveProductCartToWishlist($rowId, $product_id, $product_name, $product_price, $instanceIn, $instanceTo)
    {
        foreach(Cart::instance('cart')->content() as $item){
            if ($item->rowId == $rowId) {
                Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
            }
        }
        Cart::instance('cart')->remove($rowId);

        $this->emitTo('cart-count-component', 'refreshComponent');
        $this->emitTo('wishlist-count-component', 'refreshComponent');

    }

}
