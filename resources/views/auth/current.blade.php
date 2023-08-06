@extends('layouts.app')

@section('title', 'Unauthorised')

@section('content')
    <div class="bg-indigo-700">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">Terminated User</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-indigo-200">You are not permitted to access this website!</p>
        </div>
    </div>

@endsection
