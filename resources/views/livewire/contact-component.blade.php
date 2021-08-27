<main id="main" class="main-site left-sidebar">
    <div class="container">
        @livewire('breadcrumb-component')
        <div class="row">
            <div class=" main-content-area">
                <div class="wrap-contacts ">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="contact-box contact-form">
                            <h2 class="box-title">Leave a Message</h2>
                            <form wire:submit.prevent="sendMessage">

                                <label for="name">Name<span>*</span></label>
                                <input type="text" value="" id="name" name="name" wire:model="name">
                                @error( 'name' ) <p class="text-danger">{{$message}}</p> @enderror

                                <label for="email">Email<span>*</span></label>
                                <input type="email" value="" id="email" name="email" wire:model="email">
                                @error( 'email' ) <p class="text-danger">{{$message}}</p> @enderror

                                <label for="phone">Number Phone<span>*</span></label>
                                <input type="number" value="" id="phone" name="phone" wire:model="phone">
                                @error( 'phone' ) <p class="text-danger">{{$message}}</p> @enderror

                                <label for="comment">Comment<span>*</span></label>
                                <textarea name="comment" id="comment" wire:model="comment"></textarea>
                                @error( 'comment' ) <p class="text-danger">{{$message}}</p> @enderror

                                <button type="submit">Submit</button>
                                @if (Session::has('msg'))
                                <span class="alert alert-success">{{Session::get('msg')}}</span>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="contact-box contact-info">
                            <div class="wrap-map">
                                <div class="mercado-google-maps"
                                     id="az-google-maps57341d9e51968"
                                     data-hue=""
                                     data-lightness="1"
                                     data-map-style="2"
                                     data-saturation="-100"
                                     data-modify-coloring="false"
                                     data-title_maps="Kute themes"
                                     data-phone="088-465 9965 02"
                                     data-email="kutethemes@gmail.com"
                                     data-address="Z115 TP. Thai Nguyen"
                                     data-longitude="-0.120850"
                                     data-latitude="51.508742"
                                     data-pin-icon=""
                                     data-zoom="16"
                                     data-map-type="ROADMAP"
                                     data-map-height="263">
                                </div>
                            </div>
                            <h2 class="box-title">Contact Detail</h2>
                            <div class="wrap-icon-box">

                                <div class="icon-box-item">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <div class="right-info">
                                        <b>Email</b>
                                        <p>{{ $setting->email}}</p>
                                    </div>
                                </div>

                                <div class="icon-box-item">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <div class="right-info">
                                        <b>Phone</b>
                                        <p>{{ $setting->phone}}</p>
                                    </div>
                                </div>

                                <div class="icon-box-item">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <div class="right-info office_address">
                                        <b>Mail Office</b>
                                        <p class="address">{!! $setting->address !!}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end main products area-->
        </div><!--end row-->
    </div><!--end container-->
</main>
