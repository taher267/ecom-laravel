<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Faker\Extension\Extension;

class CheckoutComponent extends Component
{
    public  $ship_to_different, $thankyou;

    /**Building address Propertis */
    public $user_id, $subtotal, $discount, $tax, $total, $first_name, $last_name, $email, $mobile, $line1, $line2, $city, $province, $country, $zipcode,
    $status, $is_shipping_different, $paymentmethod;

    /**Shipping address Propertis */
    public $s_first_name, $s_last_name, $s_email, $s_mobile, $s_line1, $s_line2, $s_city, $s_province, $s_country, $s_zipcode;

    public $price, $quantity;
    public $order_id;
    public $mode, $transaction_status, $card_no, $expiry_month, $expiry_year, $cvc;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'first_name'    => 'required|regex:/^[A-Za-z. ]+$/u',
            'last_name'     => 'required|regex:/^[A-Za-z ]+$/u',
            'email'         => 'required|email',
            'mobile'        => 'required|numeric|digits_between:11,14',
            'line1'         => 'required',
            'line2'         => 'nullable',
            'city'          => 'required',
            'province'      => 'required',
            'country'       => 'required',
            'zipcode'       => 'required|numeric',
            'paymentmethod' => 'required',
        ]);
        if ($this->ship_to_different) {
            $this->validateOnly($fields, [
                's_first_name'    => 'required|regex:/^[A-Za-z. ]+$/u',
                's_last_name'     => 'required|regex:/^[A-Za-z ]+$/u',
                's_email'         => 'required|email',
                's_mobile'        => 'required|numeric|digits_between:11,14',
                's_line1'         => 'required',
                's_line2'         => 'nullable',
                's_city'          => 'required',
                's_province'      => 'required',
                's_country'       => 'required',
                's_zipcode'       => 'required|numeric',

            ]);
        }if ($this->paymentmethod=='card') {
            $this->validateOnly($fields, [
                'card_no'    => 'required|numeric',
                'expiry_month'     => 'required|numeric',
                'expiry_year'     => 'required|numeric',
                'cvc'         => 'required|numeric',
            ]);
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'first_name'    => 'required|regex:/^[A-Za-z. ]/',
            'last_name'     => 'required|regex:/^[A-Za-z ]+$/u',
            'email'         => 'required|email',
            'mobile'        => 'required|numeric|digits_between:11,14',
            'line1'         => 'required',
            'line2'         => 'nullable',
            'city'          => 'required',
            'province'      => 'required',
            'country'       => 'required',
            'zipcode'       => 'required|numeric',
            'paymentmethod'   => 'required',
        ]);

        if ( $this->ship_to_different ) {
            $this->validate([
                's_first_name'    => 'required|regex:/^[A-Za-z. ]+$/u',
                's_last_name'     => 'required|regex:/^[A-Za-z ]+$/u',
                's_email'         => 'required|email',
                's_mobile'        => 'required|numeric|digits_between:11,14',
                's_line1'         => 'required',
                's_line2'         => 'nullable',
                's_city'          => 'required',
                's_province'      => 'required',
                's_country'       => 'required',
                's_zipcode'       => 'required|numeric',
            ]);
        }if ($this->paymentmethod=='card') {
            $this->validate([
                'card_no'           => 'required|numeric',
                'expiry_month'      => 'required|numeric',
                'expiry_year'       => 'required|numeric',
                'cvc'               => 'required|numeric',
            ]);

        }

        $order = new Order();
        $order->user_id                 = Auth::user()->id;
        $order->subtotal                = session()->get('checkout')['subtotal'];
        $order->discount                = session()->get('checkout')['discount'];
        $order->tax                     = session()->get('checkout')['tax'];
        $order->total                   = session()->get('checkout')['total'];
        $order->first_name              = $this->first_name;
        $order->last_name               = $this->last_name;
        $order->email                   = $this->email;
        $order->mobile                  = $this->mobile;
        $order->line1                   = $this->line1;
        $order->line2                   = $this->line2;
        $order->city                    = $this->city;
        $order->province                = $this->province;
        $order->country                 = $this->country;
        $order->zipcode                 = $this->zipcode;
        $order->status                  = 'ordered';
        $order->is_shipping_different   = $this->ship_to_different ? 1 : 0;
        $order->save();

        foreach (Cart::instance('cart')->content() as $item) {
            $orderItem                  = new OrderItem();
            $orderItem->product_id       = $item->id;
            $orderItem->order_id         = $order->id;
            $orderItem->price            = $item->price;
            $orderItem->quantity         = $item->qty;
            $orderItem->save();

        }
        if ( $this->ship_to_different) {
            $shipping                   = new Shipping();
            $shipping->order_id         = $order->id;
            $shipping->first_name       = $this->s_first_name;
            $shipping->last_name        = $this->s_last_name;
            $shipping->email            = $this->s_email;
            $shipping->mobile           = $this->s_mobile;
            $shipping->line1            = $this->s_line1;
            $shipping->line2            = $this->s_line2;
            $shipping->city             = $this->s_city;
            $shipping->province         = $this->s_province;
            $shipping->country          = $this->s_country;
            $shipping->zipcode          = $this->s_zipcode;
            $shipping->save();
        }

        if ( $this->paymentmethod =='cod' ) {
            $this->makeTransaction($order->id, 'pending');
            $this->resetCart();

        }else if( $this->paymentmethod =='card' ){
            $stripe = Stripe::make(env('STRIPE_KEY'));
            try{
             $token = $stripe->tokens()->create([
                 'card' =>[
                     'number'       => $this->card_no,
                     'exp_month'    => $this->expiry_month,
                     'exp_year'     => $this->expiry_year,
                     'cvc'          => $this->cvc
                 ]
             ]);
             if ( ! isset( $token['id'] ) ) {
                session()->flash('stripe_error', 'The stripe token has not generated correctly');
                $this->thankyou = 0;
             }
             $customer = $stripe->customers()->create([
                 'name'     => $this->first_name. ' '. $this->last_name,
                 'email'    => $this->email,
                 'phone'    => $this->mobile,
                 'address'  => [
                     'line1'        => $this->line1,
                     'postal_code'  => $this->zipcode,
                     'city'         => $this->city,
                     'state'        => $this->province,
                     'country'      => $this->country,
                    ],
                 'shipping' =>[
                    'name'     => $this->first_name. ' '. $this->last_name,
                    'address'  => [
                        'line1'         => $this->line1,
                        'postal_code'   => $this->zipcode,
                        'city'          => $this->city,
                        'state'         => $this->province,
                        'country'       => $this->country,
                        ],
                 ],
                 'source' => $token['id'],
             ]);
             $charge = $stripe->charges()->create([
                 'customer' => $customer['id'],
                 'currency' => 'USD',
                 'amount'   => session()->get('checkout')['total'],
                 'description'  => 'Payment for order no: '. $order->id,
             ]);
             if ( $charge['status'] == 'succeeded' ) {
                 $this->makeTransaction( $order->id, 'approved');
                 $this->resetCart();
             }else {
                session()->flash('stripe_error', 'Error in Transaction!');
                $this->thankyou = 0;
             }
            }//try
            catch (Exception $e) {
                session()->flash('stripe_error', $e->getMessage());
                $this->thankyou = 0;
                }
        }




    }
    public function makeTransaction( int $order_id, string $status)
    {
        $transaction                = new Transaction();
            $transaction->user_id       = Auth::user()->id;
            $transaction->order_id      = $order_id;
            $transaction->mode          = 'cod';
            $transaction->status        = $status;
            $transaction->save();
    }
    /**
     * Reset Cart
     */
    public function resetCart()
    {
        Cart::instance('cart')->destroy();
        if (session()->has('coupon')) {
           session()->forget('coupon');
        }
        session()->forget('checkout');
        $this->thankyou =1 ;
    }
    /**Varify For Checkout */
    public function verifyForCheckout()
    {
        if ( ! Auth::check() ) {
            return redirect()->route('login');
        }elseif ($this->thankyou ) {
            return redirect()->route('thankyou');
        }elseif ( ! session()->has('checkout') ) {
            return redirect()->route('product.cart');
        }else {

        }
    }
    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}
