<?php

namespace App\Http\Controllers\Abstracts;

use App\Stocks as StocksModel;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
// use Illuminate\Http\Request;

abstract class Stocks extends Controller
{
    protected $rawRequest; // 原始request 資料
    protected $inputType;  // 訊息的類型
    protected $replyToken; // API 回覆用token
    protected $inputText;  // 訊息的內文
    protected $url;  // 回覆用URL
    protected $header;  // 回覆用header

    public function __construct()
    {
        $this->rawRequest = request()->all();

        $this->handelInput($this->rawRequest);
    }

    private function handelInput($rawRequest)
    {
        $this->inputType  = $rawRequest['events'][0]['message']['type'];
        $this->replyToken = $rawRequest['events'][0]['replyToken'];
        $this->url        = 'https://api.line.me/v2/bot/message/reply';
        $this->header     = [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . env('LINE_ACCESS_TOKEN'),
        ];

        if ($this->inputType == 'text') {
            $this->inputText  = $rawRequest['events'][0]['message']['text'];
        }
    }

    public function handleMessageText($string)
    {
        // 在此METHOD處理文字訊息

        // 轉小寫
        $string = strtolower($string);
        // 判斷該文字在stocks資料庫中存在與否
        // !!!!!!!!!!!!!這個邏輯有同代碼多筆的問題存在!!!!待解決
        // 目前先這樣測試功能;

        $contents            = [];
        $this->tradeFeeRate  = 0.001425;
        $this->tradeTaxRate  = 0.003;
        $this->tradeDiscount = 0.28;

        switch ($string) {
            case 'stocks':
                $contents = $this->handleStocks($contents);
                break;
            case 'percent':
                $contents = $this->handlePercent($contents);
                break;
            default:
                $contents = $this->handleDefault($contents, $string);
                break;
        }

        return $contents;
    }

    private function handleStocks($contents)
    {
        // 目前還沒想到line bot request這個controller的時候怎麼辨識是哪個user
        // 先綁定特定會員
        $allStocks = StocksModel::where('user_id', 1)->get();

        foreach ($allStocks as $stock) {
            $sum                  = $stock->purchase_price * $stock->amount;                                                           // 未含交易手續費
            $sumAfterFee          = floor($sum * (1 + $this->tradeFeeRate * $this->tradeDiscount));                                    // 含交易手續費
            $nowStockPrice        = round($this->getStockPrice($stock->stock_code), 2);                                                // 取得現在股價
            $marketValue          = $stock->amount * $nowStockPrice;                                                                   // 計算現在市價
            $marketValueSoldPrice = floor($marketValue * (1 - ($this->tradeFeeRate * $this->tradeDiscount) - ($this->tradeTaxRate)));  // 含交易手續費&交易稅
            $profit               = number_format($marketValueSoldPrice - $sumAfterFee);                                               // 與購買時的差額
            $profitColor          = $profit >= 0 ? "#ff0000" : "#00ff00";                                                              // 賺:紅色 虧:綠色

            $sumAfterFee = number_format($sumAfterFee);                              // 加手續費後取得金額
            $obtainDays  = Carbon::parse($stock->purchase_date)->diffInDays(now());  // 持有天數

            $contents[] =
                [
                    "type"   => "text",
                    "text"   => "{$stock->stock_code}",
                    "weight" => "bold",
                    "size"   => "3xl",
                    "align"  => "center"
                ];
            $contents[] =
                [
                    "type"     => "box",
                    "layout"   => "vertical",
                    "margin"   => "lg",
                    "spacing"  => "sm",
                    "contents" => [
                        [
                            "type"     => "box",
                            "layout"   => "baseline",
                            "spacing"  => "xs",
                            "contents" => [
                                [
                                    "type"      => "text",
                                    "text"      => "持有天數",
                                    "color"     => "#aaaaaa",
                                    "size"      => "sm",
                                    "flex"      => 2,
                                    "offsetEnd" => "none"
                                ],
                                [
                                    "type"  => "text",
                                    "text"  => "{$obtainDays}",
                                    "wrap"  => true,
                                    "color" => "#0000ff",
                                    "size"  => "xxl",
                                    "flex"  => 5,
                                    "align" => "end"
                                ]
                            ]
                        ],
                        [
                            "type"     => "box",
                            "layout"   => "baseline",
                            "spacing"  => "sm",
                            "contents" => [
                                [
                                    "type"  => "text",
                                    "text"  => "現時盈虧",
                                    "color" => "#aaaaaa",
                                    "size"  => "sm",
                                    "flex"  => 2
                                ],
                                [
                                    "type"  => "text",
                                    "text"  => "{$profit}",
                                    "wrap"  => true,
                                    "color" => $profitColor,
                                    "size"  => "xxl",
                                    "flex"  => 5,
                                    "align" => "end"
                                ]
                            ]
                        ]
                    ]
                ];
            $contents[] =
                [
                    "type" => "separator"
                ];
            // error_log(json_encode($contents));
        }

        // error_log('for outside');
        return $contents;
    }

    private function handlePercent($contents)
    {
        $allStocks = StocksModel::get();

        foreach ($allStocks as $stock) {
            // 未含交易手續費
            $sum = $stock->purchase_price * $stock->amount;
            // 含交易手續費
            $sumAfterFee = floor($sum * (1 + $this->tradeFeeRate * $this->tradeDiscount));
            // 取得現在股價
            $nowStockPrice = round($this->getStockPrice($stock->stock_code), 2);
            // $nowStockPrice = 20;
            // 計算現在市價
            $marketValue = $stock->amount * $nowStockPrice;
            // 含交易手續費&交易稅
            $marketValueSoldPrice = floor($marketValue * (1 - ($this->tradeFeeRate * $this->tradeDiscount) - ($this->tradeTaxRate)));
            // 與購買時的差額
            $profit = number_format($marketValueSoldPrice - $sumAfterFee);
            // 賺:紅色 虧:綠色
            $profitColor = $profit >= 0 ? "#ff0000" : "#00ff00";

            // $totalCost += $sumAfterFee;
            // // 單項明細
            // 加手續費後取得金額
            $sumAfterFee = number_format($sumAfterFee);
            // 持有天數
            $obtainDays = Carbon::parse($stock->purchase_date)->diffInDays(now());
            // 收益%數
            str_replace(',', '', $profit);
            str_replace(',', '', $sumAfterFee);
            $profitPercent = (intval($profit) / intval($sumAfterFee)) * 100;
            $profitPercent = number_format($profitPercent, 2);

            $contents[] =
                [
                    "type"   => "text",
                    "text"   => "{$stock->stock_code}",
                    "weight" => "bold",
                    "size"   => "3xl",
                    "align"  => "center"
                ];
            $contents[] =
                [
                    "type"     => "box",
                    "layout"   => "vertical",
                    "margin"   => "lg",
                    "spacing"  => "sm",
                    "contents" => [
                        [
                            "type"     => "box",
                            "layout"   => "baseline",
                            "spacing"  => "xs",
                            "contents" => [
                                [
                                    "type"      => "text",
                                    "text"      => "持有天數",
                                    "color"     => "#aaaaaa",
                                    "size"      => "sm",
                                    "flex"      => 2,
                                    "offsetEnd" => "none"
                                ],
                                [
                                    "type"  => "text",
                                    "text"  => "{$obtainDays}",
                                    "wrap"  => true,
                                    "color" => "#0000ff",
                                    "size"  => "xxl",
                                    "flex"  => 5,
                                    "align" => "end"
                                ]
                            ]
                        ],
                        [
                            "type"     => "box",
                            "layout"   => "baseline",
                            "spacing"  => "sm",
                            "contents" => [
                                [
                                    "type"  => "text",
                                    "text"  => "收益%數",
                                    "color" => "#aaaaaa",
                                    "size"  => "sm",
                                    "flex"  => 2
                                ],
                                [
                                    "type"  => "text",
                                    "text"  => "{$profitPercent} %",
                                    "wrap"  => true,
                                    "color" => $profitColor,
                                    "size"  => "xxl",
                                    "flex"  => 5,
                                    "align" => "end"
                                ]
                            ]
                        ]
                    ]
                ];
            $contents[] =
                [
                    "type" => "separator"
                ];
        }

        return $contents;
    }

    private function handleDefault($contents, $string)
    {
        $stockData = StocksModel::where('stock_code', '=', $string)->first();
        if ($stockData !== null) {
            // 未含交易手續費
            $sum = $stockData->purchase_price * $stockData->amount;
            // 含交易手續費
            $sumAfterFee = floor($sum * (1 + $this->tradeFeeRate * $this->tradeDiscount));
            // 取得現在股價
            $nowStockPrice = round($this->getStockPrice($stockData->stock_code), 2);
            // $nowStockPrice = 20;
            // 計算現在市價
            $marketValue = $stockData->amount * $nowStockPrice;
            // 含交易手續費&交易稅
            $marketValueSoldPrice = floor($marketValue * (1 - ($this->tradeFeeRate * $this->tradeDiscount) - ($this->tradeTaxRate)));
            // 與購買時的差額
            $profit = number_format($marketValueSoldPrice - $sumAfterFee);
            // 賺:紅色 虧:綠色
            $profitColor = $profit >= 0 ? "#ff0000" : "#00ff00";
            // 持有天數
            $obtainDays = Carbon::parse($stockData->purchase_date)->diffInDays(now());

            $contents[] =
                [
                    "type"   => "text",
                    "text"   => "{$stockData->stock_code}",
                    "weight" => "bold",
                    "size"   => "3xl",
                    "align"  => "center"
                ];
            $contents[] =
                [
                    "type"     => "box",
                    "layout"   => "vertical",
                    "margin"   => "lg",
                    "spacing"  => "sm",
                    "contents" => [
                        [
                            "type"     => "box",
                            "layout"   => "baseline",
                            "spacing"  => "xs",
                            "contents" => [
                                [
                                    "type"      => "text",
                                    "text"      => "持有天數",
                                    "color"     => "#aaaaaa",
                                    "size"      => "sm",
                                    "flex"      => 2,
                                    "offsetEnd" => "none"
                                ],
                                [
                                    "type"  => "text",
                                    "text"  => "{$obtainDays}",
                                    "wrap"  => true,
                                    "color" => "#0000ff",
                                    "size"  => "xxl",
                                    "flex"  => 5,
                                    "align" => "end"
                                ]
                            ]
                        ],
                        [
                            "type"     => "box",
                            "layout"   => "baseline",
                            "spacing"  => "sm",
                            "contents" => [
                                [
                                    "type"  => "text",
                                    "text"  => "現時盈虧",
                                    "color" => "#aaaaaa",
                                    "size"  => "sm",
                                    "flex"  => 2
                                ],
                                [
                                    "type"  => "text",
                                    "text"  => "{$profit}",
                                    "wrap"  => true,
                                    "color" => $profitColor,
                                    "size"  => "xxl",
                                    "flex"  => 5,
                                    "align" => "end"
                                ]
                            ]
                        ]
                    ]
                ];
        } else {
            $contents[] =
                [
                    "type"   => "text",
                    "text"   => "無資料",
                    "weight" => "bold",
                    "size"   => "3xl",
                    "align"  => "center"
                ];
        }

        return $contents;
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
            // 0 => '星期日',
            // 1 => '星期一',
            // 2 => '星期二',
            // 3 => '星期三',
            // 4 => '星期四',
            // 5 => '星期五',
            // 6 => '星期六',
        ];
        $timestampStart = strtotime($dateStart);
        $timestampEnd   = strtotime($dateEnd);
        $targetStock    = "{$stockCode}";

        $apiUrl   = "https://query1.finance.yahoo.com/v8/finance/chart/{$targetStock}.TW?period1={$timestampStart}&period2={$timestampEnd}&interval=1d&events=history&=hP2rOschxO0";
        $response = Http::get($apiUrl);

        // // 應該是時間array
        // $response['chart']['result'][0]['timestamp'];
        // // 股價array
        // $response['chart']['result'][0]['indicators']['quote'][0]['open'];
        // $response['chart']['result'][0]['indicators']['quote'][0]['close'];

        // $data = [];
        // for ($i = 0; $i < count($response['chart']['result'][0]['timestamp']); $i++) {
        //     $data[] = [
        //         'timestamp' => Carbon::createFromTimestamp($response['chart']['result'][0]['timestamp'][$i], 'Asia/Taipei')->toDateString(),
        //         'weekday' => $weekMap[Carbon::createFromTimestamp($response['chart']['result'][0]['timestamp'][$i], 'Asia/Taipei')->dayOfWeek],
        //         'open' => number_format($response['chart']['result'][0]['indicators']['quote'][0]['open'][$i], 2),
        //         'close' => number_format($response['chart']['result'][0]['indicators']['quote'][0]['close'][$i], 2),
        //     ];
        // }
        $targetArray = $response['chart']['result'][0]['indicators']['quote'][0]['close'];
        return end($targetArray);
        // return $response['chart']['result'][0]['timestamp'];
    }
}
