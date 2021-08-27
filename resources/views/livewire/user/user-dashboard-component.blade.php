<div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table class="table mx-auto w-75">
                    <tr>
                        <th>Name</th>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <th>Profile Photo</th>
                        <td><img src="{{ Auth::user()->profile_photo_url }}" alt=""></td>
                    </tr>
                </table>
            </div>
            @include('livewire.change-password')
        </div>
    </div>
</div>
