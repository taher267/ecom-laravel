<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminAddCouponComponent extends Component
{
    public $code, $type, $value, $cart_value, $expiry_date;

    public function mount()
    {
        $this->code         = $this->code;
        $this->type         = $this->type ;
        $this->value        = $this->value;
        $this->cart_value   = $this->cart_value;
        $this->expiry_date   = $this->expiry_date;

    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code'          => 'required|unique:coupons',
            'type'          => 'required',
            'value'         => 'required|numeric',
            'cart_value'    => 'required|numeric',
            'expiry_date'    => 'required|date|date_format:Y-m-d',
        ]);
    }
    /**
     * Add new coupon
     * @param string $code
     * @param string $type
     * @param decimal $value
     * @param decimal $cart_vcalue
     */
    public function storeCoupon()
    {
        $this->validate([
            'code'          => 'required|unique:coupons',
            'type'          => 'required',
            'value'         => 'required|numeric',
            'cart_value'    => 'required|numeric',
            'expiry_date'    => 'required|date|date_format:Y-m-d',
        ]);

        $coupon             = new Coupon();
        $coupon->code       = $this->code;
        $coupon->type       = $this->type;
        $coupon->value      = $this->value;
        $coupon->cart_value = $this->cart_value;
        $coupon->expiry_date = $this->expiry_date;
        $coupon->save();

        session()->flash('msg', "Coupon has been added!");
    }
    public function render()
    {
        return view('livewire.admin.admin-add-coupon-component')->layout('layouts.base');
    }
}
