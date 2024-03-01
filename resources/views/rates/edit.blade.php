@section('title', "Mileage Rate")
<x-app-layout>
    <div class="mt-4 mb-2 text-center text-2xl text-indigo-600 font-extrabold">Rates - {{$rateToEdit[0]->client->name}} - {{$rateToEdit[0]->role->role}}</div>
    <div class="max-w-3xl mx-auto flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="mx-auto max-w-3xl shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>

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
                        @foreach($rateToEdit as $rate)
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
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <form method="Post" action="{{route('rates.store')}}">
            @method('POST')
            @csrf
            <div class="max-w-2xl mx-auto">
                <div class="mt-8 grid grid-cols-3">
                    <div>
                        <x-input-label>Date Rate Valid From</x-input-label>

                    </div>
                    <div>
                        <x-input-label>New Rate</x-input-label>

                    </div>
                    <div >

                    </div>
                </div>
                <input hidden="hidden" name="clientId" id="clientId" value="{{$rateToEdit[0]->client_id}}"/>
                <input hidden="hidden" name="roleId" id="roleId" value="{{$rateToEdit[0]->role_id}}"/>
                <div class="grid grid-cols-3 items-center">
                    <div>
                        <x-input  type='date' min="{{$rateToEdit[0]->valid_from->addDays(1)->format('Y-m-d')}}" name="fromDate" value="{{$rateToEdit[0]->valid_from->addDays(1)->format('Y-m-d')}}"></x-input>
                    </div>
                    <div>
                        <x-input type='number' step='0.01' min="0.01" name="rate"></x-input>
                    </div>
                    <div class="my-auto text-right">
                        <x-primary-button type="submit" class="text-right">Save New Rate</x-primary-button>
                    </div>
                </div>
                <div class="grid grid-cols-3 items-center">
                    <div>
                        @error('fromDate')<span class="italic text-xs text-red-500">{{$message}}</span>@enderror
                    </div>
                    <div>
                        @error('rate')<span class="italic text-xs text-red-500">{{$message}}</span>@enderror
                    </div>
                    <div class="my-auto text-right">
                    </div>
                </div>
            </div>
            <div class="max-w-5xl mx-auto">
                <div class="row flex justify-end mt-8">
                    <a href="{{route('clients')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</a>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>>
