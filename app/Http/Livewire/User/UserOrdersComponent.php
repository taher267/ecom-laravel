<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserOrdersComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::where('user_id', Auth::user()->id )->get();
        return view('livewire.user.user-orders-component', compact('orders'))->layout('layouts.userdash');
    }
}
