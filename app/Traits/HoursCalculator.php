<?php

namespace App\Traits;

use Carbon\Carbon;

trait HoursCalculator
{
    public function getHours($startDate, $startTime, $finishDate, $finishTime): array
    {
        $start = Carbon::parse($startDate.' '.$startTime);
        $finish = Carbon::parse($finishDate.' '.$finishTime);
        $totalMinutes = $start->diffInMinutes($finish);
        $hours = floor($totalMinutes/60);
        $spareMinutes = $totalMinutes - ($hours * 60);
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
