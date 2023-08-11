<?php

namespace App\Traits;

use Carbon\Carbon;

trait HoursCalculator
{
    public function getHours($startTime, $finishTime): array
    {
        $mins = Carbon::parse($finishTime)->diffInMinutes(Carbon::parse($startTime));
        $hours = floor($mins/60);
        $spareMinutes = $mins - ($hours * 60);
        $fraction = $spareMinutes/60;

        $nearestQuarter = floor($fraction*4) / 4;
        $hoursFraction = $hours+$nearestQuarter;
        $minutes = strval($spareMinutes);
        if(strlen($minutes) == 0) {
            $minutes = "00";
        }
        elseif(strlen($minutes) < 2) {
            $minutes = "0".$minutes;
        }
        return ['time' => $hours.":".$minutes, 'hoursFraction' => $hoursFraction];
    }
}
