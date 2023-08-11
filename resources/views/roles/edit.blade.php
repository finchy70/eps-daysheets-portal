<x-app-layout>
    <div>
        <div class="mt-8 row flex justify-center text-2xl">Edit Role</div>
        <form action="{{route('roles.update', $role)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mt-8 max-w-2xl mx-auto border border-indigo-500 rounded-lg p-4 bg-white">
                <label for="name" class="block text-sm font-medium leading-5 text-gray-700">New Role</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input id="name" name="role" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{$role->role}}"/>
                </div>
                @error('role') <span class="text-xs text-red-600 italic">{{$message}}</span> @enderror

                <label for="name" class="mt-4 block text-sm font-medium leading-5 text-gray-700">Rate</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input type="number" step="0.01" name="rate" id="rate" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{$role->rate}}"/>
                </div>
                @error('rate') <span class="text-xs text-red-600 italic">{{$message}}</span> @enderror

                <div class="row justify-end flex">
                    <button type="submit" class="mt-8 justify-end inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">Update</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
