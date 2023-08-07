<div>
    <div class="mx-auto max-w-4xl bg-gray-100 shadow-lg overflow-hidden sm:rounded-lg mb-4">
        <ul class="divide-y divide-gray-200">
            <li>

                    <div class="flex items-center px-4 py-4 sm:px-6">
                        <div class="min-w-0 flex-1 flex items-center">
                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                <div>
                                    <p class="text-lg font-medium text-indigo-600 truncate">{{$user->name}}</p>
                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                        <!-- Heroicon name: mail -->
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                        <span class="truncate">{{$user->email}}</span>
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-900">
                                        User Type
                                        <time>{{$user->formatted_created_at}}</time>
                                    </p>
                                    <p>
                                    <div>
                                        <select wire:model.live="selectedClient" id="selectedClient{{$user->id}}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="1000" selected>EPS Engineer</option>
                                            <option value="2000">EPS Admin</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div>
                            <!-- Heroicon name: chevron-right -->
                            <button type="button" wire:click="authorise" class="ml-8 inline-flex px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                Authorise
                            </button>
                        </div>
                    </div>

            </li>
        </ul>
    </div>
</div>


