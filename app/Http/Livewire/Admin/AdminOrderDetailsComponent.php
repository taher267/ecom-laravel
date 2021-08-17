<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Transaction;
use Livewire\Component;

class AdminOrderDetailsComponent extends Component
{
    public $order_id, $status, $optionVal;
    public function mount($order_id)
    {
        $this->order_id = $order_id;
        $this->status   = 'pending';
    }
    public function changeStatus(string $approveStatus, int $transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $transaction->status = $approveStatus;
        if ($transaction->save()) {
            session()->flash('msg', "Status has been $approveStatus");
        }

        // dd( $transaction->status);

    }
    public function render()
    {
        $order = Order::findOrFail( $this->order_id );
        return view('livewire.admin.admin-order-details-component', compact('order'))->layout('layouts.dashboard');
    }
}
