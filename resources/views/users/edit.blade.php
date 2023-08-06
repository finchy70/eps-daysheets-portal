
@section('title', 'Edit User')

<x-app-layout>
    <form action="{{route('users.update', $user)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="p-8 mt-12 w-1/2 mx-auto border border-gray-400 rounded-xl bg-gray-100">
            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Name</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="name" name="name" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{$user->name}}">
            </div>

            <div class="mt-6">
                <label for="user" class="block text-sm font-medium leading-5 text-gray-700">Email</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input id="email" name="email" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{$user->email}}">
                </div>
            </div>


            <div class="mt-6">
                <label for="clientId" class="block text-sm font-medium leading-5 text-gray-700">Role / Client</label>
                <select name="clientId" id="clientId" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="1000" {{($user->client_id == null && $user->admin == false) ? 'selected': ''}}>Engineer</option>
                    <option value="2000" {{($user->client_id == null && $user->admin == true) ? 'selected': ''}}>Admin</option>
                    @foreach($clients as $client)
                        <option value="{{$client->id}}" {{($user->client_id == $client->id) ? 'selected' : ''}}>{{$client->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-8 row justify-end flex">
                <a href="{{route('users')}}" class="justify-end inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-teal-600 hover:bg-teal-500 focus:outline-none focus:border-teal-700 focus:shadow-outline-teal active:bg-indigo-700 transition ease-in-out duration-150">
                    Back
                </a>
                <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                    Update
                </button>
            </div>
        </div>
    </form>
</x-app-layout>>
