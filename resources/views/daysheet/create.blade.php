@php use Carbon\Carbon; @endphp
@section('title', 'Edit Daysheet')
<x-app-layout>
    <div class="my-8 px-6 py-4 max-w-4xl mx-auto border border-indigo-600 focus:ring-gray-500 rounded-lg overflow-hidden bg-gray-50">
        <h2 class="mb-2 text-2xl font-semibold leading-7 text-gray-900">Create Daysheet</h2>
        <h2 class="mb-6 text-sm italic font-semibold leading-7 text-red-500">To add materials and engineers save this daysheet then add them via the edit option.</h2>
        <form class="space-y-4" method="POST" action="{{route('daysheet.store')}}">
            @csrf
            <div class="space-y-4">
                <div class="sm:grid sm:grid-cols-3 sm:items-start">
                    <label for="selectedClient" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Client Name</label>
                    <div class="sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <select name="selectedClient" id="selectedClient" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start">
                    <label for="site" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Site</label>
                    <div class="sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="text" name="site" id="site" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                        </div>
                        @error('site')<span class="text-red-500 italic text-xs">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start ">
                    <label for="jobNumber" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Job Number</label>
                    <div class="sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="text" name="jobNumber" id="jobNumber" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                        </div>
                        @error('jobNumber')<span class="text-red-500 italic text-xs">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start">
                    <label for="startDate" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Start Date</label>
                    <div class="sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="date" name="startDate" id="startDate" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                        </div>
                        @error('startDate')<span class="text-red-500 italic text-xs">{{$message}}</span>@enderror

                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start">
                    <label for="startTime" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Start Time</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="time" name="startTime" id="startTime" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                        </div>
                        @error('startTime')<span class="text-red-500 italic text-xs">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start">
                    <label for="finishDate" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Finish Date</label>
                    <div class="sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="date" name="finishDate" id="finishDate" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                        </div>
                        @error('finishDate')<span class="text-red-500 italic text-xs">{{$message}}</span>@enderror

                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start">
                    <label for="finishTime" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Finish Time</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="time" name="finishTime" id="finishTime" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                        </div>
                        @error('finishTime')<span class="text-red-500 italic text-xs">{{$message}}</span>@enderror
                    </div>
                </div>


                <div class="sm:grid sm:grid-cols-3 sm:items-start">
                    <label for="issueFault" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Issue / Fault</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <textarea id="issueFault" name="issueFault" rows="3" class="block w-full max-w-2xl rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        @error('issueFault')<span class="text-red-500 italic text-xs">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start">
                    <label for="resolution" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Resolution</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <textarea id="resolution" name="resolution" rows="3" class="block w-full max-w-2xl rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        @error('resolution')<span class="text-red-500 italic text-xs">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start">
                    <label for="mileage" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Mileage</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="number" step="1" name="mileage" id="mileage" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" >
                        </div>
                        @error('mileage')<span class="text-red-500 italic text-xs">{{$message}}</span>@enderror
                    </div>
                </div>
            </div>


            <div class="mt-6 mb-2 flex items-center justify-end gap-x-6">
                <a href="{{route('daysheet.index')}}" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</a>
                <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>


        </form>
    </div>
</x-app-layout>
