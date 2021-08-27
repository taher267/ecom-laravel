<div class="col-lg-9 mx-auto">
    <div class="panel panel-default">
        <div class="panel-heading">
            @if ( Session::has('msg') )
                <p class="alert alert-danger">{{Session::get('msg')}}</p>
            @endif
            <h3 class="text-center">Change Password</h3>
        </div>
        <div class="panel-body">
            <style>
                div#current_password_group { position: relative;}

                div#current_password_group::after {
                    position: absolute;right: 12px; line-height: 35px;font-size: 16px; z-index: 9999;
                    @if ( $passMatchDB === true )
                    content: 'Password matched';color: green;
                    @elseif ( $passMatchDB === false )
                    content: 'Password does not match'; color: red;
                    @endif


                }


            </style>
            <form wire:submit.prevent="changePassword">
                <div class="form-group input-group mb-3" id="current_password_group">
                    <span class="input-group-text">Current Password</span>
                    <input required class="form-control" name="current_password" placeholder="Current Password..." type="text" id="current_password" wire:keyup="checkPassword" wire:model="current_password" >
                </div>
                @error( 'current_password' ) <p class="text-danger">{{$message}}</p> @enderror

                <div class="form-group input-group mb-3">
                    <span class="input-group-text">New Password</span>
                    <input required class="form-control" placeholder="New Password" name="password" type="text" wire:model="password">
                </div>
                @error( 'password' ) <p class="text-danger">{{$message}}</p> @enderror
                <div class="form-group input-group mb-3">
                    <span class="input-group-text">Confirm Password</span>
                    <input required class="form-control" placeholder="Confrim Passowrd..." name="password_confirmation" type="text" wire:model="password_confirmation">
                </div>
                @error( 'password_confirmation' ) <p class="text-danger">{{$message}}</p> @enderror
                <div class="form-group input-group">
                    <button type="submit"  class="form-control btn-info btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
