@extends('layouts.master')

@section('title', 'Contact')

@section('content')
<section class="contact">


    <div class="contact-content">
        <h1>My Contact</h1>

            <div class="contact-container">
                <a href="https://api.whatsapp.com/send/?phone=%2B6287723390480&text&type=phone_number&app_absent=0" target="_blank">
                    <img src="img/whatsapp.png" alt="">
                </a>
    
                <a href="https://www.instagram.com/radinata99/" target="_blank">
                    <img src="img/instagram.png" alt="">
                </a>
            </div>
           

            <x-alert type="info" message="Sebenarnya masih ada sosmed yang lain cuma gw biasanya make itu..." />

        <div class="mainButton">
            <x-button route="home" text="Ngga tertarik, gwa mau pulang"/>
        </div>

        
    </div>
</section>
@endsection
