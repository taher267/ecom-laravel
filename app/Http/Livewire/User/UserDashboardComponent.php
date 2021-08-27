<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\TraitFunctions;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class UserDashboardComponent extends Component
{
    use TraitFunctions;

    public $current_password, $password, $password_confirmation, $passMatchDB, $submitError;

    public function updated( $fields )
    {
        $this->updatedValidation( $fields );
    }

    public function changePassword()
    {
        $this->changingPasswords();
    }

    public function checkPassword()
    {
        $this->checkingPassword();
    }

    public function render()
    {

        return view('livewire.user.user-dashboard-component')->layout('layouts.userdash');
    }
}
