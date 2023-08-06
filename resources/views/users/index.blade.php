
<x-app-layout>
    @section('title', 'Users')
    <div class="my-4 text-center text-2xl text-indigo-600 font-extrabold">Users</div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="mx-auto max-w-4xl shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr class="bg-gray-600">
                            <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider text-white">
                                Client
                            </th>
                            <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider text-white">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider text-white">Role / Client</th>
                            <th class="px-6 py-3 text-right text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider text-white">Options</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            @if($user->id != 1)
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="{{($loop->iteration % 2)?'bg-white':'bg-gray-200'}}">
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                            {{$user->name}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                            {{$user->email}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                            @if($user->client_id == null && $user->admin == false)
                                                Engineer
                                            @elseif($user->client_id == null && $user->admin == true)
                                                Admin
                                            @else
                                                {{$user->client->name}}
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                            <div class="row flex">
                                                @if($user->id != auth()->user()->id)
                                                    <a href="{{route('users.un_auth', $user->id)}}" onclick="return confirm('Are you sure you want to remove authorisation for {{$user->name}}?')" class="ml-auto justify-end inline-flex items-center px-2 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">Unauthorise</a>
                                                    <a href="{{route('users.leaver', $user->id)}}" onclick="return confirm('Are you sure you want to mark {{$user->name}} as a leaver?')" class="ml-auto justify-end inline-flex items-center px-2 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">Leaver</a>
{{--                                                    <form action="{{route('users.delete', $user->id)}}" method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <button onclick="return confirm('Are you sure you want to delete {{$user->name}}?  This can not be undone!')" class="ml-4 inline-flex items-center btn-red">Delete</button>--}}
{{--                                                    </form>--}}
                                                @endif
                                                <a href="{{route('users.edit', $user->id)}}" class="{{($user->id == auth()->user()->id) ? 'ml-auto' : 'ml-4'}} justify-end inline-flex items-center px-2 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            @endif

                        @endforeach
                        <div class="mt-6">
                            {{ $users->links() }}
                        </div>
                    </table>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
