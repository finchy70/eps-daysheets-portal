<x-app-layout>
    @section('title', "Mileage Rate")
    <div class="my-4 text-center text-2xl text-indigo-600 font-extrabold">Mileage Rates - {{$client->name}}</div>
    <div class="max-w-3xl mx-auto flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="mx-auto max-w-3xl shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-600 text-left text-xs leading-4 font-medium text-gray-100 uppercase tracking-wider">
                                Rate
                            </th>
                            <th class="px-6 py-3 bg-gray-600 text-left text-xs leading-4 font-medium text-gray-100 uppercase tracking-wider">
                                Valid From
                            </th>
                            <th class="px-6 py-3 bg-gray-600 text-left text-xs leading-4 font-medium text-gray-100 uppercase tracking-wider">
                                Valid To
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mileages as $mileage)
                            <tr class="{{$loop->iteration % 2 == 0 ? 'bg-white' : 'bg-gray-100'}} ">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $mileage->rate }}</td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$mileage->valid_from->format('d-m-Y')}}</td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{isset($mileage->valid_to) ? $mileage->valid_to->format('d-m-Y') : 'Ongoing'}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <form method="Post" action="{{route('mileage.store')}}">
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
                        <input hidden="hidden" name="clientId" id="clientId" value="{{$mileages[0]->client_id}}"/>
                        <div class="grid grid-cols-3 items-center">
                            <div>
                                <x-input  type='date' min="{{$mileages[0]->valid_from->addDays(2)->format('Y-m-d')}}" name="fromDate" value="{{$mileages[0]->valid_from->addDays(2)->format('Y-m-d')}}"></x-input>
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
                            <a href="{{route('mileage')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


