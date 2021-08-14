<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class AdminSettingsComponent extends Component
{
   public $email, $phone, $phone2, $address, $map, $twitter, $facebook, $instagram, $youtube;

   public function mount()
   {
       $setting = Setting::find(1);
       if ($setting) {
        $this->email     = $setting->email;
        $this->phone     = $setting->phone;
        $this->phone2    = $setting->phone2 ;
        $this->address   = $setting->address;
        $this->map       = $setting->map;
        $this->twitter   = $setting->twitter;
        $this->facebook  = $setting->faceboo;
        $this->instagram = $setting->instagr;
        $this->youtube   = $setting->youtube;
    }
   }


   public function updated($fields)
   {
       $this->validateOnly($fields, [
        'email'     => 'required|email',
        'phone'     => 'required',
        'phone2'    => 'required',
        'address'   => 'required',
        'map'       => 'required',
        'twitter'   => 'required',
        'facebook'  => 'required',
        'instagram' => 'required',
        'youtube'   => 'required',
       ]);
   }

   public function saveSettings()
   {
       $this->validate([
        'email'     => 'required|email',
        'phone'     => 'required',
        'phone2'    => 'required',
        'address'   => 'required',
        'map'       => 'required',
        'twitter'   => 'required',
        'facebook'  => 'required',
        'instagram' => 'required',
        'youtube'   => 'required',
       ]);

       $setting = Setting::find(1);
       if ( ! $setting ) {
            $setting            = new Setting();
            $setting->email      = $this->email;
            $setting->phone      = $this->phone;
            $setting->phone2     = $this->phone2;
            $setting->address    = $this->address;
            $setting->map        = $this->map;
            $setting->twitter    = $this->twitter;
            $setting->facebook   = $this->facebook;
            $setting->instagram  = $this->instagram;
            $setting->youtube    = $this->youtube;
            $setting->save();

            session()->flash('msg', 'Admin Settings have been saved!');
    }
   }
    public function render()
    {
        return view('livewire.admin.admin-settings-component')->layout('layouts.dashboard');
    }
}
