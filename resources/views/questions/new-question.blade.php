@extends('template.html')

@section('title','New Question')

@section('content')
<div class="min-h-full">
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-12 lg:gap-8">
            <div class="lg:col-span-12 xl:col-span-12">
                <div class="mt-4">
                    <form class="space-y-8 divide-y divide-gray-200" method="post" action="{{ route('question.create') }}">
                        @csrf
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div>
                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-6">
                                        <label for="about" class="block text-lg font-medium mb-2 text-gray-700">
                                            Name
                                        </label>
                                        <div class="mt-1">
                                            <input id="name" name="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="about" class="block text-lg font-medium mb-2 text-gray-700">
                                            email
                                        </label>
                                        <div class="mt-1">
                                            <input type="email" id="email" name="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="about" class="block text-lg font-medium mb-2 text-gray-700">
                                            title
                                        </label>
                                        <div class="mt-1">
                                            <input id="title" name="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
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
                                        <label for="about" class="block text-lg font-medium mb-2 text-gray-700">
                                            Tag
                                        </label>
                                        <div class="mt-1">
                                            <input type="text" name="tag" id="tag" class="p-2 block w-full border pl-10 border-gray-300" >
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

@endsection