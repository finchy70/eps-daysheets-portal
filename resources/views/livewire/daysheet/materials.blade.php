<div>
    <div class="px-8 py-4 bg-gray-200 border border-indigo-500 rounded-xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Edit Materials</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the materials allocated to this daysheet.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button type="button" wire:click="newMaterials" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Materials</button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Materials</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Qty</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Unit Cost</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0"></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($daysheet->materials as $material)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{$material->name}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$material->quantity}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$material->cost_per_unit}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">£ {{number_format(($material->quantity * $material->cost_per_unit), 2, thousands_separator: '')}}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 space-x-2">
                                    <button typeof="button" wire:click="delete({{$material->id}})" type="button" class="py-1 px-2 text-xs text-white bg-indigo-500 rounded-lg hover:text-indigo-900">Delete</button>
                                    <button type="button" wire:click="editMaterial({{$material->id}})" class="py-1 px-2 text-xs text-white bg-indigo-500 rounded-lg hover:text-indigo-900">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">Total</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">£ {{number_format($total, 2, thousands_separator: '')}}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 space-x-2">

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if($showNewMaterials)
        <form wire:submit.prevent="submit">
            <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 mx-auto max-w-xl">
                        <div class="transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all w-full">
                            <div>
                                <div class="text-center">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Materials</h3>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="materials" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Materials</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model.lazy="materials" type="text" name="materials" id="materials" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                    @error('materials')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>


                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Qty</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="quantity" type="number" step="0.01" name="quantity" id="quantity" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                    @error('quantity')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="costPerUnit" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Unit Cost</label>
                                <div class=" sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="costPerUnit" type="number" step="0.01" id="costPerUnit" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                    @error('costPerUnit')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="formattedGrandTotal" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Total</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="formattedGrandTotal" type="text" name="total" id="workDate" readonly class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 sm:mt-6 row-auto flex justify-center space-x-4">
                                <button wire:click="$set('showNewMaterials', false)" type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</button>
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    @endif

    @if($showEditMaterials)
        <form wire:submit.prevent="edit">
            <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 mx-auto max-w-xl">
                        <div class="transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all w-full">
                            <div>
                                <div class="text-center">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Materials</h3>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="editMaterials" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Materials</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model.lazy="editMaterials" type="text" name="editMaterials" id="editMaterials" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                    @error('editMaterials')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>


                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="editQuantity" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Qty</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="editQuantity" type="number" step="0.01" name="editQuantity" id="editQuantity" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                    @error('editQuantity')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="editCostPerUnit" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Unit Cost</label>
                                <div class=" sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="editCostPerUnit" type="number" step="0.01" id="editCostPerUnit" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                    @error('editCostPerUnit')<span class="text-xs text-red-500 italic">{{$message}}</span>@enderror
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                <label for="formattedGrandTotal" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Total</label>
                                <div class="sm:col-span-2 sm:mt-0">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input wire:model="formattedGrandTotal" type="text" name="formattedGrandTotal" id="formattedGrandTotal" readonly class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 sm:mt-6 row-auto flex justify-center space-x-4">
                                <button wire:click="$set('showEditMaterials', false)" type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</button>
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
