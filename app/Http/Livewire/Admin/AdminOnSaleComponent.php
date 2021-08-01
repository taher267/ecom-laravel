<?php

namespace App\Http\Livewire\Admin;

use App\Models\OnSale;
use Livewire\Component;

class AdminOnSaleComponent extends Component
{
    public $sale_date, $status;
    public function mount()
    {
        $datetime           = OnSale::findOrFail(1);
        $this->status       = $datetime->status;
        $this->sale_date    = $datetime->sale_date;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'status'    => 'required',
            'sale_date' => 'date|date_format:Y-m-d H:i:s',
        ]);
    }
    public function updateSaledate()
    {
        $this->validate([
            'status'    => 'required',
            'sale_date' => 'required|date|date_format:Y-m-d H:i:s',
        ]);

        $datetime               = OnSale::findOrFail(1);
        $datetime->status       = $this->status;
        $datetime->sale_date    = $this->sale_date;
        $datetime->save();
        session()->flash('msg', 'Sale Setting has been updated!');
    }
    public function render()
    {
        return view('livewire.admin.admin-on-sale-component')->layout('layouts.base');
    }
}
