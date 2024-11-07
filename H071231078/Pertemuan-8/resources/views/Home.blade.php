@extends('layouts.master')

@section('SectionMain')
<div class="container my-5">
    <div class="row align-items-center">
        <!-- Left Content Section -->
        <div class="col-lg-6 text-start">
            <h1 class="display-4 fw-bold">Become a Defender of Terra in Arknights</h1>
            <p class="lead mt-3">Lead your team of elite operators through tactical challenges, defend against waves of enemies, and uncover the mysteries of a dystopian world.</p>
            
            <div class="d-flex mt-4">
                <a href="https://play.google.com/store/apps/details?id=com.YoStarEN.Arknights&pli=1" class="me-3">
                    <img src="{{ asset('img/3.fa510ad1.png') }}" alt="Google Play" style="width: 150px; margin-right:5px;">
                </a>
                <a href="https://apps.apple.com/us/app/arknights/id1464872022?mt=8">
                    <img src="{{ asset('img/1.9982db6b.png') }}" alt="App Store" style="width: 150px;">
                </a>
            </div>
        </div>

        <div class="col-lg-6 text-center">
            <img src="{{ asset('img/char_4009_irene_2.png') }}" alt="Character Image" class="img-fluid">
        </div>
    </div>
</div>
@endsection
