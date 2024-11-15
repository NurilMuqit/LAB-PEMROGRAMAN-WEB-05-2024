@extends('layouts/master')
@section('title', 'Add Inventory Log')

@section('header-button')
    <div class="flex justify-between items-center mt-4">
        <h2 class="text-xl font-bold"></h2>
        <a href="{{url('/inventoryLogs')}}" class="bg-orange-600 hover:bg-orange-500 text-white px-4 py-2 rounded">
            Back
        </a>
    </div>
@endsection

@section('content')    
    <section>
        <div class="py-4 px-4 mx-auto max-w-2xl ">
            <h2 class="mb-4 text-xl font-bold text-white">Add a new Log</h2>
            <form action="{{ url('/inventoryLogs') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="product_id" class="block mb-2 text-sm font-medium text-black">Product</label>
                        <select name="product_id" id="product_id" class="border text-sm rounded-lg focus:ring-slate-300 focus:border-slate-300 block w-full p-2.5 bg-gray-200 border-gray-600 placeholder-gray-400 text-black">
                            <option selected="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"> {{ $product->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="type" class="block mb-2 text-sm font-medium text-black">Type</label>
                        <select name="type" id="type" class="border text-sm rounded-lg focus:ring-slate-300 focus:border-slate-300 block w-full p-2.5 bg-gray-200 border-gray-600 placeholder-gray-400 text-black">
                            <option selected="">Select Type</option>
                            <option value="sold">Sold</option>
                            <option value="restock">Restock</option>
                        </select>
                    </div>
                    <div>

                    <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-black">quantity</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="border text-sm rounded-lg focus:ring-slate-300 focus:border-slate-300 block w-full p-2.5 bg-gray-200 border-gray-600 placeholder-gray-400 text-black" required="" min="1">
                    </div>
                </div>
                  <button type="submit" class=" bg-slate-200 hover:bg-slate-300 focus:ring-slate-200 text-slate-900 inline-flex items-center  focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                      <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                      Add new log
                  </button>
            </form>
        </div>
    </section>
@endsection