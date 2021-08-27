<?php
namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait TraitFunctions {

    public function updatedValidation( $fields )
    {
        $this->validateOnly( $fields, [
            'current_password'              => 'required',
            'password'                      => 'required|confirmed|different:current_password|same:password|min:8',
            'password_confirmation'         => 'required'
        ]);
    }


    public function changingPasswords()
    {
        $this->validate( [
            'current_password'  => 'required',
            'password'          => 'required|confirmed|different:current_password|min:8'
        ]);
        if ( Hash::check( $this->current_password, Auth::user()->password ) ) {
            $user = User::findOrFail( Auth::user()->id );
            $user->password = Hash::make($this->password);
            $user->save();

         session()->flash('msg', Auth::user()->name.' password has been changed!');
        }else {
            session()->flash('msg', Auth::user()->name.' password does not match!');
        }
    }
    public function checkingPassword()
    {
        if ( Hash::check( $this->current_password, Auth::user()->password ) ) {
            $this->passMatchDB = true;

        }else {
            $this->passMatchDB = false;
        }
    }

    /**
     * Image Upload
     */

     public function uploadImage()
     {

     }

}
