@extends('layouts.master')

@section('title', 'About')

@section('content')

    <section class="about">

        <div class="about-content">
            <h1>A story about me</h1>
            <p>
                {{ $nama }}, bisa dipanggil Restu atau Radinata juga boleh.
                Saat ini gwa adalah seorang mahasiswa Sistem Informasi di Universitas Hasanuddin.
                Gwa masuk jurusan ini karena gwa tertarik dengan dunia teknologi dan pengen belajar lebih dalam lagi.
                Meski ga jago, tapi gwa udah pernah nyobain bahasa pemrograman Python, Java, dan baru-baru ini belajar webdev dengan PHP Laravel.
                Ini Laravel bikin pusing sumpah awokkawokwoka.
                
                <br><br>
                Gwa punya hobi baca buku (jumlah buku yang selesai dibaca tahun 2024: 0), denger musik dan nonton anime.
                Beberapa musik favorit gw yaitu:     
                <div>
                    <ol>
                        <li>K-391 - Aurora
                            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/album/25DMpXc3h4lBPIwBRvCEiI?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        </li>
                        <li>
                            BTS- Euphoria
                            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/3p6hnejEQYXkiTO1lAzVc0?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        </li>
                    </ol>
                </div>
            </p>

            <div class="mainButton">
                <x-button route="contact" text="Cukup yappingnya, berikan kontakmu sekarang!" />
            </div> 
        </div>

        <div class="mirai-content">
            <h1>My Waifu</h1>

            <div class="picture">
                <img src="img/mirai.png" alt="Foto Profil">
            </div>

            <p>
                {{ $istri }} adalah karakter utama dari anime Kyoukai no Kanata.
                Dia adalah seorang gadis berkacamata dengan rambut pendek berwarna merah muda.
                Mirai adalah satu-satunya yang selamat dari klan pejuang roh yang memiliki kemampuan untuk memanipulasi darah mereka.
                Karena kemampuan ini, dia sering dianggap berbahaya dan dijauhi oleh orang lain.
                Mirai memiliki kepribadian yang pemalu dan canggung, tetapi dia sangat bertekad dan berani ketika melindungi orang-orang yang dia sayangi.
                Dia juga memiliki hobi menulis blog tentang tanaman bonsai.
                Meskipun dia terlihat lemah, Mirai adalah pejuang yang sangat kuat dan terampil dalam menggunakan darahnya sebagai senjata.
            </p>
        </div>
    </section>

@endsection
