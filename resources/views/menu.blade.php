<x-app-layout>
    @section('title', 'Main Menu')
    <div class="mx-auto max-w-5xl">
        @Auth
            @if($unauthorisedUsers > 0  && auth()->user()->admin)
                <div class="py-4 mt-8 border border-indigo-500 bg-gray-50 shadow-lg sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Manage New Users
                        </h3>
                        <div class="mt-2 sm:flex sm:items-start sm:justify-between">
                            <div class="max-w-xl text-sm leading-5 text-gray-600">
                                <p>
                                    View and authorise new Engineers / Clients that have registered at EPS Inspect.
                                </p>
                            </div>
                            <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                            <span class="inline-flex rounded-md shadow-sm">
                                <a href="{{route('users.auth')}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                    Manage New Users
                                </a>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
            @if(auth()->user()->client_id == null)
                <div class="py-4 mt-8 bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            View / Edit Day Sheets
                        </h3>
                        <div class="mt-2 sm:flex sm:items-start sm:justify-between">
                            <div class="max-w-xl text-sm leading-5 text-gray-600">
                                <p>
                                    View and edit day sheets.  Also grant or revoke client access.
                                </p>
                            </div>
                            <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                            <span class="inline-flex rounded-md shadow-sm">
                                <a href="{{route('daysheets.index')}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                    Manage Day Sheets
                                </a>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(auth()->user()->admin)
                <div class="py-4 mt-8 bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Manage API tokens
                        </h3>
                        <div class="mt-2 sm:flex sm:items-start sm:justify-between">
                            <div class="max-w-xl text-sm leading-5 text-gray-600">
                                <p>
                                    Grant and revoke API tokens to mobile device users.
                                </p>
                            </div>
                            <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                            <span class="inline-flex rounded-md shadow-sm">
                                <a href="{{route('api_admin')}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                    Manage Tokens
                                </a>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-4 mt-8 bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Manage Clients
                        </h3>
                        <div class="mt-2 sm:flex sm:items-start sm:justify-between">
                            <div class="max-w-xl text-sm leading-5 text-gray-600">
                                <p>
                                    Add new Clients or edit existing ones.
                                </p>
                            </div>
                            <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                            <span class="inline-flex rounded-md shadow-sm">
                                <a href="{{route('clients')}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                    Manage Clients
                                </a>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-4 mt-8 bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Manage Users
                        </h3>
                        <div class="mt-2 sm:flex sm:items-start sm:justify-between">
                            <div class="max-w-xl text-sm leading-5 text-gray-600">
                                <p>
                                    Manage engineers and clients registered on EPS Inspect.
                                </p>
                            </div>
                            <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                            <span class="inline-flex rounded-md shadow-sm">
                                <a href="{{route('users')}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                    Manage Users
                                </a>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
            @if(auth()->user()->client_id != null)
                <div class="py-4 mt-8 bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            View Inspections
                        </h3>
                        <div class="mt-2 sm:flex sm:items-start sm:justify-between">
                            <div class="max-w-xl text-sm leading-5 text-gray-600">
                                <p>
                                    View your inspection reports here, including any attached documents such as oil reports.
                                </p>
                            </div>
                            <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                            <span class="inline-flex rounded-md shadow-sm">
                                <a href="" class="inline-flex items-center btn-indigo-lg">
                                    View Inspections
                                </a>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    </div>
</x-app-layout>

