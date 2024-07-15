<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function months() {
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
            ];

        return $months;
    }

    public function years($limit) {
        $years = [];

        $currentYear = Carbon::now()->year;

        $endYear = $currentYear + $limit;

        for ($year = $currentYear; $year <= $endYear; $year++) {
            $years[] = $year;
        }

        return $years;
    }
}
