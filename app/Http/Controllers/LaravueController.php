<?php
/**
 * File LaravelController.php
 *
 * @author Tuan Duong <bacduong@gmail.com>
 * @package Laravue
 * @version 1.0
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class LaravueController
 *
 * @package App\Http\Controllers
 */
class LaravueController extends Controller
{
    /**
     * Entry point for Laravue Dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('laravue');
    }

    public function test(Request $request)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $request->start, $request->time_zone);
        $utc = $date->setTimezone('UTC');
        $track_utc = $utc;
        // return $track_utc->addHours($utc->hour)->addMinutes($utc->minute)->addSeconds($utc->second);
        $nextDay = $utc->next('sun');
        return $nextDay->addHours($utc->hour)->addMinutes($utc->minute)->addSeconds($utc->second);
    }
}
