<?php 

use Carbon\Carbon;
function generateDateRangeForThisMonth()
{
    $startDate = Carbon::now()->startOfMonth(); // Tanggal awal bulan ini
    $endDate = Carbon::now(); // Tanggal hari ini

    $dates = [];
    while ($startDate->lte($endDate)) {
        $dates[] = $startDate->format('Y-m-d');
        $startDate->addDay();
    }

    return array_reverse($dates);
}

function generateDateRange(){
    $today = Carbon::now();
    $oneMonthAgo = $today->copy()->subMonth();
    $dates = [];

    while ($oneMonthAgo->lte($today)) {
    $dates[] = $oneMonthAgo->format('Y-m-d');
    $oneMonthAgo->addDay();
    }

    return array_reverse($dates);
}
