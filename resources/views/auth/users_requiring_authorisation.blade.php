@extends('layouts.app')

@section('title', 'Requires Authorisation')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Users Waiting for Approval</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <h6 class="font-weight-bold">Name</h6>
                            </div>
                            <div class="col-4">
                                <h6 class="font-bold-bold">Email</h6>
                            </div>
                            <div class="col-2">
                                <h6 class="font-bold-bold">Remove</h6>
                            </div>
                            <div class="col-2">
                                <h6 class="font-bold-bold">Approve</h6>
                            </div>
                            <div class="col-2">
                                <h6 class="font-bold-bold">Approve</h6>
                            </div>
                        </div>
                        <hr>
                        @foreach($unauthorised_users as $user)
                            <div class="row mb-2">
                                <div class="col-2">
                                    {{$user->name}}
                                </div>
                                <div class="col-4">
                                    {{$user->email}}
                                </div>
                                <div class="col-2">
                                    <form action="{{route('users.destroy')}}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <input type="text" name="id" value="{{$user->id}}" hidden>
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <form action="{{route('users.authorise')}}" method="POST">
                                        @method('patch')
                                        @csrf
                                        <input type="text" name="id" value="{{$user->id}}" hidden>
                                        <button type="submit" class="btn btn-sm btn-success">As Engineer</button>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <a href="{{route('users.authorise_user', $user->id)}}"
                                        class="btn btn-sm btn-warning">As Client</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
