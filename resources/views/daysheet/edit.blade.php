@php use Carbon\Carbon; @endphp
<x-app-layout>
    <div class="my-8 px-6 py-4 max-w-4xl mx-auto border border-indigo-600 focus:ring-gray-500 rounded-lg overflow-hidden bg-gray-50">
        <h2 class="mb-6 text-2xl font-semibold leading-7 text-gray-900">Edit Daysheet</h2>
        <form class="space-y-4">

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="selectedClient" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Client Name</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <select name="selectedClient" id="selectedClient" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                @foreach($clients as $client)
                                    <option {{$client->id == $daysheet->client_id ? 'selected' : ''}} value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                <label for="site" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Site</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="text" name="site" id="site" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="{{$daysheet->site_name}}">
                        </div>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="jobNumber" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Job Number</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="text" name="jobNumber" id="jobNumber" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="{{$daysheet->job_number}}">
                        </div>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="weekEndingDate" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Week Ending Date</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="date" name="weekEndingDate" id="weekEndingDate" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="{{Carbon::parse($daysheet->week_ending)->format('Y-m-d')}}">
                        </div>
                    </div>
                </div>


                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="workDate" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Work Date</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="date" name="workDate" id="workDate" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="{{Carbon::parse($daysheet->work_date)->format('Y-m-d')}}">
                        </div>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="startTime" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Start Time</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="time" name="startTime" id="startTime" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="{{$daysheet->start_time}}">
                        </div>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="finishTime" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Finish Time</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="time" name="finishTime" id="finishTime" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="{{$daysheet->finish_time}}">
                        </div>
                    </div>
                </div>


                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="issueFault" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Issue / Fault</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <textarea id="issueFault" name="issueFault" rows="3" class="block w-full max-w-2xl rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{$daysheet->issue_fault}}</textarea>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="resolution" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Resolution</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <textarea id="resolution" name="resolution" rows="3" class="block w-full max-w-2xl rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{$daysheet->resolution}}</textarea>
                    </div>
                </div>

                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
                    <label for="mileage" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Mileage</label>
                    <div class="mt-2 sm:col-span-2 sm:mt-0">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="number" step="1" name="mileage" id="mileage" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="{{$daysheet->mileage}}">
                        </div>
                    </div>
                </div>

                <div>
                    <livewire:daysheet.materials :daysheetId="$daysheet->id"/>
                </div>

                <div class="mt-6 mb-2 flex items-center justify-end gap-x-6">
                    <button type="button" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</button>
                    <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                </div>

        </form>



    </div>


</x-app-layout>
