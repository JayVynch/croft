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
                    <h1 class="text-2xl font-semibold text-gray-900 mr-3">Comment</h1>
                    <a href="{{ route('add.question') }}" class="p-2 bg-gray-300 text-xs text-blue-400">Add New Question</a>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mb-4 lg:flex lg:items-center lg:justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center">
                            <div class="text-xs">
                            <a href="{{ route('admin.filter','all') }}" class="text-blue-400 hover:text-blue-600">All({{ $comment->count() }})</a> |
                                <a href="{{ route('admin.filter','published') }}" class="text-blue-400 hover:text-blue-600">Published({{ $comment->where('status','approved')->count() }})</a> |
                                <a href="{{ route('admin.filter','pending') }}" class="text-blue-400 hover:text-blue-600">Pending({{ $comment->where('status','pending')->count() }})</a> | 
                                <a href="{{ route('admin.filter','private') }}" class="text-blue-400 hover:text-blue-600">private({{ $comment->where('question_type','private')->count() }})</a>
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
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg px-4 py-2">
                                <article aria-labelledby="question-title-81614" class="flex flex-col w-full">
                                <div class="flex ">
                                    <div class="flex flex-col items-center justify-center space-x-3 px-2">
                                        <div class="">
                                            <img class="h-12 w-12 rounded-full" src="https://ui-avatars.com/api/?name={{ $comment->user->name }}" alt="">
                                        </div>
                                        
                                    </div>

                                    <!-- main question area -->
                                    <div class="w-full ml-4">
                                        <div class="flex justify-between w-full">
                                            <small id="" class="mt-4 text-xs font-medium text-gray-900">
                                                <span class="text-green-500"> {{ $comment->user->name }} </span>commented to <span class="text-green-500">{{ $comment->answer->user->name }}'s</span> answer  {{ $comment->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        
                                        <h2 id="question-title-81614" class="mt-4 text-base font-medium text-gray-900">
                                            C - {{ $comment->comment }}
                                        </h2>

                                        <div class="mt-2 text-sm text-gray-700 space-y-4">
                                            <a class="text-green-500" href="{{ route('show.answer',$comment->answer->id) }}">A - {{ $comment->answer->answer }}</a>
                                        </div>
                                    
                                        <div class="mt-2 text-sm text-gray-700 space-y-4">
                                            <a class="text-green-500" href="{{ route('show.question',$comment->answer->question->id) }}">Q - {{ $comment->answer->question->title }}</a>
                                        </div>
                                        <div class="mt-6 flex flex-col justify-between">
                                            <div class="flex justify-between mb-2">
                                                <div>
                                                    Question Tag : <span class="text-gray-400">{{ $comment->answer->question->tag }} </span>
                                                </div>
                                                <div>
                                                    This question is 
                                                    <span class="bg-gray-500 px-4 py-2 text-white rounded-lg">{{ $comment->answer->question->stage }}</span>
                                                </div>
                                            </div>
                                            <div class="flex w-full justify-between">
                                                <div class="px-6 py-4 whitespace-nowrap text-right w-full text-sm font-medium flex">
                                                    <div class="flex items-center">
                                                        
                                                    Comment status - <span class="text-green-500"> &nbsp;{{ $comment->status }} </span>
                                                    </div>
                                                    
                                                    <p class="px-2 w-full flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-500">
                                                            <path d="M10.5 1.875a1.125 1.125 0 012.25 0v8.219c.517.162 1.02.382 1.5.659V3.375a1.125 1.125 0 012.25 0v10.937a4.505 4.505 0 00-3.25 2.373 8.963 8.963 0 014-.935A.75.75 0 0018 15v-2.266a3.368 3.368 0 01.988-2.37 1.125 1.125 0 011.591 1.59 1.118 1.118 0 00-.329.79v3.006h-.005a6 6 0 01-1.752 4.007l-1.736 1.736a6 6 0 01-4.242 1.757H10.5a7.5 7.5 0 01-7.5-7.5V6.375a1.125 1.125 0 012.25 0v5.519c.46-.452.965-.832 1.5-1.141V3.375a1.125 1.125 0 012.25 0v6.526c.495-.1.997-.151 1.5-.151V1.875z" />
                                                        </svg>
                                                        <span>{{ $comment->answer->count() }} </span> <small>&nbsp;answers</small>
                                                    </p>
                                                    <p class="px-2 w-full flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-500">
                                                            <path d="M7.493 18.75c-.425 0-.82-.236-.975-.632A7.48 7.48 0 016 15.375c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75 2.25 2.25 0 012.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23h-.777zM2.331 10.977a11.969 11.969 0 00-.831 4.398 12 12 0 00.52 3.507c.26.85 1.084 1.368 1.973 1.368H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 01-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227z" />
                                                        </svg>

                                                        <span>{{ $comment->answer->votes->count() }}</span><small> &nbsp;votes</small>
                                                    </p>
                                                    
                                                </div>
                                                <div class="px-6 py-4 justify-end whitespace-nowrap text-right text-sm font-medium">
                                                    @if($comment->status != 'approved')
                                                    <form action="{{ route('approve.comment') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="comment" value="{{ $comment->id }}">
                                                        <button class="bg-green-500 px-4 py-2 shadow text-white rounded"  type="submit">Approve</button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </article>
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