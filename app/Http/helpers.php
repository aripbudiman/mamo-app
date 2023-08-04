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
function getMonthList($numberOfMonths = 12)
{
    $startDate = Carbon::now()->subMonths($numberOfMonths - 1)->startOfMonth(); // Tanggal awal bulan (12 bulan terakhir)
    $endDate = Carbon::now(); // Tanggal hari ini

    $months = [];
    while ($startDate->lte($endDate)) {
        $months[] = $startDate->format('F Y'); // Format: Nama_Bulan Tahun (contoh: August 2023)
        $startDate->addMonth();
    }

    return array_reverse($months);
}
