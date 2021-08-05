<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;
use App\Models\Suspicious;
use Illuminate\Support\Facades\Auth;

class ShopComponent extends Component
{
    public $sorting, $productperpage, $min_price, $max_price, $price_range, $min_value, $max_value, $url;
    use WithPagination;
    use ProductCart;

    public function mount()
    {
        $this->sorting          = 'default';
        $this->productperpage   = 12;
        $this->min_price        = 1;
        $this->max_price        = 1000;
        $this->price_range      = 80;
        $this->url              = $this->url;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'min_price' => 'required|numeric|min:1',
            'max_price' => 'required|numeric|gt:min_price',
        ]);
    }
    /**
     * Product Add to Cart or Wishlist
     */
    public function AddtoCartOrWishlist( int $product_id =null, string $product_name =null, int $product_price =null, string $instanceIn=null ){
        if(Product::find($product_id) ):
            if (! $product_id || !$product_name || $product_price || $instanceIn) {
                $this->addProductInAllInstance( $product_id, $product_name, $product_price, $instanceIn);
                return redirect()->route('product.cart');
            }else {
                dd('Something Went Wrong!');
            }
        else:
                $suspicious_user = new Suspicious;
                $suspicious_user->user_id = Auth::user() ? Auth::user()->id :0;
                $suspicious_user->url = 'shop';
                // dd($suspicious_user);
                if ($suspicious_user->save()) {
                    session()->flash('msg', 'Your information has been enlisted!');
                }
        endif;

    }

    /**
     * Remove Wishlist
     */
    public function removeFromWishlist(int $product_id){
        $this->removeProductFromWishlist($product_id);
    }
/**
 * Remove from Cart
 */
    public function removeToCart($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function render()
    {

        $categories = Category::all();

        if ($this->sorting =='date') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'DESC')->paginate($this->productperpage);
        }else if ($this->sorting =='price') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'ASC')->paginate($this->productperpage);
        }else if ($this->sorting =='price-desc') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'DESC')->paginate($this->productperpage);
        }else{
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->paginate($this->productperpage);
        }

        return view('livewire.shop-component', compact('products', 'categories'))->layout('layouts.base');
    }
}
