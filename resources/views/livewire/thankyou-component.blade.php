<main id="main" class="main-site">
    <div class="container">
        @livewire('breadcrumb-component');
    </div>

    <div class="container pb-60">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Thank you for your order</h2>
                <p>A confirmation email was sent.</p>
                <a href="{{route('shop')}}" class="btn btn-submit btn-submitx">Continue Shopping</a>
            </div>
        </div>
    </div><!--end container-->

</main>
