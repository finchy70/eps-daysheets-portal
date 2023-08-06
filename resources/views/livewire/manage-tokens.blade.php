<div>
    <div class="mb-6 text-center text-2xl text-indigo-600 font-extrabold">API Tokens</div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="mx-auto max-w-5xl shadow overflow-hidden border-b border-gray-400 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">
                                Token
                            </th>
                            <th class="px-6 py-3 bg-gray-100"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr class="{{($loop->iteration % 2)?'bg-white':'bg-gray-200'}}">
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                    {{$user->name}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    @if($user->tokens->count() == 0)
                                        No token allocated
                                    @else
                                        Token allocated on {{ Carbon\Carbon::parse($user->tokens[0]->created_at)->format('d-m-Y') }} at {{ Carbon\Carbon::parse($user->tokens[0]->created_at)->format('H:m') }}
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    @if($user->tokens->count() > 0)
                                        <button type="button" onclick="return confirm('Are you sure you want to revoke the api token belonging to {{$user->name}}?')" wire:click="revokeToken({{$user->id}})" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">Revoke Token</button>
                                    @else
                                        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">No Token Issued</button>
                                    @endif
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

