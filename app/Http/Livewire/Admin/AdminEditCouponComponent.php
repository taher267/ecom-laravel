<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminEditCouponComponent extends Component
{
    public $code, $type, $value, $cart_value, $coupon_id, $expiry_date;

    public function mount($coupon_id)
    {
        $coupon = Coupon::findOrFail($coupon_id);
        $this->coupon_id    = $coupon->id;
        $this->code         = $coupon->code;
        $this->type         = $coupon->type ;
        $this->value        = $coupon->value;
        $this->cart_value   = $coupon->cart_value;
        $this->expiry_date   = $coupon->expiry_date;

    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            // 'code'          => 'required|unique:coupons,'. $this->coupon_id,
            'code'          => ['required', \Illuminate\Validation\Rule::unique('coupons')->ignore($this->coupon_id)],
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
            // 'code'          => 'required|unique:coupons',
            'code'          => ['required', \Illuminate\Validation\Rule::unique('coupons')->ignore($this->coupon_id)],
            'type'          => 'required',
            'value'         => 'required|numeric',
            'cart_value'    => 'required|numeric',
            'expiry_date'    => 'required|date|date_format:Y-m-d',
        ]);

        $coupon             = Coupon::findOrFail($this->coupon_id);
        if ($coupon->code == $this->code && $coupon->type == $this->type && $coupon->value == $this->value && $coupon->cart_value == $this->cart_value && $this->expiry_date  == $coupon->expiry_date):
            session()->flash('msg', "Nothing has been Changed/Updated!!!");
        else:
            $coupon->code       = $this->code;
            $coupon->type       = $this->type;
            $coupon->value      = $this->value;
            $coupon->cart_value = $this->cart_value;
            $coupon->expiry_date = $this->expiry_date;
            $coupon->save();

            session()->flash('msg', "Coupon has been Updated!");
        endif;
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-coupon-component')->layout('layouts.base');
    }
}
