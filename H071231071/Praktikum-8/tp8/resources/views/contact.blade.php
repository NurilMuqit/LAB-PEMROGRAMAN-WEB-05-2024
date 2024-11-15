@extends('layouts.master')

@section('title', 'Contact')

@section('content')

<div class="flex justify-center items-center min-h-screen px-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8 max-w-4xl w-full">

        <div class="flex justify-center items-center mt-10 lg:mt-0">
            <a href="#" class="block w-full p-6 bg-[#025f41] border border-gray-200 rounded-lg shadow hover:bg-green-900 max-w-md">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Informasi Kontak</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">
                    Jika Anda mempunyai pertanyaan atau kekhawatiran, Anda dapat menghubungi kami dengan mengisi 
                    formulir kontak, menelepon kami, datang ke kantor kami, menemukan kami di jejaring sosial lain,
                    atau Anda dapat mengirim email pribadi kepada kami di:
                </p>
                <br>

                <!-- SVG icons with text beside each icon -->
                <div class="flex space-x-4 mt-5 items-center">
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z"/>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-400">Telepon</span>
                    </div><br>
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2.038 5.61A2.01 2.01 0 0 0 2 6v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6c0-.12-.01-.238-.03-.352l-.866.65-7.89 6.032a2 2 0 0 1-2.429 0L2.884 6.288l-.846-.677Z"/>
                            <path d="M20.677 4.117A1.996 1.996 0 0 0 20 4H4c-.225 0-.44.037-.642.105l.758.607L12 10.742 19.9 4.7l.777-.583Z"/>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-400">Email</span>
                    </div><br>
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-400">Lokasi</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="mt-10 lg:mt-0">
            <form class="max-w-md mx-auto w-full">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_Name" id="floating_Name" class="block py-2.5 px-0 w-full text-sm text-green-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-900 peer" placeholder=" " required />
                    <label for="floating_Name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-900">Name</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-green-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-900 peer" placeholder=" " required />
                    <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-900">Email address</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_Phone Number" id="floating_Phone Number" class="block py-2.5 px-0 w-full text-sm text-green-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-900 peer" placeholder=" " required />
                    <label for="floating_Phone Number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-900">Phone Number</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_Message" id="floating_Message" class="block py-2.5 px-0 w-full text-sm text-green-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-900 peer" placeholder=" " required />
                    <label for="floating_Message" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-900">Message</label>
                </div>

                <button type="submit" class="text-white bg-[#025f41] hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection
