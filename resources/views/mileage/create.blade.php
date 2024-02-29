@section('title', "Mileage Rate")
<x-app-layout>
    <div class="mt-4 mb-2 text-center text-2xl text-indigo-600 font-extrabold">Current Mileage Rate</div>
    <div class="max-w-3xl mx-auto flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="mx-auto max-w-3xl shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <select name="client" id="client" wire:model="clientId" class="mb-2 text-xs text-gray-800 rounded-lg">
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                                <option value=""></option>
                            </select>
                            <th class="px-6 py-3 bg-gray-600 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                Rate
                            </th>
                            <th class="px-6 py-3 bg-gray-600 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                Valid From
                            </th>
                            <th class="px-6 py-3 bg-gray-600 text-white text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                Valid To
                            </th>
                            <th class="px-6 py-3 bg-gray-600 text-white text-right text-xs leading-4 font-medium uppercase tracking-wider">Options</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                £{{number_format($rate->rate, 2, thousands_separator: '')}}
                            </td>
                            <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                {{Carbon\Carbon::parse($rate->valid_from)->format('d-m-Y')}}
                            </td>
                            <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                {{$rate->valid_to != null ? Carbon\Carbon::parse($rate->valid_to)->format('d-m-Y') : 'Ongoing'}}
                            </td>
                            <td class="px-4 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                <div class="row flex justify-end">
{{--                                    <a href="{{route('mileage.edit', $rate->id)}}" class="justify-end inline-flex items-center px-2 py-1 border border-transparent text-xs leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">Edit</a>--}}
                                </div>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <form action="{{route('mileage.store')}}" method="POST">
            @csrf
            <div class="mt-8 p-2 max-w-2xl mx-auto border border-indigo-500 bg-gray-200 rounded-lg overflow-hidden">
                <div class="row flex justify-center">
                    New Rate Valid From {{now()->format('d-m-Y')}}
                </div>
                <div class="row flex justify-center">
                    <input name='newRate' id='newRate' type="number" step="0.01" class="px-2 py-1 bg-white border border-gray-400 rounded-lg ">
                </div>
                <div class="row flex justify-center">
                    @error('newRate')<span class="text-xs text-red-600 italic">{{$message}}</span>@enderror
                </div>
                <div class="mt-2 row flex justify-end space-x-4">
                    <a href="{{route('mileage')}}" class="mb-4 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">Back to Menu</a>
                    <button type="submit" class="mb-4 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">Save</button>
                </div>

            </div>
        </form>

    </div>
</x-app-layout>
