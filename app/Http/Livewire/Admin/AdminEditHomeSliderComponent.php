<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title, $subtitle, $price, $link, $status, $image, $newimage, $slide_id;
    public function mount($slide_id)
    {
        $slide          = HomeSlider::find($slide_id);
        $this->title    = $slide->title;
        $this->subtitle = $slide->subtitle;
        $this->price    = $slide->price;
        $this->link     = $slide->link;
        $this->status   = $slide->status;
        $this->image    = $slide->image;
        $this->slide_id = $slide->id;
    }
    //live validation msg
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'status'=>  'required',
            'price' => 'nullable|numeric',
            'link'  => 'nullable|url',
            'newimage' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

    }

    //Data add in DB
    public function updateSlide()
    {
        $this->validate([
            'title' => 'required',
            'status'=>  'required',
            'price' => 'nullable|numeric',
            'link'  => 'nullable|url',
            'newimage' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        $slide              = HomeSlider::findOrFail($this->slide_id);
        $slide->title       = $this->title;
        $slide->subtitle    = $this->subtitle;
        $slide->price       = $this->price;
        $slide->link        = $this->link;
        $slide->status      = $this->status;
        //if Exists update image that insert
        if ( $this->newimage ) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $slide->image = $imageName;//$this->newimage;
        }
        //Old image delete if exist
        if ( $this->image ) {

        }

        if ( $slide->save() ) {
            if ( $this->newimage ) {
                $this->newimage->storeAs('home-slider', $imageName);
                //Delete Image of Phone
                if ( Storage::disk('local')->exists('home-slider/'. $this->image ) ) {
                    Storage::disk('local')->delete('home-slider/'. $this->image);

                }
            }
            session()->flash('msg', 'Slide has been updated!');
        }
    }


    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.base');
    }
}
