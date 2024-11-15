@extends('layouts.master')

@section('title', 'About')


@section('content')

<section class="bg-[#f7f9f9]">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 lg:px-8 h-screen"> <!-- Added h-screen for full height -->
        <div class="flex justify-center items-center mt-20">
            <img class="h-auto max-w-full rounded-lg" src="https://fore.coffee/wp-content/uploads/2023/09/ourstory2.png" alt="">
        </div>
        <div class="flex justify-center items-center mt-20"> <!-- Add Flexbox here -->
            <div class="py-8 mx-auto max-w-screen-xl text-left lg:py-16">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl" style="color: #2c4a3b;">
                    Let to Know Us
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl">
                    Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.
                </p>
            </div>
        </div>
    </div>
</section>
<section class="bg-[#f4f2ef]">


    <div class="grid grid-cols-2 gap-2">
        <div>
            <div class="flex justify-center items-center"> <!-- Add Flexbox here -->
                <div class="py-8 mx-auto max-w-screen-xl text-left lg:py-16">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl" style="color: #2c4a3b;">
                        Our Story
                    </h1>
                </div>
            </div>
        </div>
        <div>
            <div class="flex justify-center items-center"> <!-- Add Flexbox here -->
                <div class="py-8 mx-auto max-w-screen-xl text-left lg:py-16 text-gray-700">
                    <p>In a fast-paced world it is easy to lose sight of what truly matters. Fore provides a place of solace where people can simply slow 
                        down and enjoy a high-quality cup of coffee. This philosophy is reflected within our tagline.</p>
                    <p>
                        By utilizing the word ‘Grind’ which has a double meaning: ‘Grind’ as in the day-to-day hustle that people go through, and ‘Grind’ as a key step in the coffee making process, Fore inspires people to embrace life's 
                        essentials in the midst of their busy lifestyles through each cup of coffee we serve.
                    </p>
                </div>
            </div>
        </div>
        <div>
            <div class="flex justify-center items-center"> <!-- Add Flexbox here -->
                <div class="py-8 mx-auto max-w-screen-xl text-left lg:py-16">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl" style="color: #2c4a3b;">
                        Bout Our Products
                    </h1>
                </div>
            </div>
        </div>
        <div>
            <div class="flex justify-center items-center"> <!-- Add Flexbox here -->
                <div class="py-8 mx-auto max-w-screen-xl text-left lg:py-16 text-gray-700">
                    <p>Fore Coffee is certified Halal Grade A by MUI with number LPPOM-00160233461223. 
                        We uphold high standards in the manufacture and presentation of products using 100% Halal ingredients.</p>
                </div>
            </div>
        </div>
    </div>


</section>



@endsection
