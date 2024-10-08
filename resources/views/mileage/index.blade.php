<x-app-layout>
    @section('title', "Mileage Rate")
    <div class="mt-4 text-center text-2xl text-indigo-600 font-extrabold">Mileage Rates</div>
    <div class="max-w-3xl mx-auto flex-col">
        <div class="mt-8 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="mx-auto max-w-3xl shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-600 text-left text-xs leading-4 font-medium text-gray-100 uppercase tracking-wider">
                                Client
                            </th>
                            <th class="px-6 py-3 bg-gray-600 text-left text-xs leading-4 font-medium text-gray-100 uppercase tracking-wider">
                                Current Mileage Rate per Mile
                            </th>
                            <th class="px-6 py-3 bg-gray-600 text-right text-xs leading-4 font-medium text-gray-100 uppercase tracking-wider">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr class="{{$loop->iteration % 2 == 0 ? 'bg-white' : 'bg-gray-100'}} ">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $client->name }}</td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">£ {{ isset($client->currentMileageRate) ? $client->currentMileageRate->rate : ''}}</td>
                                <td class="whitespace-nowrap text-right py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    <a class="p-1 text-xs bg-blue-300 rounded hover:bg-blue-100" href="{{route('mileage.edit', $client->id)}}">Update</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
