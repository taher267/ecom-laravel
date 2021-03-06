<main id="main" class="main-site">
    @section('title', 'Checkout')
    <div class="container">
        @livewire('breadcrumb-component')
        <div class=" main-content-area">
            <div class="row">
                <form name="frm-billing" wire:submit.prevent="placeOrder" >
                    <div class="col-lg-12 col-md-12">
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Billing Address</h3>
                                <div class="builling-address">
                                <p class="row-in-form">
                                    <label for="fname">first name<span>*</span></label>
                                    <input wire:model="first_name" type="text" name="first_name" placeholder="Your name">
                                    @error('first_name') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                </p>

                                <p class="row-in-form">
                                    <label for="lname">last name<span>*</span></label>
                                    <input wire:model="last_name" type="text" name="last_name" placeholder="Your last name">
                                    @error('last_name') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                </p>

                                <p class="row-in-form">
                                    <label for="email">Email Addreess:</label>
                                    <input wire:model="email" type="email" name="email" placeholder="Type your email">
                                    @error('email') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror

                                </p>
                                <p class="row-in-form">
                                    <label for="mobile">Mobile number<span>*</span></label>
                                    <input wire:model="mobile" type="number" name="mobile" placeholder="Mobile no...">
                                    @error('mobile') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Line 1<span>*</span></label>
                                    <input type="text" name="line1" wire:model="line1" placeholder="Street at apartment number">
                                    @error('line1') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Line 2:</label>
                                    <input type="text" name="line2" wire:model="line2" placeholder="Street at apartment number">
                                    @error('line2') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="country">Country<span>*</span></label>
                                    <input wire:model="country" type="text" name="country" placeholder="Bangladesh">
                                    @error('country') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="city">Town / City<span>*</span></label>
                                    <input  wire:model="city" type="text" name="city" placeholder="City name">
                                    @error('city') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="zip-code">Postcode / ZIP:</label>
                                    <input wire:model="zipcode" type="number" name="zipcode" placeholder="Your postal code">
                                    @error('zipcode') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="province">Province<span>*</span></label>
                                    <input  wire:model="province" type="text" name="province" placeholder="province name">
                                    @error('province') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                </p>
                                <p class="row-in-form fill-wife">
                                    <label class="checkbox-field">
                                        <input name="different-add" wire:model="ship_to_different" id="different-add" value="1" type="checkbox">
                                        <span>Ship to a different address?</span>
                                    </label>
                                </p>
                            </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                    {{-- @endif --}}
                    @if ($ship_to_different)
                        <div class="col-lg-12 col-md-12">
                            <div class="wrap-address-billing">
                                <h3 class="box-title">Shipping Address</h3>
                                    <div class="builling-address">
                                    <p class="row-in-form">
                                        <label for="fname">first name<span>*</span></label>
                                        <input wire:model="s_first_name" type="text" name="s_first_name" placeholder="Your name">
                                        @error('s_first_name') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="lname">last name<span>*</span></label>
                                        <input wire:model="s_last_name" type="text" name="s_last_name" placeholder="Your last name">
                                        @error('s_last_name') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="email">Email Addreess:</label>
                                        <input wire:model="s_email" type="email" name="s_email" placeholder="Type your email">
                                        @error('s_email') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="mobile">Mobile number<span>*</span></label>
                                        <input wire:model="s_mobile" type="number" name="s_mobile" placeholder="Mobile no...">
                                        @error('s_mobile') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="add">Line 1<span>*</span></label>
                                        <input type="text" name="s_line1" wire:model="s_line1" placeholder="Street at apartment number">
                                        @error('s_line1') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="add">Line 2:</label>
                                        <input type="text" name="s_line2" wire:model="s_line2" placeholder="Street at apartment number">
                                        @error('s_line2') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="country">Country<span>*</span></label>
                                        <input wire:model="s_country" type="text" name="s_country" placeholder="Bangladesh">
                                        @error('s_country') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="city">Town / City<span>*</span></label>
                                        <input  wire:model="s_city" type="text" name="s_city" placeholder="City name">
                                        @error('s_city') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="zip-code">Postcode / ZIP:</label>
                                        <input wire:model="s_zipcode" type="number" name="s_zipcode" placeholder="Your postal code">
                                        @error('s_zipcode') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                    </p>
                                    <p class="row-in-form">
                                            <label for="province">Province<span>*</span></label>
                                        <input  wire:model="s_province" type="text" name="s_province" placeholder="Province name">
                                        @error('s_province') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                    </p>

                                </div>

                            </div>
                        </div>
                    @endif
                    <div class="col-lg-12 col-md-12">
                        <div class="summary summary-checkout">
                            <div class="summary-item payment-method">
                                <h4 class="title-box">Payment Method</h4>
                                @if ($paymentmethod=='card')
                                    <div class="wrap-address-billing">
                                        @if ( Session::has( 'stripe_error' ) )
                                        <div class="alert alert-danger"> {{Session::get('stripe_error')}} </div>
                                        @endif
                                        <div class="builling-address">
                                            <p class="row-in-form">
                                                <label for="card_no">Card Number<span>*</span></label>
                                                <input wire:model="card_no" type="number" name="card_no" placeholder="Card Number">
                                                @error('card_no') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                            </p>

                                            <p class="row-in-form">
                                                <label for="expiry_year">Expiry Year<span>*</span></label>
                                                <input wire:model="expiry_year"  id="expiry_year"type="number" name="expiry_year" placeholder="YYYY">
                                                @error('expiry_year') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                            </p>
                                            <p class="row-in-form">
                                                <label for="expiry_month">Expiry Month<span>*</span></label>
                                                <input wire:model="expiry_month" id="expire_month" type="number" name="expiry_month" placeholder="MM" min="01" max="12">
                                                @error('expiry_month') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                            </p>
                                            <p class="row-in-form">
                                                <label for="cvs">CVC:</label>
                                                <input wire:model="cvc" type="password" name="cvc" placeholder="CVC">
                                                @error('cvc') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                            </p>
                                        </div>
                                    </div>
                                    @endif

                                <div class="choose-payment-methods">
                                    <label class="payment-method">
                                        <input name="paymentmethod" wire:model="paymentmethod" id="payment-method-bank" value="cod" type="radio">
                                        <span>Cash on Delivery</span>
                                        <span class="payment-desc">Order Now, Pay on Delivery</span>
                                    </label>
                                    <label class="payment-method">
                                        <input name="paymentmethod" wire:model="paymentmethod" id="payment-method-visa" value="card" type="radio">
                                        <span>Debit / Credit Payment</span>
                                        <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                                    </label>
                                    <label class="payment-method">
                                        <input name="paymentmethod" wire:model="paymentmethod" id="payment-method-paypal" value="paypal" type="radio">
                                        <span>Paypal</span>
                                        <span class="payment-desc">You can pay with your credit</span>
                                        <span class="payment-desc">card if you don't have a paypal account</span>
                                    </label>
                                    @error('paymentmethod') <label class="text-danger mt-0p75" role="danger">{{$message}}</label> @enderror
                                </div>
                                <p class="summary-info grand-total"><span>Grand Total</span> <span class="grand-total-price">${{Session::has('checkout')? Session::get('checkout')['total'] : 0}}</span></p>
                                <button type="{{$errors->any() || $submitBtnStatus ?'button':'submit'}}" {{$errors->any() || $submitBtnStatus ?'disabled':''}} class="btn btn-medium">Place order now</button>
                            </div>
                            <div class="summary-item shipping-method">
                                <h4 class="title-box f-title">Shipping method</h4>
                                <p class="summary-info"><span class="title">Flat Rate</span></p>
                                <p class="summary-info"><span class="title">Fixed $0</span></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!--end main content area-->
    </div><!--end container-->
</main>
