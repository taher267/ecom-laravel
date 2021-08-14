<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class AdminDashboardComponent extends Component
{

    public function render()
    {
        return view('livewire.admin.admin-dashboard-component')->layout('layouts.dashboard');
    }
}
