@section('title', 'Client Edit')

<x-app-layout>
    <form action="{{route('clients.update', $client)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mt-12 max-w-2xl mx-auto">
            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Name</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="name" name="name" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{$client->name}}">
            </div>
        </div>
    </form>
    <div class="mt-8 max-w-4xl mx-auto">
        <table class="min-w-full divide-y divide-gray-200 rounded rounded-t-lg overflow-hidden">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-600 text-left text-xs leading-4 font-medium text-gray-100 uppercase tracking-wider">
                    Role
                </th>
                <th class="px-6 py-3 bg-gray-600 text-left text-xs leading-4 font-medium text-gray-100 uppercase tracking-wider">
                    Current Rate
                </th>
                <th class="px-6 py-3 bg-gray-600 text-right text-xs leading-4 font-medium text-gray-100 uppercase tracking-wider">Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rates as $rate)
                <tr class="{{$loop->iteration % 2 == 0 ? 'bg-white' : 'bg-gray-200'}} ">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $rate->role->role }}</td>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">£ {{ $rate->rate }}</td>
                    <td class="whitespace-nowrap text-right py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                        <a href="{{route('rates.edit', $rate->id)}}" class="mr-4">Update</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</x-app-layout>>
