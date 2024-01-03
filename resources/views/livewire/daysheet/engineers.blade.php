<div>
    <div class="px-8 py-4 bg-gray-200 border border-indigo-500 rounded-xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Edit Engineers</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all engineers allocated to this daysheet.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" wire:click="newEngineer" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Engineer</button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Rate</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Hours</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0"></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($daysheet->engineers as $engineer)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{$engineer->name}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$engineer->role}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{'£ '. number_format($engineer->rate, 2 ,thousands_separator: ',')}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{substr($engineer->hours, 0, -3)}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">£ {{number_format(($engineer->rate * $engineer->hours_as_fraction), 2, thousands_separator: '')}}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 space-x-2">
                                    <button wire:click="delete({{$engineer->id}})" type="button" class="py-1 px-2 text-xs text-white bg-indigo-500 rounded-lg hover:text-indigo-900">Delete</button>
                                    <button wire:click="editEngineer({{$engineer->id}})" type="button" class="py-1 px-2 text-xs text-white bg-indigo-500 rounded-lg hover:text-indigo-900">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">Total</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">£ {{number_format($total, 2, thousands_separator: '')}}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 space-x-2">

                            </td>
                        </tr>


                        <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if($showEditEngineer)
        <form wire:submit.prevent="update">
            <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 mx-auto max-w-xl">
                        <div class="transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all w-full">
                            <div>
                                <div class="text-center">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Edit Engineer</h3>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="editName" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Name</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model.lazy="editName" type="text" name="editName" id="editName" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                    @error('editName')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>


                            <div>
                                <div class="w-full row flex justify-center">
                                    <div class="row flex">
                                        <label for="editHours" class="text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Hours</label>
                                        <div class="row flex">
                                            <div class="ml-2 flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <input wire:model="editHours" id='editHours' type="number" step="1" name="editHours" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex">
                                        <label for="editMinutes" class="ml-8 text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Minutes</label>
                                        <div class="row flex">
                                            <div class="ml-2 flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                <select wire:model="editMinutes" id='editMinutes' name="editMinutes" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                                    <option value="00">00</option>
                                                    <option value="15">15</option>
                                                    <option value="30">30</option>
                                                    <option value="45">45</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="selectedRole" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Role</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <select wire:model="selectedRole" name="selectedRole" id="selectedRole" class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->role}}</option>
                                        @endforeach
                                    </select>
                                    @error('costPerUnit')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="editFormattedRate" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Rate</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="editFormattedRate" readonly type="text" name="editFormattedRate" id="editFormattedRate" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="editTotal" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Total</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="editTotal" type="text" name="editTotal" id="editTotal" readonly class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 sm:mt-6 row-auto flex justify-center space-x-4">
                                <button wire:click="$set('showEditEngineer', false)" type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</button>
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    @endif

    @if($showNewEngineer)
        <form wire:submit.prevent="create">
            <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 mx-auto max-w-xl">
                        <div class="transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all w-full">
                            <div>
                                <div class="text-center">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">New Engineer</h3>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Name</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model.lazy="name" type="text" name="name" id="name" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                    @error('name')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>


                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="hours" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Hours</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="hours" type="time" name="hours" id="hours" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                    @error('hours')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="newSelectedRole" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Role</label>
                                <div class=" sm:col-span-2 sm:mt-0">
                                    <select wire:model="newSelectedRole" name="newSelectedRole" id="newSelectedRole" class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->role}}</option>
                                        @endforeach
                                    </select>
                                    @error('newSelected')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="newFormattedRate" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Rate</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="newFormattedRate" readonly type="text" name="editFormattedRate" id="editFormattedRate" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="editTotal" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Total</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="newTotal" type="text" name="editTotal" id="editTotal" readonly class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 sm:mt-6 row-auto flex justify-center space-x-4">
                                <button wire:click="$set('showNewEngineer', false)" type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</button>
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    @endif

    @if($showDeleteModal)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 mx-auto max-w-xl">
                    <div class="transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all w-full">
                        <div>
                            <div class="text-center">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Are you sure you want to delete the Engineer?</h3>
                            </div>
                        </div>

                        <div class="mt-5 sm:mt-6 row-auto flex justify-center space-x-4">
                            <button wire:click="$set('showDeleteModal', false)" type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</button>
                            <button type="button" wire:click="confirmedDelete" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


</div>
