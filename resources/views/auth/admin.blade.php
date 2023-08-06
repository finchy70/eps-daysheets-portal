@extends('layouts.app')

@section('title', 'Unauthorised')

@section('content')
    <div class="bg-indigo-700">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">The requested action can only be performed by a Site Admin.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-indigo-200">Please check and regularly.</p>

                <a href="{{url()->previous()}}" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto">
                    Back
                </a>


        </div>
    </div>
@endsection
