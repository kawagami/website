<?php

namespace App\Http\Controllers;

use App\Frontend;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function show(Frontend $frontend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function edit(Frontend $frontend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frontend $frontend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frontend $frontend)
    {
        //
    }

    public function test()
    {
        // Carbon::parse();
        $dateStart = '2021-06-01';
        $dateEnd = now();
        $weekMap = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            // 0 => '星期日',
            // 1 => '星期一',
            // 2 => '星期二',
            // 3 => '星期三',
            // 4 => '星期四',
            // 5 => '星期五',
            // 6 => '星期六',
        ];
        $timestampStart = strtotime($dateStart);
        $timestampEnd = strtotime($dateEnd);
        $targetStock = '0050';

        $apiUrl = "https://query1.finance.yahoo.com/v8/finance/chart/{$targetStock}.TW?period1={$timestampStart}&period2={$timestampEnd}&interval=1d&events=history&=hP2rOschxO0";
        $response = Http::get($apiUrl);

        // // 應該是時間array
        // $response['chart']['result'][0]['timestamp'];
        // // 股價array
        // $response['chart']['result'][0]['indicators']['quote'][0]['open'];
        // $response['chart']['result'][0]['indicators']['quote'][0]['close'];

        $data = [];
        for ($i = 0; $i < count($response['chart']['result'][0]['timestamp']); $i++) {
            $data[] = [
                'timestamp' => Carbon::createFromTimestamp($response['chart']['result'][0]['timestamp'][$i], 'Asia/Taipei')->toDateString(),
                'weekday' => $weekMap[Carbon::createFromTimestamp($response['chart']['result'][0]['timestamp'][$i], 'Asia/Taipei')->dayOfWeek],
                'open' => number_format($response['chart']['result'][0]['indicators']['quote'][0]['open'][$i], 2),
                'close' => number_format($response['chart']['result'][0]['indicators']['quote'][0]['close'][$i], 2),
            ];
        }

        return $data;
        // return $response['chart']['result'][0]['timestamp'];
    }
}
