<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Carbon\Carbon;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $have_coupon_code, $coupon_code, $subtotalAfterDiscount, $taxAfterDiscount, $totalAfterDiscount;
    public $discount;// = session()->get('coupon');

    use ProductCart;

    /**
     * Increase Cart Quantiry
     */
    public function increseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        // dd($product->model->quantity);
        if ($product->qty < $product->model->quantity) {
            $qty       = $product->qty +1;
            Cart::instance('cart')->update($rowId, $qty);
            $this->emitTo('cart-count-component', 'refreshComponent');
        }

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
   /**
    * Apply copone code
    */

    /**
     * Apply coupon code in Cart
     */
    public function applyCouponCode()
    {
        $coupon = Coupon::where('code', $this->coupon_code)->where('expiry_date', '>=', Carbon::today() )->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first();
        // dd($coupon);
        if (! $coupon) {
            session()->flash('coupon_msg', 'Coupon code is invalid!');
            return;
        }else {
            session()->put( 'coupon', [
                'code'          => $coupon->code,
                'type'          => $coupon->type,
                'value'         => $coupon->value,
                'cart_value'    => $coupon->cart_value,
            ]);
        }
    }

    /**
     * Discount Calculate
     */
    public function calculateDiscounts()
    {
        if ( session()->has('coupon') ) {
        $this->discount= session()->get('coupon');
        }
        if ( session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount     = session()->get('coupon')['value'];
            }else {
                $this->discount     = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value'])/100;
            }
            $this->subtotalAfterDiscount    = Cart::instance('cart')->subtotal()- $this->discount;
            $this->taxAfterDiscount         = $this->subtotalAfterDiscount * config('cart.tax')/100;
            $this->totalAfterDiscount       = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }
    /**
     * Delete coupon
     */
    public function deleteCoupon()
    {
        if (session()->has('coupon')) {
            session()->forget('coupon');
        }
    }

    /**
     * Auth Check
     */
    public function checkout()
    {
        if ( Auth::check() ) {
            return redirect()->route('checkout');
        }else {
            return redirect()->route('login');
        }
    }

    /**
     * Session Set for checkout
     */
    public function setAmountForCheckout()
    {
        if (! Cart::instance('cart')->count() > 0) {
            session()->forget('checkout');
            if (session()->has('coupon')) {
                session()->forget('coupon');
            }
            return;
        }
        if ( session()->has('coupon') ) {
            session()->put('checkout', [
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount
            ]);
        }else{
            session()->put('checkout', [
                'discount'  => 0,
                'subtotal'  => Cart::instance('cart')->subtotal(),
                'tax'       => Cart::instance('cart')->tax(),
                'total'     => Cart::instance('cart')->total(),
            ]);
        }
    }

    public function render()
    {
        if (session()->has('coupon')) {
            if ( Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value']   ) {
                session()->forget('coupon');
            }else{
                $this->calculateDiscounts();
            }
        }

        $this->setAmountForCheckout();

        return view('livewire.cart-component')->layout('layouts.base');
    }
}
