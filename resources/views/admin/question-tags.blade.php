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
                    <a href="{{ route('add.question') }}" class="p-2 bg-gray-300 text-xs text-blue-400">Add New Question</a>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mb-4 lg:flex lg:items-center lg:justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center">
                            <div class="text-xs">
                                <a href="{{ route('admin.filter','all') }}" class="text-blue-400 hover:text-blue-600">All({{ $questions->count() }})</a> |
                                <a href="{{ route('admin.filter','published') }}" class="text-blue-400 hover:text-blue-600">Published({{ $questions->where('status','approved')->count() }})</a> |
                                <a href="{{ route('admin.filter','pending') }}" class="text-blue-400 hover:text-blue-600">Pending({{ $questions->where('status','pending')->count() }})</a> | 
                                <a href="{{ route('admin.filter','private') }}" class="text-blue-400 hover:text-blue-600">private({{ $questions->where('question_type','private')->count() }})</a>
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
                        
                        <!-- <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6 w-full">
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
                        </div> -->
                    </div>
                </div>

                <!-- table -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <input type="checkbox" name="select-all" id="select-all">
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Title
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Author
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Category
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tags
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97z" clip-rule="evenodd" />
                                                    </svg>

                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Date
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Info
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    SEO
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Odd row -->
                                            @foreach($tags as $question)
                                            <tr class="bg-white">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <input type="checkbox" name="select-1" id="select-1">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <a href="{{ route('show.question',$question->id) }}" > 
                                                        <span class="text-blue-400"> {{$question->title }} </span>
                                                    </a>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $question->user->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $question->categories->first()['name'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-blue-400 hover:text-blue-600">{{ $question->tag }}</a>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-lg">-
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-blue-400 hover:text-blue-600">Created - {{ $question->created_at->diffForHumans() }}</a>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    {{ $question->status }} 
                                                    <p>{{ $question->answer->count() }} - answers</p>
                                                    <p>
                                                        {{ $question->votes->count() }} - voted
                                                    </p>
                                                    <p>{{ $question->votes->count() }} -views</p>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <form action="{{ route('approve.question') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="question" value="{{ $question->id }}">
                                                        <button class="bg-green-500 px-4 py-2 shadow text-white rounded"  type="submit">Approve</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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