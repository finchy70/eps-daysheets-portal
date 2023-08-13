<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .page-break {
            page-break-after: always;
        }
    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EPS Maintenance inspections')}} | Inspection </title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>

<body>
<div class="row text-right" style="font-size: xx-small; margin-right: 50px">

</div>
<div class="row text-right" style="font-size: xx-small; margin-right: 50px">
    Inspected:
</div>
<h3><strong>Batteries</strong></h3>
<hr>
@if($inspection->batteries->count() > 0)
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Tripping Voltage</th>
            <th>Output Voltage</th>
            <th>Battery Voltage</th>
            <th>Manufacturer</th>
            <th>Install Date</th>
            <th>Temp</th>
        </tr>
        </thead>
        <tbody>
            @foreach($inspection->batteries as $battery)
                <tr>
                    <td>{{$battery->name}}</td>
                    <td>{{$battery->tripping_voltage}}</td>
                    <td>{{$battery->output_voltage}}</td>
                    <td>{{$battery->battery_voltage}}</td>
                    <td>{{$battery->battery_make}}</td>
                    <td>{{$battery->install_date}}</td>
                    <td>{{$battery->temperature}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    No Data Present
@endif
<div class="page-break"></div>
<div class="row text-right" style="font-size: xx-small; margin-right: 50px">
    EPS-{{$inspection->job_number}}-{{$inspection->site}}-{{$inspection->client->client}}
</div>
<div class="row text-right" style="font-size: xx-small; margin-right: 50px">
    Inspected: {{$inspection->checked_on}}
</div>
<h3><strong>Battery Cells</strong></h3>
<hr>
@if($inspection->battery_cells->count() > 0)
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Battery</th>
            <th>Cell</th>
            <th>Cell Voltage</th>
            <th>mOhm</th>
        </tr>
        </thead>
        <tbody>
            @foreach($inspection->battery_cells as $cell)
                <tr>
                    <td>{{$cell->battery}}</td>
                    <td>{{$cell->cell_number}}</td>
                    <td>{{$cell->cell_voltage}}</td>
                    <td>{{$cell->mohm}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
@else
    No Data Present
@endif
<div class="page-break"></div>
<div class="row text-right" style="font-size: xx-small; margin-right: 50px">
    EPS-{{$inspection->job_number}}-{{$inspection->site}}-{{$inspection->client->client}}
</div>
<div class="row text-right" style="font-size: xx-small; margin-right: 50px">
    Inspected: {{$inspection->checked_on}}
</div>
<h3><strong>Transformers</strong></h3>
<hr>

@if($inspection->transformers->count() > 0)
    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Manufacturer</th>
            <th>Year</th>
            <th>Conservator</th>
            <th>Insulation</th>
            <th>TAP Changer Pos</th>
            <th>Breather</th>
            <th>Rating (kVA)</th>
            <th>Oil Volume</th>
            <th>Pri Voltage</th>
            <th>Sec Voltage</th>
            <th>Sited</th>
            <th>Serial</th>
        </tr>
        </thead>
        <tbody>
            @foreach($inspection->transformers as $tx)
                <tr>
                    <td>{{$tx->name}}</td>
                    <td>{{$tx->manufacturer}}</td>
                    <td>{{$tx->year}}</td>
                    <td>{{$tx->conservator}}</td>
                    <td>{{$tx->insulate_props}}</td>
                    <td>{{$tx->tap_changer_pos}}</td>
                    <td>{{$tx->breather}}</td>
                    <td>{{$tx->rating_kva}}</td>
                    <td>{{$tx->oil_vol}}</td>
                    <td>{{$tx->prim_voltage}}</td>
                    <td>{{$tx->sec_voltage}}</td>
                    <td>{{$tx->sited}}</td>
                    <td>{{$tx->tx_serial}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
@else
    No Data Present
@endif
<div class="page-break"></div>
<div class="row text-right" style="font-size: xx-small; margin-right: 50px">
    EPS-{{$inspection->job_number}}-{{$inspection->site}}-{{$inspection->client->client}}
</div>
<div class="row text-right" style="font-size: xx-small; margin-right: 50px">
    Inspected: {{$inspection->checked_on}}
</div>
<h3><strong>Switchgear</strong></h3>
<hr>
@if($inspection->switchgears->count() > 0)
    <table class="table table table-sm table-bordered">
        <thead>
        <tr style="font-size: xx-small">
            <th style="margin-left: 4px">Panel</th>
            <th>Make</th>
            <th>Year</th>
            <th>Circuit</th>
            <th>Switch Operations</th>
            <th>Serial</th>
            <th>Op Locks In Position</th>
            <th>Check Earth</th>
            <th>Check Diagrams</th>
            <th>Check SF6</th>
            <th>General Condition</th>
            <th>Check Interlocks</th>
            <th>Cable and Ducts</th>
            <th>Comments</th>
        </tr>
        </thead>
        <tbody>
            @foreach($inspection->switchgears as $switchgear)
                <tr style="font-size: xx-small">
                    <td>{{$switchgear->panel_number}}</td>
                    <td>{{$switchgear->manufacturer}}</td>
                    <td>{{$switchgear->year}}</td>
                    <td>{{$switchgear->circuit}}</td>
                    <td>{{$switchgear->switching_operations}}</td>
                    <td>{{$switchgear->serial_number}}</td>
                    <td>{{($switchgear->op_locks)?'Yes':'No'}}</td>
                    <td>{{$switchgear->check_earth_connections}}</td>
                    <td>{{$switchgear->ops_diagram}}</td>
                    <td>{{$switchgear->check_sf14}}</td>
                    <td>{{$switchgear->general_condition}}</td>
                    <td>{{($switchgear->check_interlocks)?'Yes':'No'}}</td>
                    <td>{{($switchgear->cables_and_ducts)?'Yes':'No'}}</td>
                    <td>{{$switchgear->comments}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>

@else
    No Data Present
@endif
<div class="page-break"></div>
<div class="row text-right" style="font-size: xx-small; margin-right: 50px">
    EPS-{{$inspection->job_number}}-{{$inspection->site}}-{{$inspection->client->client}}
</div>
<div class="row text-right" style="font-size: xx-small; margin-right: 50px">
    Inspected: {{$inspection->checked_on}}
</div>
<h3>TEV</h3>
<hr>
@if($inspection->tevs->count() > 0)
    <table class="table table-sm table-bordered">
        <thead>
        <tr style="font-size: x-small">
            <th>Panel Name</th>
            <th>Switch Pos</th>
            <th>Busbar Right</th>
            <th>Busbar Left</th>
            <th>Switch Tank</th>
            <th>CT Chamber</th>
            <th>Volt TX's</th>
            <th>Term Box</th>
            <th>Ultra Sonic Test</th>
            <th>TX BG Reading Metal</th>
            <th>TX HV Box</th>
            <th>TX Main Body</th>
            <th>TX Ultra Sonic Test</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inspection->tevs as $tev)
            <tr style="font-size: x-small">
                <td>{{$tev->panel_name}}</td>
                <td>{{$tev->switch_position}}</td>
                <td>{{$tev->busbar_right}}</td>
                <td>{{$tev->busbar_left}}</td>
                <td>{{$tev->switch_tank}}</td>
                <td>{{$tev->ct_chamber}}</td>
                <td>{{$tev->volt_txs}}</td>
                <td>{{$tev->term_box}}</td>
                <td>{{$tev->ultra_sonic_test}}</td>
                <td>{{$tev->tx_background_readings_metal}}</td>
                <td>{{$tev->tx_hv_box}}</td>
                <td>{{$tev->tx_main_body}}</td>
                <td>{{$tev->tx_ultra_sonic_test}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
@else
    No Data Present
@endif
</body>
