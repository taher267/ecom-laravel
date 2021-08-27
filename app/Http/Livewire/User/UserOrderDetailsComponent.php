<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserOrderDetailsComponent extends Component
{
    public $order_id, $status, $is_shipping_different, $rating, $comment;
    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }
    public function cancelOrder()
    {
        $order          =  Order::findOrFail($this->order_id);
        $order->status  = 'canceled';
        $order->canceled_date  = DB::raw('CURRENT_DATE');
        $order->save();
        session()->flash('status_msg', "Order status has been Canceled!");
    }

    public function render()
    {
        $order = Order::where('id', $this->order_id )->where('user_id', Auth::user()->id)->first();
        return view('livewire.user.user-order-details-component', compact('order') )->layout('layouts.userdash');
    }
}
