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
        <div class="mt-4">

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
        </div>
    </div>



</body>
</html>
