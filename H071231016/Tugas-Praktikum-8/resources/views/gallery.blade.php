@extends('layouts.main')
@section('content')
<section id="gallery">
    <div class="container-gallery">
        <h2 class="galeri-h2">GALLERY</h2>
        <div class="gallery">
            <div class="image-fix">
                <img class="image" src="images/encantofamili.jpg" alt="encantofamili">
            </div>
            <div class="image-fix"><img class="image" src="{{asset('images/encantofamili2.jpg')}}" alt="encantofamili2"></div>
            <div class="image-fix"><img class="image" src="{{asset('images/encantofamili3.jpg')}}" alt="encantofamili3"></div>
            <div class="image-fix"><img class="image" src="{{asset('images/encantofamili4.jpg')}}" alt="encantofamili4"></div>
            <div class="image-fix"><img class="image" src="{{asset('images/encantofamili5.jpg')}}" alt="encantofamili5"></div>
            <div class="image-fix"><img class="image" src="{{asset('images/encantofamili6.jpg')}}" alt="encantofamili6"></div>
        </div>
    </div>
</section>
@endsection
{{-- {{asste('path')}} --}}