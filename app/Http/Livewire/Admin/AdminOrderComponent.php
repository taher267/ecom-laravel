<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class AdminOrderComponent extends Component
{
    public $datas, $test, $inpText;
    public function searchText()
    {
        $this->inpText = $this->test;
    }

    public function updateOrderStatus(int $order_id, string $status)
    {
        $order = Order::find($order_id);
        $order->status = $status;
        if ($status== 'delivered') {
            $order->delivered_date = DB::raw('CURRENT_DATE');
        }elseif($status ==  'canceled'){
            $order->canceled_date = DB::raw('CURRENT_DATE');
        }
        $order->save();
        session()->flash('msg', 'Order has been updated!');
    }
    public function deleteOrder( int $order_id)
    {
        $order = Order::findOrFail($order_id);
        $this->datas =  $order->orderItems;
    }
      use WithPagination;
    public function render()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
        return view('livewire.admin.admin-order-component', compact('orders'))->layout('layouts.dashboard');
    }
}
