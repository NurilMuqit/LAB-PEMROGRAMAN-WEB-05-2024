@extends('layouts.master')

@section('title', 'Home')

@section('content')

    <section class="home">
        <div class="home-content">
            <h1>Halo, gw Radinata</h1>
            <h3>Seorang mahasiswa Sistem Informasi Unhas</h3>
            <p>Suka makan pisang goreng, denger musik dan nonton anime</p>
            <div class="mainButton">
                <x-button route="about" text="Bentar, kamu siapa?" />
            </div>
        </div>

        <div class="picture">
            <img src="img/profile.jpg" alt="Foto Profil" width="400">
        </div>
    </section>

@endsection
