@extends('layouts.master')

@section('SectionMain')
<div class="container text-center my-5">
    <!-- Contact Header -->
    <div class="mb-4">
        <h1>Contact our team</h1>
        <p class="text-muted">Let us know how we can help.</p>
    </div>
    
    <!-- Contact Options -->
    <div class="row row-cols-1 row-cols-md-4 g-3 mb-5">
        <div class="col">
            <div class="card h-100 p-3">
                <div class="card-body">
                    <h5 class="card-title">Chat to our team</h5>
                    <p class="card-text">Speak to our friendly team.</p>
                    <a href="mailto:sales@untitledui.com" class="text-decoration-none">sales@untitledui.com</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 p-3">
                <div class="card-body">
                    <h5 class="card-title">Chat to support</h5>
                    <p class="card-text">We're here to help.</p>
                    <a href="mailto:support@untitledui.com" class="text-decoration-none">support@untitledui.com</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 p-3">
                <div class="card-body">
                    <h5 class="card-title">Visit us</h5>
                    <p class="card-text">Visit our office HQ.</p>
                    <a href="https://www.google.com/maps" target="_blank" class="text-decoration-none">View on Google Maps</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 p-3">
                <div class="card-body">
                    <h5 class="card-title">Call us</h5>
                    <p class="card-text">Mon-Fri from 8am to 5pm.</p>
                    <a href="tel:+15550000000" class="text-decoration-none">+1 (555) 000-0000</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
