@extends('layouts.app')

@section('title', 'No Allowed')

@section('content')
    <div class="bg-indigo-700">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">You do not own the requested resource</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-indigo-200">You are not permitted to view inspections, documents, or pictures you do not own!</p>
            <a href="{{ url()->previous() }}" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto">
                Back
            </a>
        </div>
    </div>
@stop
