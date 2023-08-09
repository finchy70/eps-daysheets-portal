<div class="max-w-7xl mx-auto">
    @section('title','Index')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-4 row flex justify-end">
            <button wire:click="newDaysheet" class="justify-end inline-flex items-center px-2 py-1 border border-transparent text-xs leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                New Daysheet
            </button>
        </div>
        <div class="mt-4 flow-root">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-1 bg-gray-600 pl-4 pr-3 text-left text-sm font-semibold text-gray-100 sm:pl-6">Date Of Visit</th>
                                <th scope="col" class="py-1 bg-gray-600 px-3 text-left text-sm font-semibold text-gray-100">Job Number</th>
                                <th scope="col" class="py-1 bg-gray-600 px-3 text-left text-sm font-semibold text-gray-100">Site</th>
                                <th scope="col" class="py-1 bg-gray-600 px-3 text-left text-sm font-semibold text-gray-100">Client</th>
                                <th scope="col" class="py-1 bg-gray-600 px-3 text-left text-sm font-semibold text-gray-100">{{auth()->user()->client_id == null ? 'Published' : ''}}</th>
                                <th scope="col" class="py-1 bg-gray-600 px-3 text-right text-sm font-semibold text-gray-100">Options</th>
                            </tr>
                            <tr>
                                <th scope="col" class="bg-gray-600 pl-4 pr-3 text-left text-sm font-semibold text-gray-100 sm:pl-6">
                                    <input type="date" class="mb-2 text-xs text-gray-800 rounded-lg" wire:model="searchedWorkDate" placeholder="Search"/>
                                </th>
                                <th scope="col" class="bg-gray-600 px-3 text-left text-sm font-semibold text-gray-100">
                                    <input type="number" class="mb-2 text-xs text-gray-800 rounded-lg" wire:model="searchedJobNumber" placeholder="Search"/>
                                </th>
                                <th scope="col" class="bg-gray-600 px-3 text-left text-sm font-semibold text-gray-100">
                                    <input type="text" class="mb-2 text-xs text-gray-800 rounded-lg" wire:model="searchedSite" placeholder="Search"/>
                                </th>
                                <th scope="col" class="bg-gray-600 px-3 text-left text-sm font-semibold text-gray-100">
                                    <select wire:model.lazy="selectedClient" class="mb-2 text-xs text-gray-800 rounded-lg">
                                        <option value="">All</option>
                                        @foreach($clientList as $client)
                                            <option wire:key="{{$loop->index}}" value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th scope="col" class="bg-gray-600 px-3 text-left text-sm font-semibold text-gray-100"></th>
                                <th scope="col" class="bg-gray-600 relative text-right pl-3 pr-4 sm:pr-6"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($daysheets as $daysheet)
                                <tr class="{{$loop->iteration % 2 == 0 ? 'bg-white' : 'bg-gray-100'}} ">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{$daysheet->work_date->format('d-m-Y')}}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{$daysheet->job_number}}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{$daysheet->site_name}}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{$daysheet->client->name}}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if(auth()->user()->client_id == null)
                                            <livewire:toggle-switch :daysheetId="$daysheet->id" :wire:key="$daysheet->id"/>
                                        @endif
                                    </td>
                                    <td class="row flex justify-end space-x-4 py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 space-x-4">
                                        <a href="{{route('daysheet.show', $daysheet)}}" class="justify-end inline-flex items-center px-2 py-1 border border-transparent text-xs leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">view</a>
                                        @if(auth()->user()->client_id == null)
                                            <a href="{{route('daysheet.edit', $daysheet)}}" class="justify-end inline-flex items-center px-2 py-1 border border-transparent text-xs leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">edit</a>
                                        @endif

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
</div>

