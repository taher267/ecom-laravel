<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;

    public $title, $subtitle, $price, $link, $status, $image;
    public function mount()
    {
        $this->status = 1;
    }
    //live validation msg
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'status'=>  'required',
            'price' => 'nullable|numeric',
            'link'  => 'nullable|url',
            'image' => 'mimes:png,jpg,jpeg|image|required',
        ]);

    }

    //Data add in DB
    public function storeSlide()
    {
        $this->validate([
            'title' => 'required',
            'status'=>  'required',
            'price' => 'nullable|numeric',
            'link'  => 'nullable|url',
            'image' => 'mimes:png,jpg,jpeg|image|required',
        ]);

        $slide              = new HomeSlider;
        $slide->title       = $this->title;
        $slide->subtitle    = $this->subtitle;
        $slide->price       = $this->price;
        $slide->link        = $this->link;
        $slide->status      = $this->status;
        // $slide->image       = $this->image;

        //if Exists image
        if ( $this->image ) {
            $imageName =
            Str::slug($this->title) .
             Carbon::now()->timestamp . '.' . $this->image->extension();
            $slide->image = $imageName;
        }

        if ( $slide->save() ) {
            if ($this->image) {
                $this->image->storeAs('home-slider', $imageName);
            }
            session()->flash('msg', 'Slide has been added!');
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')->layout('layouts.base');
    }
}
