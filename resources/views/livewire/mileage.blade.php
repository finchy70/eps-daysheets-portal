<div>
    @section('title', "Mileage Rate")
    <div class="mt-4 text-center text-2xl text-indigo-600 font-extrabold">Mileage Rates</div>
    <div class="mx-auto max-w-3xl row justify-end flex">
        <a href="" class="mb-4 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">New Rate</a>
    </div>
    <div class="max-w-3xl mx-auto flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
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
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">£ {{ number_format($client->currentMileageRate, 2) }}</td>
                                    <td class="whitespace-nowrap text-right py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <x-secondary-button wire:click="update({{$client->id}})">Update</x-secondary-button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
