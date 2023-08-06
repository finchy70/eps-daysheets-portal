@section('title', 'API Admin')

<x-app-layout>

    <!--
  Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
  Read the documentation to get started: https://tailwindui.com/documentation
-->
{{--    <div class="bg-white shadow sm:rounded-lg">--}}
{{--        <div class="px-4 py-5 sm:p-6">--}}
{{--            <h3 class="text-lg leading-6 font-medium text-gray-900">--}}
{{--                Allocate API tokens to Users--}}
{{--            </h3>--}}
{{--            <div class="mt-2 sm:flex sm:items-start sm:justify-between">--}}
{{--                <div class="max-w-xl text-sm leading-5 text-gray-500">--}}
{{--                    <p>--}}
{{--                        Allow users access to EPS Inspect api for syncing data with mobile dewvices.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">--}}
{{--        <span class="inline-flex rounded-md shadow-sm">--}}
{{--          <a href="{{route('api_admin.manage')}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">--}}
{{--            Allocate Tokens--}}
{{--          </a>--}}
{{--        </span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="max-w-5xl mx-auto bg-white shadow sm:rounded-lg mt-8">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Manage allocated Tokens
            </h3>
            <div class="mt-2 sm:flex sm:items-start sm:justify-between">
                <div class="max-w-xl text-sm leading-5 text-gray-500">
                    <p>
                        View and revoke user API Tokens
                    </p>
                </div>
                <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
        <span class="inline-flex rounded-md shadow-sm">
          <a href="{{route('api_admin.manage')}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
            Manage API's
          </a>
        </span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>>
