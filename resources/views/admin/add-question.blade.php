@extends('template.html')

@section('title','Admin View Question')

@section('content')
<div>
    <!-- Static sidebar for desktop -->
    @include('template.sidebar')
    <div class="md:pl-64 flex flex-col flex-1">
        <div class="sticky top-0 z-10 md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-gray-100">
            <button type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Open sidebar</span>
                <!-- Heroicon name: outline/menu -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <main class="flex-1">
            <div class="py-6">
                <div class="max-w-7xl flex items-center mx-auto px-4 sm:px-6 lg:px-8 mb-4">
                    <h1 class="text-2xl font-semibold text-gray-900 mr-3">Questions</h1>
                    <!-- <button class="p-2 bg-gray-300 text-xs text-blue-400">Add New Question</button> -->
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mb-4 lg:flex lg:items-center lg:justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center">
                            <div class="text-xs">
                                All(6,708) | 
                                <!-- <a href="#" class="text-blue-400 hover:text-blue-600">Mine(9)</a> | -->
                                <a href="#" class="text-blue-400 hover:text-blue-600">Published(5,434)</a> |
                                <a href="#" class="text-blue-400 hover:text-blue-600">Pending(3)</a> | 
                                <a href="#" class="text-blue-400 hover:text-blue-600">private(1,269)</a>
                            </div>
                            <div class="flex">
                                <input type="search" name="search" id="search-question" class="flex-grow block min-w-0 text-xs border-gray-300 border">
                                <div class="px-4 text-right sm:px-2">
                                    <button type="submit" class="bg-white border border-gray-400 shadow-sm px-4 py-2 inline-flex justify-center text-sm font-medium text-gray-500 hover:bg-gray-700">
                                        Search Questions
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6 w-full">
                            <div class="sm:overflow-hidden w-full">
                                <div class="bg-white py-6 px-4 space-y-6 sm:p-6 ">
                                    <div class="grid grid-cols-12 gap-6">
                                        <form action="#" method="post" class="col-span-3 flex">
                                            <div class="flex items-center justify-center">
                                                <select id="action" name="action" class="mt-1 block w-full bg-white border border-gray-300 rounded-md mr-2 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option>Bulk Action</option>
                                                    <option>Small Action</option>
                                                    <option>Action</option>
                                                </select>

                                                <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Apply
                                                </button>
                                            </div>
                                        </form>   
                                        <form action="#" method="post" class="col-span-9">
                                            <div class="flex items-center justify-center">
                                                <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 mr-2 focus:border-indigo-500 sm:text-sm">
                                                    <option>All Dates</option>
                                                    <option>Today</option>
                                                    <option>Next Date</option>
                                                </select>
                                                <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option>All SEO Scores</option>
                                                    <option>SEO</option>
                                                    <option>SEO Plus</option>
                                                </select>
                                                <div class="mt-1 block w-full bg-white py-2 px-3  sm:text-sm">
                                                    <input type="checkbox" name="" id="">
                                                    <label for="">Sticky Questions</label>
                                                    <button class="ml-2 px-4 py-2 border">Filter</button>
                                                </div>
                                                
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- table -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg px-4 py-2">
                                    <form class="space-y-8 divide-y divide-gray-200" method="post" action="{{ route('add.question') }}">
                                        @csrf
                                        <div class="space-y-8 divide-y divide-gray-200">
                                            <div>
                                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                                    <div class="sm:col-span-6">
                                                       
                                                        <div class="mt-1">
                                                            <input id="name" name="name" placeholder="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
                                                        </div>
                                                    </div>
                                                    <div class="sm:col-span-6">
                                                        <div class="mt-1">
                                                            <input type="email" placeholder="email" id="email" name="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
                                                        </div>
                                                    </div>
                                                    <div class="sm:col-span-6">
                                                        <div class="mt-1">
                                                            <input id="title" placeholder="question title" name="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
                                                        </div>
                                                    </div>

                                                    <div class="sm:col-span-6">
                                                        <div class="mt-1">
                                                            <textarea id="question" name="question" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 sm:text-sm border border-gray-300 rounded-md" placeholder="Type Question" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="sm:col-span-6">
                                                        <label for="status" class="block text-lg font-medium mb-2 text-gray-700">
                                                            Status
                                                        </label>
                                                        <div class="mt-1">
                                                            <select id="status" name="status" class="block p-2 w-full cursor-pointer border border-gray-300">
                                                                <option value="1">Public</option>
                                                                <option value="2">Private</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="sm:col-span-6">
                                                        <label for="about" class="block text-lg font-medium mb-2 text-gray-700">
                                                            Category
                                                        </label>
                                                        <div class="mt-1">
                                                            <select id="category" name="category" class="block w-full cursor-pointer border p-2 border-gray-300">
                                                                @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="sm:col-span-6">
                                                        <div class="mt-1">
                                                            <input type="text" placeholder="Question tag" name="tag" id="tag" class="p-2 block w-full border pl-4 border-gray-300" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>        
                                        </div>

                                        <div class="pt-5">
                                            <div class="flex justify-start">
                                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md uppercase text-white bg-green-500">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection