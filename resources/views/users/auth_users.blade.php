<x-app-layout>
    @section('title', 'Users')
    <div class="my-8 text-center text-2xl text-indigo-600 font-extrabold">Unauthorised Clients</div>
        @foreach($users as $user)
            <livewire:auth-user :aUser="$user"/>
        @endforeach
    <div>{{$users->links()}}</div>
</x-app-layout>

