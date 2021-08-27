<div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Change Password</h3>
        </div>
        <div class="panel-body">
            <form>
                <div class="form-group input-group mb-3">
                    <span class="input-group-text">Current Password</span>
                    <input class="form-control" name="current_password" placeholder="Current Password..." type="text" wire:model="current_password" >
                </div>
                @error( 'current_password' ) <div class="alert alert-danger">{{$message}}</div> @enderror

                <div class="form-group input-group mb-3">
                    <span class="input-group-text">New Password</span>
                    <input class="form-control" placeholder="New Password" name="password" type="text" wire:model="password">
                </div>
                @error( 'password' ) <div class="alert alert-danger">{{$message}}</div> @enderror
                <div class="form-group input-group mb-3">
                    <span class="input-group-text">Confirm Password</span>
                    <input class="form-control" placeholder="confrim Passowrd..." name="password_confirmation" type="text" wire:model="password_confirmation">
                </div>
                @error( 'password_confirmation' ) <div class="alert alert-danger">{{$message}}</div> @enderror
                <div class="form-group input-group">
                    <button type="submit" class="form-control btn-info btn">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>
