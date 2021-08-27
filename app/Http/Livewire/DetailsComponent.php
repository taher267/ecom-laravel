<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use Livewire\Component;
use App\Models\Product;
use App\Models\Review;
use Cart;
use Illuminate\Support\Facades\Auth;

class DetailsComponent extends Component
{
    use ProductCart;
    public $slug, $qty, $product_id, $rating, $comment;

    public function mount($slug){
        $this->slug = $slug;
        $this->qty  = 1;
    }

    public function increaseQry()
    {
        $this->qty++;
    }

    public function decreaseQty()
    {
        if ($this->qty > 1 ) {
            $this->qty--;
        }
    }

    public function store($priduct_id, $product_name, $product_price){
        Cart::instance('cart')->add($priduct_id, $product_name, $this->qty, $product_price)->associate('App\Models\Product');
        session()->flash('success_msg', 'Item has been added in Cart!');
        return redirect()->route('product.cart');
    }
    /**
     * Remove this product from Cart
     * @return $rowId
     */
    public function removeToCart($rowId)
    {
        $this->removeProductFromCart($rowId);
    }

    /**
     * Remove this product from Cart
     * @return $rowId
     */
    public function addToWishlist($product_id, $product_name, $product_price)
    {
        $this->addProductInWishlist($product_id, $product_name, $product_price);
    }
    public function updated($fields)
    {
        $this->validateOnly( $fields, [
            'rating' => 'required',
            'comment' => 'required',
        ]);
    }
     /**Customer Review */
     public function addReview(int $order_item_id)
     {
        $this->validate([
            'rating' => 'required',
            'comment' => 'required',
        ]);
        $orderItem = OrderItem::findOrFail($order_item_id);
        if ($orderItem) {
            $review                 = new Review();
            $review->rating         = $this->rating;
            $review->comment        = $this->comment;
            $review->order_item_id  = $order_item_id;
            $review->save();

            $orderItem->rstatus = true;
            $orderItem->save();

            session()->flash('msg', 'Review has been added, successfully!');
        }else{
            session()->flash('msg', 'Your Account can be suspend!');
        }
     }

    public function render()
    {
        $is_order_item_added = OrderItem::all();
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
       $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();
    //    $added_cart = Cart::instance('cart')->content
    //    dd($related_products);
        return view('livewire.details-component', compact('product', 'popular_products', 'related_products', 'is_order_item_added'))->layout('layouts.base');
    }


}
