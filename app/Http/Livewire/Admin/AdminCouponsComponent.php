<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCouponsComponent extends Component
{
    use WithPagination;
    /**
     * Delete coupons
     * @param int id
     */
    public function deleteCoupon($coupon_id)
    {
        $coupon = Coupon::findOrFail($coupon_id);
        $coupon->delete();
        session()->flash('msg', "Coupon has been deleted!");
    }
    public function render()
    {
        $coupons = Coupon::paginate(6);
        return view('livewire.admin.admin-coupons-component', compact('coupons'))->layout('layouts.base');
    }
}
