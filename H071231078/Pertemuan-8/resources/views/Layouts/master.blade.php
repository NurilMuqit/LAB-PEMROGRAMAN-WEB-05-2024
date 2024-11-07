<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-light py-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('img/Arknights_English_Release_Logo.svg.png') }}" alt="logo" class="logo" style="width: 150px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <x-navbar-button label="HOME" url="home" />
                        <x-navbar-button label="ABOUT" url="about" />
                        <x-navbar-button label="CONTACT" url="contact"/>
                    </ul>
                </div>
            </nav>
        </div>
    </header>  

    <x-notification type="{{$type}}" message="{{ $message }} "/>

    <section>
        <div class="container mt-5">
            @yield('SectionMain')
        </div>
    </section>

    <footer class="bg-dark text-white mt-5 py-3">
        <div class="container d-flex flex-column align-items-center">
            <div class="row">
                <div class="col text-center">
                    <img src="{{ asset('img/logo.bc9c8b4d.png') }}" alt="logo" class="footer-logo" style="width: 270px;">
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="https://www.arknights.global/terms_of_service" class="btn text-light btn-sm mx-2">TERMS OF SERVICE</a>
                <a href="https://www.arknights.global/privacy_policy" class="btn text-light btn-sm mx-2">PRIVACY POLICY</a>
            </div>
        </div>
    </footer>     

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
