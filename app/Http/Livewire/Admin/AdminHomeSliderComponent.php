<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithPagination;

class AdminHomeSliderComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $homeSlides = HomeSlider::paginate();
        return view('livewire.admin.admin-home-slider-component', compact('homeSlides'))->layout('layouts.base');
    }
}
