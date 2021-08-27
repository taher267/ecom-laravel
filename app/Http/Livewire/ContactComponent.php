<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Setting;
use Livewire\Component;


class ContactComponent extends Component
{
    use TraitFunctions;

    public $name, $email, $phone, $comment;

    public function updated( $fields )
    {
        $this->validateOnly( $fields, [
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'    => 'required|numeric|digits_between:11,13',
            'comment'   => 'required'
        ]);
    }
    public function sendMessage()
    {
        $this->validate( [
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'    => 'required|numeric|digits_between:11,13',
            'comment'   => 'required'
        ]);

        $contact            = new Contact();
        $contact->name      = $this->name;
        $contact->email     = $this->email;
        $contact->phone     = $this->phone;
        $contact->comment   = $this->comment;

        if (  $contact->save() ) {
            session()->flash('msg', "Message Has been send!");
        }


    }
    public function render()
    {
        $setting = Setting::find(1);
        return view('livewire.contact-component', compact('setting'))->layout('layouts.base');
    }
}
