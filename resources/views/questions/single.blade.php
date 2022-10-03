@extends('template.html')

@section('title','Single Question')

@section('content')
<div class="min-h-full">
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-12 lg:gap-8">
            <main class="lg:col-span-12 xl:col-span-12">
                <div class="px-4 sm:px-0">
                    <div class="hidden sm:block">
                        <nav class="relative z-0 rounded-lg flex divide-x divide-gray-200" aria-label="Tabs">
                        <!-- <nav class="flex" aria-label="Breadcrumb"> -->
                            <ol role="list" class="flex items-center space-x-4">
                                <li>
                                    <div>
                                        <a href="/" class="text-green-500 hover:text-green-500">
                                            Support Forum
                                        </a>
                                    </div>
                                </li>

                                <li>
                                <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    <a href="#" class="ml-2 text-sm font-medium hover:text-green-700">Category:</a>
                                </div>
                                </li>

                                <li>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                        <a href="#" class="ml-2 text-sm font-medium text-green-500 hover:text-gray-700" aria-current="page">{{ $question->categories->first()['name'] }}</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                        <a href="#" class="ml-2 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ $question->question_type }}: {{ $question->title }}</a>
                                    </div>
                                </li>
                            </ol>
                            <!-- </nav> -->
                        </nav>
                    </div>
                </div>
                <div class="mt-4 full">
                    <ul role="list" class="space-y-4">
                        <li class="bg-white px-4 py-6 border-b border-gray-100 sm:p-6 sm:rounded-lg">
                            <article aria-labelledby="question-title-81614" class="flex flex-col w-full">
                                <div class="flex ">
                                    <div class="flex flex-col items-center justify-center space-x-3 px-2">
                                        <div class="">
                                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $question->user->name }}" alt="">
                                        </div>
                                        <div class="min-w-0 flex-1 mt-4">
                                            <form action="{{ route('upvote') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="question" value="{{ $question->id }}">
                                                <input type="hidden" name="type" value="question">
                                                <button class="text-sm font-medium text-gray-500" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                                                    </svg>
                                                </button>
                                            </form>
                                            
                                            <p class="text-center">{{ $question->votes()->where('type','question')->count() }}</p>
                                            <form action="{{ route('downvote') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="question" value="{{ $question->id }}">
                                                <input type="hidden" name="type" value="question">
                                                <button class="text-sm text-gray-500" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- main question area -->
                                    <div class="w-full ml-4">
                                        <div class="flex justify-between w-full">
                                            <small id="" class="mt-4 text-xs font-medium text-gray-900">
                                                <span class="text-green-500"> {{ $question->user->name }} </span>asked {{ $question->created_at->diffForHumans() }}
                                            </small>
                                            <div class="flex">
                                                <div class="px-2">
                                                    <!-- <input type="checkbox" name="subscribe" id="subscribe">
                                                    <label for="subscribe">subscribe</label> -->
                                                </div>
                                                <a href="#" class="px-2 text-green-500"> &nbsp;</a>
                                                <a href="#" class="px2 text-green-500">&nbsp;</a>
                                            </div>
                                        </div>
                                        
                                        <h2 id="question-title-81614" class="mt-4 text-base font-medium text-gray-900">
                                            {{ $question->title }}
                                        </h2>
                                    
                                        <div class="mt-2 text-sm text-gray-700 space-y-4">
                                            <p>{{ $question->question }}</p>
                                        </div>
                                        <div class="mt-6 flex flex-col justify-between">
                                            <div class="flex justify-between mb-2">
                                                <div>
                                                    Question Tag : <span class="text-green-500">{{ $question->tag }} </span>
                                                </div>
                                                <div class="flex">
                                                    This question is 
                                                    <div class="border ml-2 bg-gray-500 rounded-lg text-white px-2">
                                                        {{ $question->stage }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </article>
                            <div class="my-4 border-t ">
                                <!-- number of answer to question -->
                                {{ $question->answer->count() }} Answers
                            </div>
                        </li>
                        <!-- answer -->
                        @foreach($question->answer as $answer)
                            @if($answer->status == 'approved')
                                <li class="bg-white border-b border-gray-100 px-4 py-6 sm:p-6 sm:rounded-lg">
                                    <article aria-labelledby="question-title-81614" class="flex flex-col">
                                        <div class="flex w-full">
                                            <div class="flex flex-col items-center justify-center space-x-3 px-2">
                                                <div class="">
                                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $answer->user->name }}" alt="">
                                                </div>
                                                <div class="min-w-0 flex-1 mt-4">
                                                    <form action="{{ route('upvote') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="question" value="{{ $question->id }}">
                                                        <input type="hidden" name="type" value="answer">
                                                        <button class="text-sm font-medium text-gray-500" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    
                                                        <p class="text-center">
                                                        {{ $question->votes()->where('type','answer')->count() }}
                                                        </p>
                                                    <form action="{{ route('downvote') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="question" value="{{ $question->answer->first()->id }}">
                                                        <input type="hidden" name="type" value="answer">
                                                        <button class="text-sm text-gray-500" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- main question area -->
                                            <div class="ml-4 w-full">
                                                <div class="flex justify-between">
                                                    <small id="" class="mt-4 text-xs font-medium text-gray-900">
                                                        <span class="text-green-500">{{ $answer->user->name }} </span>answered {{ $answer->created_at->diffForHumans()}}
                                                    </small>
                                                    <div class="flex">
                                                        <a href="#" class="px2 text-green-500">&nbsp;</a>
                                                    </div>
                                                </div>
                                                
                                                <h2 id="question-title-81614" class="mt-4 text-base font-medium text-gray-900">
                                                {{ $answer->answer }}
                                                </h2>

                                                <div class="mt-6 flex flex-col justify-between p-4 bg-gray-100">
                                                    
                                                    <div class="flex flex-col text-sm w-full">
                                                        <div class="flex justify-between w-full">
                                                            <small id="" class="mb-4 text-xs font-medium text-gray-900">
                                                                <span class="text-green-500"> {{ $question->user->name }} </span>asked {{ $question->created_at->diffForHumans() }}
                                                            </small>
                                                            <div class="flex">
                                                                <a href="#" class="px-2 mr-2     text-green-500">&nbsp;</a>
                                                                    <a href="#" class="px-2 text-green-500">&nbsp;</a>
                                                                </div>
                                                            </div>
                                                            <div class="py-4">
                                                                @foreach($question->answer->first()->comment as $comment)
                                                                    @if($comment->status == 'approved')
                                                                        <div class="flex items-center border-b mb-2 pb-2">
                                                                            <div class="mr-3 ">
                                                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $comment->user->name }}" alt="{{ $comment->user->name }}">
                                                                            </div>
                                                                            {{ $comment->comment }}
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <form action="{{ route('comment',$question->answer->first()->id) }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="answer" value="{{ $question->answer->first()->id }}">
                                                                <input type="hidden" name="question" value="{{ $question->id }}">
                                                                <div class="sm:col-span-6">
                                                                
                                                                    <div class="mt-1">
                                                                        <input id="name" name="name" placeholder="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
                                                                    </div>
                                                                </div>
                                                                <div class="sm:col-span-6 mb-2">
                                                                    <div class="mt-1">
                                                                        <input id="email" name="email" placeholder="email address" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
                                                                    </div>
                                                                </div>
                                                                <input type="text" name="comment" id="comment" class="focus:ring-green-500 focus:border-green-500 block w-full rounded-none border p-2 border-gray-300" placeholder="write a comment">
                                                                
                                                                <div class="flex w-full">
                                                                    <button class="px-4 py-2 text-white justify-end rounded-lg bg-green-500 mt-2" type="submit">Comment</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </article>
                                </li>
                            @endif
                        @endforeach
                        <!-- More questions... -->
                    </ul>

                    @if($question->stage == 'open' )
                    <div class="mt-4 px-10 py-6">
                        Your Answer
                        <form action="{{ route('answer',$question->id) }}" method="post" class="flex flex-col">
                            @csrf
                            <input type="hidden" name="question" value="{{ $question->id }}">
                            <div class="sm:col-span-6">
                                <div class="mt-1">
                                    <input id="name" name="name" placeholder="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
                                </div>
                            </div>
                            <div class="sm:col-span-6 mb-2">
                                <div class="mt-1">
                                    <input id="email" name="email" placeholder="email address" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2 w-full sm:text-sm border border-gray-300 rounded-md" required>
                                </div>
                            </div>
                            <textarea id="answer" name="answer" rows="3" class="px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="your answer"></textarea>
                            <div class="flex w-full">
                                <button class="px-4 py-2 text-white justify-end rounded-lg bg-green-500 mt-2" type="submit">Answer</button>
                            </div>
                            
                        </form>
                    </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</div>
@endsection