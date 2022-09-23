@extends('template.html')

@section('title','Welcome')

@section('content')
    <div class="fixed top-0 left-0 w-1/2 h-full bg-white" aria-hidden="true"></div>
    <div class="fixed top-0 right-0 w-1/2 h-full bg-white" aria-hidden="true"></div>
    <div class="relative w-full max-w-7xl justify-center flex flex-col">
    
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
        <div class="flex-grow w-full max-w-7xl lg:justify-center mx-auto xl:px-8 lg:flex">
            <!-- main wrapper -->
            <div class="flex-1 min-w-0 bg-white xl:flex">
                <div class="bg-white lg:min-w-0 lg:flex-1">
                    <div class="h-full py-6 px-4 sm:px-6 lg:px-8">
                    <!-- Start main area-->
                    <div class="relative h-full" style="min-height: 36rem;">
                        <div class="mt-4">
                            Your {{ ucfirst($hint) }} is Pending, and waiting to be reviewed and approved by the admins.
                        </div>
                    <!-- End main area -->
                    </div>
                </div>
            </div>

            <!-- right side menu -->
            <div class="bg-gray-50 pr-4 sm:pr-6 lg:pr-8 lg:flex-shrink-0 lg:border-l lg:border-gray-200 xl:pr-0">
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
                                    <a href="{{ route('question.category',$category->id) }}" class="text-green-500">
                                        {{ $category->name }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End right column area -->
                </div>
            </div>
        </div>
    </div>
@endsection
