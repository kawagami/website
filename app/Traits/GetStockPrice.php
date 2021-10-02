<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

trait GetStockPrice
{
    public function __construct()
    {
        // 手續費
        $this->tradeFeeRate = 0.001425;
        // 交易稅
        $this->tradeTaxRate = 0.003;
        // 卷商折扣
        $this->tradeDiscount = 0.28;
    }

    public function test()
    {
        // $fee = $this->tradeFeeRate;
        // $tax = $this->tradeTaxRate;
        // echo "手續費 => {$fee}";
        // echo "\n";
        // echo "交易稅 => {$tax}";
        // echo "\n";
        return '從GetStockPrice過來的文字';
    }

    private function getStockPrice($stockCode)
    {
        // Carbon::parse();
        $dateStart = Carbon::now()->subDays(7);
        $dateEnd   = now();
        $weekMap   = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];
        $timestampStart = strtotime($dateStart);
        $timestampEnd   = strtotime($dateEnd);
        $targetStock    = "{$stockCode}";
        $apiUrl         = "https://query1.finance.yahoo.com/v8/finance/chart/{$targetStock}.TW?period1={$timestampStart}&period2={$timestampEnd}&interval=1d&events=history&=hP2rOschxO0";
        $response       = Http::get($apiUrl);
        $targetArray    = $response['chart']['result'][0]['indicators']['quote'][0]['close'];

        return end($targetArray);
    }
}
