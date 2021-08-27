<!DOCTYPE html>
<html lang="en">
@livewire('links-component')
<body class="home-page home-01 ">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

	<!--header-->
    @livewire('header-component')

		{{$slot}}

    @livewire('footer-component')

	<script src="{{asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/nouislider/nouislider.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.flexslider.js')}}"></script>
	<!-- <script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script> -->
	<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.sticky.js')}}"></script>
	<script src="{{asset('assets/js/functions.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>

    {{-- <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> --}}
    <script src="{{asset('assets/js/jquery-1.7.2.min.js')}}"></script>
    {{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js"></script> --}}

	<script src="https://cdn.tiny.cloud/1/kkzm7aotubmkrvxqfvo82szskkhwzcqh9wd4vt5jjqqir1q2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.js" integrity="sha512-jWNpWAWx86B/GZV4Qsce63q5jxx/rpWnw812vh0RE+SBIo/mmepwOSQkY2eVQnMuE28pzUEO7ux0a5sJX91g8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

	@livewireScripts
    @stack('scripts')
</body>
</html>
