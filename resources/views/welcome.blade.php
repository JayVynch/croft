@extends('template.html')

@section('title','Welcome')

@section('content')
    <div class="fixed top-0 left-0 w-1/2 h-full bg-white" aria-hidden="true"></div>
    <div class="fixed top-0 right-0 w-1/2 h-full bg-white" aria-hidden="true"></div>
    <div class="relative w-full max-w-7xl flex flex-col">
    
        <div class=" lg:flex lg:items-center xl:px-8 py-8 lg:justify-between">
            <div class="flex-1 min-w-0">
                
                <h2 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Support Forum
                </h2>
                <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        Our support covers getting demo site alike setup, bug fixes and guidance limited to our
                        themes and plugin. Regretfully organization requests or 3rd party supports are beyound 
                        our scope of support.
                    </div>
                </div>
            </div>
        </div>

        <!--  column wrapper -->
        <div class="flex-grow w-full max-w-7xl mx-auto xl:px-8 lg:flex">
            <!-- main wrapper -->
            <div class="flex-1 min-w-0 bg-white md:flex w-full">
                <div class="bg-white w-full lg:flex-1">
                    <div class="h-full py-6 px-4 sm:px-6 lg:px-8">
                        <!-- Start main area-->
                        <div class="relative h-full" style="min-height: 36rem;">
                            <div class="my-4">
                                <div >
                                    <form class="mt-1 flex rounded-md shadow-sm" action="/" method="get">
                                        <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                            <input type="search" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none border rounded-l-md pl-10 sm:text-sm border-gray-300" placeholder="What do you want to know ?">
                                        </div>
                                        <button type="submit" class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                        <!-- Heroicon name: solid/sort-ascending -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="my-4">
                                <div class="mt-1 flex rounded-md p-4">
                                    <div class="w-full flex">
                                        <div class="w-full">
                                            <p>
                                                Filter : 

                                                <a href="{{ route('filter','all') }}" class="text-green-500">All</a>
                                                <a href="{{ route('filter','open') }}" class="text-green-500">Open</a>
                                                <a href="{{ route('filter','resolved') }}" class="text-green-500">Resolved</a>
                                                <a href="{{ route('filter','closed') }}" class="text-green-500">Closed</a>
                                                <a href="{{ route('filter','unanswered') }}" class="text-green-500">Unanswered</a>
                                            </p>
                                        </div>
                                        <div class="mt-1 sm:mt-0 sm:col-span-2 flex-end">
                                            <!-- <select id="country" name="country" autocomplete="country-name" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full cursor-pointer sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                                <option>Filter</option>
                                                <option>Canada</option>
                                                <option>Mexico</option>
                                            </select> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-6 sm:space-y-5 my-2">
                                        <!-- questions -->
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class=" overflow-hidden">
                                                <table class="w-full divide-y divide-gray-200">
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach($questions as $question)
                                                        <tr class="border">
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    <div class="flex-shrink-0 h-10 w-10">
                                                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $question->user->name }}" alt="">
                                                                    </div>
                                                                    <div class="ml-4 px-6 py-2 whitespace-nowrap">
                                                                        
                                                                        <a href="{{ route('question.single', $question->slug) }}" class="text-sm font-medium text-gray-900">
                                                                            {{ $question->title }}
                                                                        </a>
                                                                        <div class="text-sm flex  text-gray-500">
                                                                            <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-lg  bg-gray-500 text-white mr-2">
                                                                                {{ $question->stage}}
                                                                            </div>
                                                                            <div>
                                                                                {{ $question->created_at->diffForHumans() }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                <div class=" border  py-4 flex flex-col justify-center align-center">
                                                                    <div class="text-sm font-medium text-center text-gray-900">
                                                                        {{ $question->views->count() }}
                                                                    </div>
                                                                    <div class="text-sm text-gray-500">
                                                                        <div class="text-center">
                                                                            views
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                <div class="border py-4 flex flex-col justify-center align-center">
                                                                    <div class="text-sm font-medium text-center text-gray-900">
                                                                    {{ $question->answer->count() }}
                                                                    </div>
                                                                    <div class="text-sm text-gray-500">
                                                                        <div class="text-center">
                                                                            answers
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                <div class="border py-4 flex flex-col justify-center align-center">
                                                                    <div class="text-sm font-medium text-center text-gray-900">
                                                                    {{ $question->votes->count() }}
                                                                    </div>
                                                                    <div class="text-sm text-gray-500">
                                                                        <div class="text-center">
                                                                            votes
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                        <!-- End main area -->
                        </div>
                    </div>
                </div>

                <!-- right side menu -->
                <div class="bg-gray-50 px-4 sm:pr-6 lg:pr-8 lg:flex-shrink-0 lg:border-l lg:border-gray-200 xl:pr-0">
                    <div class="h-full pl-6 py-6 lg:w-80">
                        <!-- Start right column area -->
                        <div class="h-full relative" style="min-height: 16rem;">
                            <div class="w-full py-2">
                                <a href="{{ route('question.create') }}" class="px-4 py-4 bg-green-500 flex justify-center items-center text-white w-full">
                                    Ask Question
                                </a>
                            </div>
                            <div class="mt-2">
                                <p class="mb-2">Categories</p>

                                @foreach($categories as $category)
                                    <div class="border-t flex justify-between items-center border-b px-4 py-2 ">
                                        <a href="{{ route('question.category',$category->slug) }}" class="text-green-500">
                                            {{ $category->name }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- <div class="mt-6">
                                <p class="mb-2">Topics</p>
                                <div class="border-t flex justify-between items-center border-b px-4 py-2 ">
                                    <p class="text-green-500">
                                        DW Argo
                                    </p>
                                    <p class="text-gray-500">
                                        142
                                    </p>
                                </div>
                                <div class="border-t flex justify-between items-center border-b px-4 py-2 ">
                                    <p class="text-green-500">
                                        Anything Wordpress
                                    </p>
                                    <p class="text-gray-500">
                                        142
                                    </p>
                                </div>
                            </div> -->
                        </div>
                        <!-- End right column area -->
                    </div>
                </div>
            </div>
        </div>
@endsection
