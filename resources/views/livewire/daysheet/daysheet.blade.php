{{--@php use function Symfony\Component\Translation\t; @endphp--}}
<div x-on:loa>
    @section('title', 'DaySheet')
    <div class="mt-4 mb-4 row flex justify-end max-w-4xl mx-auto">
        <a href="{{route('pdf.download', [$daysheet->id, encrypt($filename)])}}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
            Download PDF
        </a>
    </div>
    <div class="mx-auto max-w-4xl bg-white border-2 border-blue-900">
        <div class="p-2 row flex justify-between items-center border-black">
            <image src="{{asset('images/EPS new logo 100x50.png')}}"></image>
            <div class="text-xl">EPS Construction Limited - Job Report Sheet</div>
        </div>
        <div class="grid grid-cols-6">
            <div class="p-1 border-t border-r border-black text-center">Client Name</div>
            <div class="p-1 border-t border-black col-span-5">{{$daysheet->client->name}}</div>
            <div class="p-1 border-t border-r border-black text-center">Site Name</div>
            <div class="p-1 border-t border-r border-black col-span-2">{{$daysheet->site_name}}</div>
            <div class="p-1 border-t border-r border-black text-center">Job Number</div>
            <div class="p-1 border-t border-black col-span-2">{{$daysheet->job_number}}</div>
            <div class="p-1 border-t border-r border-black text-center">Mileage</div>
            <div class="p-1 border-t border-r border-black col-span-2">{{$daysheet->mileage}}</div>
            <div class="p-1 border-t border-r border-black text-center">Engineer</div>
            <div class="p-1 border-t border-black col-span-2">{{$daysheet->user->name}}</div>
            <div class="p-1 border-t border-r border-black text-center">Start Date</div>
            <div class="p-1 border-t border-r border-black col-span-2">{{Carbon\Carbon::parse($daysheet->start_date)->format('d-m-Y')}}</div>
            <div class="p-1 border-t border-r border-black text-center">Start Time</div>
            <div class="p-1 border-t border-black col-span-2">{{Carbon\Carbon::parse($daysheet->start_time)->format('H:i')}}</div>
            <div class="p-1 border-t border-r border-black text-center">Finish Date</div>
            <div class="p-1 border-t border-r border-black col-span-2">{{Carbon\Carbon::parse($daysheet->finish_date)->format('d-m-Y')}}</div>
            <div class="p-1 border-t border-r border-black text-center">Finish Time</div>
            <div class="p-1 border-t border-black col-span-2">{{Carbon\Carbon::parse($daysheet->finish_time)->format('H:i')}}</div>
            <div class="p-1 border-t border-b border-r border-black text-center bg-white col-span-1">Issue / Fault</div>
            <div class="p-1 border-t border-b border-black text-left bg-white col-span-5">{{$daysheet->issue_fault}}</div>
            <div class="p-1 border-b border-r border-black text-center bg-white col-span-1">Resolution</div>
            <div class="p-1 border-b border-black text-left bg-white col-span-5">{{$daysheet->resolution}}</div>
            <div class="p-1 border-r border-b border-black bg-green-100 col-span-2">Name</div>
            <div class="p-1 border-r border-b border-black bg-green-100 col-span-1">Role</div>
            <div class="p-1 border-r border-b border-black bg-green-100 col-span-1">Rate</div>
            <div class="p-1 border-r border-b border-black bg-green-100 col-span-1">Hours</div>
            <div class="p-1 border-b border-black bg-green-100 col-span-1">Cost</div>
            @foreach($daysheet->engineers as $engineer)
                <div class="border-r border-b border-black col-span-2 pl-1">{{$engineer->name}}</div>
                <div class="border-r border-b border-black col-span-1  pl-1">{{$engineer->role->role}}</div>
                <div class="border-r border-b border-black col-span-1 text-right pr-1"><span class="mr-1">£</span>{{number_format($engineer->rate, 2, thousands_separator: ',')}}</div>
                <div class="border-r border-b border-black col-span-1 text-right pr-1">{{substr($engineer->hours,0, -3)}}</div>
                <div class="border-b border-black col-span-1 text-right pr-1">{{'£ '.number_format($engineer->hours_as_fraction * $engineer->rate, 2, thousands_separator: ',')}}</div>

            @endforeach

            <div class="p-1 border-r border-b border-black col-span-5 bg-white text-right">Labour Total</div>
            <div class="p-1 border-b border-black col-span-1 text-right">{{'£ '.number_format($engineerTotal, 2, thousands_separator: ',')}}</div>
            <div class="p-1 border-r border-b border-black col-span-4 text-right bg-blue-100"></div>
            <div class="p-1 border-r border-b border-black col-span-1 text-right bg-blue-100">On Cost 0%</div>
            <div class="p-1 border-b border-black col-span-1 bg-blue-100 text-right">£ 0.00</div>
            <div class="p-1 border-r border-black col-span-5 bg-blue-200 text-right">Cost of Labour</div>
            <div class="p-1 border-black col-span-1 bg-blue-200 text-right">{{'£ '.number_format($engineerTotal, 2, thousands_separator: ',')}}</div>


            <div class="p-1 border-t border-b border-black text-center bg-green-100 col-span-6">Materials / Consumables</div>

            <div class="p-1 border-b border-r border-black bg-green-100 col-span-3">Item</div>
            <div class="p-1 border-b border-r border-black bg-green-100 col-span-1">Unit Cost</div>
            <div class="p-1 border-b border-r border-black bg-green-100 col-span-1">Qty</div>
            <div class="p-1 border-b border-black bg-green-100 col-span-1">Cost</div>
            @foreach($daysheet->materials as $material)
                <div class="p-1 border-b border-r border-black col-span-3">{{$material->name}}</div>
                <div class="p-1 border-b border-r border-black col-span-1">{{'£ '.number_format($material->cost_per_unit , 2, thousands_separator: ',')}}</div>
                <div class="p-1 border-b border-r border-black col-span-1">{{$material->quantity}}</div>
                <div class="p-1 border-b border-black col-span-1 text-right">{{'£ '.number_format((floatval($material->cost_per_unit) * floatval($material->quantity)), 2, thousands_separator: ',')}}</div>
            @endforeach

            <div class="p-1 border-r border-b border-black col-span-5 bg-white text-right">Materials / Consumables Total</div>
            <div class="p-1 border-b border-black col-span-1 text-right">{{'£ '.number_format($materialTotal, 2, thousands_separator: ',')}}</div>
            <div class="p-1 border-r border-b border-black col-span-4 text-right bg-blue-100"></div>
            <div class="p-1 border-r border-b border-black col-span-1 bg-blue-100 text-right">On Cost {{$markupRate}}%</div>
            <div class="p-1 border-b border-black col-span-1 bg-blue-100 text-right">{{'£ '.number_format($materialTotal * ($markupRate/100), 2, thousands_separator: ',')}}</div>
            <div class="p-1 border-b border-r border-black col-span-5 bg-blue-200 text-right">Cost of Materials / Consumables</div>
            <div class="p-1 border-b border-black col-span-1 bg-blue-200 text-right">{{'£ '.number_format($materialTotal + ($materialTotal * ($markupRate/100)), 2, thousands_separator: ',')}}</div>

            <div class="p-1 border-t border-b border-black text-center bg-green-100 col-span-6">Plant / Transport / Accommodation</div>
            <div class="p-1 border-b border-r border-black col-span-3 bg-green-100">Name</div>
            <div class="p-1 border-b border-r border-black col-span-1 bg-green-100">Unit Cost</div>
            <div class="p-1 border-b border-r border-black col-span-1 bg-green-100">Qty</div>
            <div class="p-1 border-b border-black col-span-1 text-right bg-green-100">Cost</div>
            <div class="p-1 border-b border-r border-black col-span-3">Mileage</div>
            <div class="p-1 border-b border-r border-black col-span-1">{{'£ '.number_format($mileageRate, 2, thousands_separator: ',')}}</div>
            <div class="p-1 border-b border-r border-black col-span-1">{{$daysheet->mileage}}</div>
            <div class="p-1 border-b border-black col-span-1 text-right">{{'£ '.number_format($mileageTotal, 2, thousands_separator: ',')}}</div>
            @foreach($daysheet->hotels as $hotel)
                <div class="p-1 border-b border-r border-black col-span-3">{{$hotel->name}}</div>
                <div class="p-1 border-b border-r border-black col-span-1">{{'£ '.number_format($hotel->cost_per_unit, 2, thousands_separator: ',')}}</div>
                <div class="p-1 border-b border-r border-black col-span-1">{{$hotel->quantity}}</div>
                <div class="p-1 border-b border-black col-span-1 text-right">{{'£ '.number_format($hotel->cost_per_unit * $hotel->quantity, 2, thousands_separator: ',')}}</div>
            @endforeach
            <div class="p-1 border-r border-b border-black col-span-5 bg-white text-right">Plant / Transport / Accommodation Total</div>
            <div class="p-1 border-b border-black col-span-1 text-right">{{'£ '.number_format($hotelTotal + $mileageTotal, 2, thousands_separator: ',')}}</div>
            <div class="p-1 border-r border-b border-black col-span-4 text-right bg-blue-100"></div>
            <div class="p-1 border-r border-b border-black col-span-1 bg-blue-100 text-right">On Cost 0%</div>
            <div class="p-1 border-b border-black col-span-1 bg-blue-100 text-right">£ 0.00</div>
            <div class="p-1 border-b border-r border-black col-span-5 bg-blue-200 text-right">Cost of Plant / Transport / Accommodation</div>
            <div class="p-1 border-b border-black col-span-1 bg-blue-200 text-right">{{'£ '.number_format($hotelTotal + $mileageTotal, 2, thousands_separator: ',')}}</div>

            <div class="p-1 border-t border-b border-black text-center bg-green-100 col-span-6">Grand Total</div>
            <div class="p-1 border-b border-r border-black col-span-5 bg-white text-right">Grand Total ex VAT</div>
            <div class="p-1 border-b border-black col-span-1 bg-white text-right">{{'£ '.number_format($engineerTotal + $hotelTotal + $mileageTotal + $materialTotal + ($materialTotal * ($markupRate/100)), 2)}}</div>
            <div class="p-1 border-b border-r border-black col-span-5 bg-blue-100 text-right">Vat 20%</div>
            <div class="p-1 border-b border-black col-span-1 bg-blue-100 text-right">{{'£ '.number_format(($engineerTotal + $hotelTotal  + $mileageTotal + $materialTotal + ($materialTotal * ($markupRate/100))) * 0.2, 2, thousands_separator: ',')}}</div>
            <div class="p-1 border-b border-r border-black col-span-5 bg-blue-300 text-right">Grand Total inc Vat</div>
            <div class="p-1 border-b border-black col-span-1 bg-blue-300 text-right">{{'£ '.number_format(($engineerTotal + $hotelTotal + $mileageTotal + $materialTotal + ($materialTotal * ($markupRate/100))) * 1.2, 2, thousands_separator: ',')}}</div>
        </div>
        <div class="grid grid-cols-5">
            <div class="text-center col-span-2 text-xs border-r border-black">Name for EPS Construction Limited</div>
            <div class="text-center col-span-2 text-xs border-r border-black">Signed for EPS Construction Limited</div>
            <div class="text-center col-span-1 text-xs border-black">Date</div>
            <div class="p-1 text-center col-span-2 text-sm border-t border-r border-black flex justify-center items-center" style="height: 75px">{{$daysheet->user->name}}</div>
            <div class="p-1 text-center col-span-2 text-sm border-t border-r border-black flex justify-center items-center">{{$daysheet->user->name}}</div>
            <div class="p-1 text-center col-span-1 text-sm border-t border-black flex justify-center items-center">{{Carbon\Carbon::parse($daysheet->finish_date)->format('d-m-Y')}}</div>
            <div class="text-center col-span-2 text-xs border-r border-t border-black">Name for Client</div>
            <div class="text-center col-span-2 text-xs border-r border-t border-black">Signed for Client</div>
            <div class="text-center col-span-1 text-xs border-t border-black">Date</div>
            @if($daysheet->representative == null)
                <div class="p-4 text-center col-span-2 text-sm border-t border-r border-black"></div>
                <div class="p-4 text-center col-span-2 text-sm border-t border-r border-black"></div>
                <div class="p-4 text-center col-span-1 text-sm border-t border-black"></div>
            @else
                <div class="p-1 col-span-2 text-sm border-t border-r border-black flex justify-center items-center" style="height: 75px">{{$daysheet->representative}}</div>
                @if($filename != null)
                    <div class="col-span-2 text-sm border-t border-r border-black row flex justify-center items-center"><img src="{{asset('storage/'.$filename)}}" alt="Signature"></div>
                @else
                    <div class="col-span-2 text-sm border-t border-r border-black row flex justify-center items-center"></div>
                @endif
                <div class="p-1 text-center col-span-1 text-sm border-t border-black flex justify-center items-center">{{Carbon\Carbon::parse($daysheet->finish_date)->format('d-m-Y')}}</div>
            @endif

        </div>
    </div>
    <div class="mt-4 mb-2 row flex justify-end max-w-4xl mx-auto">
        @if(auth()->user()->client_id != null)
            @if(!$daysheet->client_confirmed)
                <button type="button" onclick="return confirm('Are you sure you want to confirm this daysheet?')" wire:click="confirmDaysheet({{$daysheet->id}})" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                    Authorise Daysheet
                </button>
            @else
                <button type="button" disabled class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-200 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                    Daysheet Authorised
                </button>
            @endif
        @endif
        <a href="{{route('daysheet.index')}}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
            Return to Daysheet Index
        </a>
    </div>
</div>
@script
document.addEventListener('alpine:initialized', () => {
//
})
