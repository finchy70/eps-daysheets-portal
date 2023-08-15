<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Remittance Advice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/my.css')}}" >
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}" >
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="mt-4 text-sm">

            <div class="row flex-row border border-dark p-1">
                <div class="col">
                    <img style="padding-bottom: 2px; width:150px; height:75px;" src="{{asset('/images/EPS new logo 300x150.png')}}"
                         alt="EPS Logo">
                </div>
                <div class="col text-left">
                    <h5>EPS Construction Limited - Job Report Sheet</h5>
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-2 border-right border-dark">
                    Client Name
                </div>
                <div class="col-4 text-left border-right border-dark">
                    {{$daysheet->client->name}}
                </div>
                <div class="col-2 border-right border-dark">
                    Site Name
                </div>
                <div class="col-4 text-left border-dark">
                    {{$daysheet->site_name}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-2 border-right border-dark">
                    Job Number
                </div>
                <div class="col-4 text-left border-right border-dark">
                    {{$daysheet->job_number}}
                </div>
                <div class="col-2 border-right border-dark">
                    Mileage
                </div>
                <div class="col-4 text-left border-dark">
                    {{$daysheet->mileage}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-2 border-right border-dark">
                    Engineer
                </div>
                <div class="col-4 text-left border-right border-dark">
                    {{$daysheet->user->name}}
                </div>
                <div class="col-2 border-right border-dark">
                    Date
                </div>
                <div class="col-4 text-left">
                    {{Carbon\Carbon::parse($daysheet->work_date)->format('d-m-Y')}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-2 border-right border-dark">
                    Start Time
                </div>
                <div class="col-4 text-left border-right border-dark">
                    {{Carbon\Carbon::parse($daysheet->start_time)->format('H:i')}}
                </div>
                <div class="col-2 border-right border-dark">
                    Finish Time
                </div>
                <div class="col-4 text-left">
                    {{Carbon\Carbon::parse($daysheet->finish_time)->format('H:i')}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-2 border-right border-dark">
                    Issue / Fault
                </div>
                <div class="col-10 text-left">
                    {{$daysheet->issue_fault}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-2 border-right border-dark">
                    Resolution
                </div>
                <div class="col-10 text-left ">
                    {{$daysheet->resolution}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-4 border-right border-dark">
                    Name
                </div>
                <div class="col-2 border-right border-dark">
                    Role
                </div>
                <div class="col-2 border-right border-dark">
                    Rate
                </div>
                <div class="col-2 border-right border-dark">
                    Hours
                </div>
                <div class="col-2 border-dark">
                    Cost
                </div>
            </div>


            @foreach($daysheet->engineers as $engineer)
                <div class="row flex-row border-bottom border-right border-left border-dark">
                    <div class="col-4 border-right border-dark">
                        {{$engineer->name}}
                    </div>
                    <div class="col-2 border-right border-dark">
                        {{$engineer->role}}
                    </div>
                    <div class="col-2 border-right border-dark">
                        {{$engineer->rate}}
                    </div>
                    <div class="col-2 border-right border-dark">
                        {{$engineer->hours}}
                    </div>
                    <div class="col-2 text-right">
                        {{'£ '.number_format($engineer->rate * $engineer->hours_as_fraction, 2, thousands_separator: ',')}}
                    </div>
                </div>

            @endforeach

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-8 border-right border-dark">

                </div>
                <div class="col-2 border-right border-dark text-left">
                    VAT 20%
                </div>
                <div class="col-2 text-right">
                    {{'£ '.number_format(($engineerTotal * 0.2), 2, thousands_separator: ',')}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-10 border-right border-dark text-left">
                    Total with VAT
                </div>
                <div class="col-2 text-right">
                    {{'£ '.number_format(($engineerTotal * 1.2), 2, thousands_separator: ',')}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-12 border-dark text-center">
                    Materials / Plant
                </div>
            </div>
            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-6 border-right border-dark">
                    Item
                </div>
                <div class="col-2 border-right border-dark">
                    Unit Cost
                </div>
                <div class="col-2 border-right border-dark">
                    Qty
                </div>
                <div class="col-2">
                    Cost
                </div>
            </div>

            @foreach($daysheet->materials as $material)
                <div class="row flex-row border-bottom border-right border-left border-dark">
                    <div class="col-6 border-right border-dark">
                        {{$material->name}}
                    </div>
                    <div class="col-2 border-right border-dark">
                        {{$material->cost_per_unit}}
                    </div>
                    <div class="col-2 border-right border-dark">
                        {{$material->quantity}}
                    </div>
                    <div class="col-2 text-right">
                        {{'£ '.number_format($material->cost_per_unit * $material->quantity, 2, thousands_separator: ',')}}
                    </div>
                </div>
            @endforeach

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-10 border-right border-dark text-left">
                    VAT 20%
                </div>
                <div class="col-2 text-right">
                    {{'£ '.number_format(($materialTotal * 0.2), 2, thousands_separator: ',')}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-10 border-right border-dark text-left">
                    Total with VAT
                </div>
                <div class="col-2 text-right">
                    {{'£ '.number_format(($materialTotal * 1.2), 2, thousands_separator: ',')}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-10 border-right border-dark text-left">
                    Grand Total
                </div>
                <div class="col-2 text-right">
                    {{'£ '.number_format(($materialTotal * 1.2) + ($engineerTotal * 1.2), 2, thousands_separator: ',')}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-5 text-center border-right border-dark">
                    Name for EPS Construction Limited
                </div>
                <div class="col-5 border-right border-dark text-center">
                    Signed for EPS Construction Limited
                </div>
                <div class="col-2 text-center">
                    Date
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-5 border-right border-dark text-center">
                    {{auth()->user()->name}}
                </div>
                <div class="col-5 border-right border-dark text-center">
                    {{auth()->user()->name}}
                </div>
                <div class="col-2 border-dark text-center">
                    {{$daysheet->work_date->format('d-m-Y')}}
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-5 border-right border-dark text-center">
                    Name for Client
                </div>
                <div class="col-5 border-right border-dark text-center">
                    Signed for Client
                </div>
                <div class="col-2 border-right text-center">
                    Date
                </div>
            </div>

            <div class="row flex-row border-bottom border-right border-left border-dark">
                <div class="col-5 border-right border-dark text-center text-white">
                    placeholder
                </div>
                <div class="col-5 border-right border-dark text-center">

                </div>
                <div class="col-2 text-center">

                </div>
            </div>
        </div>
    </div>



</body>
</html>
