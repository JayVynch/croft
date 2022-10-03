@extends('template.html')

@section('title','Create Category')

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

                <!-- table -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden  sm:rounded-lg">
                                <form class="space-y-8 divide-y px-2 py-2 divide-gray-200" method="post" action="{{ route('category.update',$category->id) }}">
                                        @csrf
                                        <div class="space-y-8 divide-y">
                                            <div>
                                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                                    <div class="sm:col-span-6">
                                                        <label for="about" class="block px-2 text-lg font-medium mb-2 text-gray-700">
                                                            Category Name
                                                        </label>
                                                        <div class="mt-1">
                                                            <input id="name" value="{{ $category->name }}" name="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
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