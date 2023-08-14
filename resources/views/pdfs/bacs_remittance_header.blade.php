
    <div class="p-2 row flex-row border border-dark">
        <div class="col">
            <img style="padding-bottom: 2px; width:150px; height:75px;" src="{{asset('/images/EPS new logo 300x150.png')}}"
                              alt="EPS Logo">
        </div>
        <div class="col text-right">
            <h4>EPS Construction Limited - Job Report Sheet</h4>
        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-2 border border-dark">
            <h5>Client Name</h5>
        </div>
        <div class="p-2 col-4 text-right border border-dark">

        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Site Name</h5>
        </div>
        <div class="p-2 col-4 text-right border border-dark">

        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-2 border border-dark">
            <h5>Job Number</h5>
        </div>
        <div class="p-2 col-4 text-right border border-dark">

        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Mileage</h5>
        </div>
        <div class="p-2 col-4 text-right border border-dark">

        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-2 border border-dark">
            <h5>Engineer</h5>
        </div>
        <div class="p-2 col-4 text-right border border-dark">

        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Date</h5>
        </div>
        <div class="p-2 col-4 text-right border border-dark">

        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-2 border border-dark">
            <h5>Start Time</h5>
        </div>
        <div class="p-2 col-4 text-right border border-dark">

        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Finish Time</h5>
        </div>
        <div class="p-2 col-4 text-right border border-dark">

        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-2 border border-dark">
            <h5>Issue / Fault</h5>
        </div>
        <div class="p-2 col-10 text-right border border-dark">

        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-2 border border-dark">
            <h5>Resolution</h5>
        </div>
        <div class="p-2 col-10 text-right border border-dark">

        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-4 border border-dark">
            <h5>Name</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Role</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Rate</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Hours</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Cost</h5>
        </div>
    </div>

    {{-- foreach for engineers here --}}
{{--    @foreach($engineers as $engineer)--}}
{{--        <div class="p-2 col-4 border border-dark">--}}
{{--            <h5>{{$engineer->name}}</h5>--}}
{{--        </div>--}}
{{--        <div class="p-2 col-2 border border-dark">--}}
{{--            <h5>{{$engineer->role}}</h5>--}}
{{--        </div>--}}
{{--        <div class="p-2 col-2 border border-dark">--}}
{{--            <h5>{{$engineer->rate}}</h5>--}}
{{--        </div>--}}
{{--        <div class="p-2 col-2 border border-dark">--}}
{{--            <h5>{{$engineer->hours}}</h5>--}}
{{--        </div>--}}
{{--        <div class="p-2 col-2 border border-dark">--}}
{{--            <h5>{{'£ '.number_format($engineer->rate * $engineer->hours_as_fraction, 2, thousands_separator: ',')}}</h5>--}}
{{--        </div>--}}

{{--    @endforeach--}}

    <div class="row flex-row border border-dark">
        <div class="p-2 col-8 border border-dark">

        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>VAT 20%</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5></h5>
        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-10 border border-dark text-right">
            <h5>Total with VAT</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5></h5>
        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-12 border border-dark text-center">
            <h5>Materials / Plant</h5>
        </div>
    </div>
    <div class="row flex-row border border-dark">
        <div class="p-2 col-6 border border-dark">
            <h5>Item</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Unit Cost</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Qty</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>Cost</h5>
        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-8 border border-dark">

        </div>
        <div class="p-2 col-2 border border-dark">
            <h5>VAT 20%</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5></h5>
        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-10 border border-dark text-right">
            <h5>Total with VAT</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5></h5>
        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-10 border border-dark text-right">
            <h5>Grand Total</h5>
        </div>
        <div class="p-2 col-2 border border-dark">
            <h5></h5>
        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-5 border border-dark text-center">
            Name for EPS Construction Limited
        </div>
        <div class="p-2 col-5 border border-dark text-center">
            Signed for EPS Construction Limited
        </div>
        <div class="p-2 col-2 border border-dark text-center">
            Date
        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-5 border border-dark text-center">

        </div>
        <div class="p-2 col-5 border border-dark text-center">

        </div>
        <div class="p-2 col-2 border border-dark text-center">
            {{today()->format('d-m-Y')}}
        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-5 border border-dark text-center">
            Name for Client
        </div>
        <div class="p-2 col-5 border border-dark text-center">
            Signed for Client
        </div>
        <div class="p-2 col-2 border border-dark text-center">
            Date
        </div>
    </div>

    <div class="row flex-row border border-dark">
        <div class="p-2 col-5 border border-dark text-center">

        </div>
        <div class="p-2 col-5 border border-dark text-center">

        </div>
        <div class="p-2 col-2 border border-dark text-center">
            {{today()->format('d-m-Y')}}
        </div>
    </div>



