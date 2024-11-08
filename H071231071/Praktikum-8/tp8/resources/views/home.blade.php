@extends('layouts.master')

@section('title', 'Home')


@section('content')

<section class="bg-[#f4f2ef]">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 lg:px-8">
        <div class="mt-20">
            <div class="py-8 mx-auto max-w-screen-xl text-left lg:py-16">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl" style="color: #2c4a3b;">
                    Take Your Coffee To Start Your Day
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl">
                    Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.
                </p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-start sm:space-y-0">
                    <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-green-900 hover:bg-green-800 focus:ring-4 focus:ring-green-700">
                        Get started
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                    <a href="#" class="py-3 px-5 sm:ms-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-[#c6bdb4] hover:text-green-900 focus:z-10 focus:ring-4 focus:ring-gray-100 ">
                        Learn more
                    </a>  
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center mt-20">
            <img class="h-auto max-w-full rounded-lg" src="https://fore.coffee/wp-content/uploads/2023/08/Group-1321314173-3.png" alt="">
        </div>
    </div>
</section>

<div class="relative w-full flex justify-center">
    <!-- Gambar sebagai background -->
    <div class="w-full h-auto">
        <img src="{{ asset('images/Judul.png') }}" alt="Judul Gambar" class="w-full h-auto object-cover" />
    </div>

    <!-- Konten grid yang berada di atas gambar -->
    <div class="absolute inset-0 flex flex-col items-center justify-center space-y-6">
        <h1 class="text-center mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl" style="color: #2c4a3b;">
            Benefits & Promo
        </h1>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-4 bg-opacity-0 bg-white/0 backdrop-blur-md rounded-lg">
            <!-- Gambar di dalam grid -->
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://fore.coffee/wp-content/uploads/2023/11/appbanner1-1-1.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://fore.coffee/wp-content/uploads/2023/11/appbanner3-1-1.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg" src="https://fore.coffee/wp-content/uploads/2023/11/2-08-1_11zon-1-2048x2048.jpg" alt="">
            </div>
        </div>
    </div>
</div>




@endsection
