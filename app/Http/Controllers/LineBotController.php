<?php

namespace App\Http\Controllers;

use App\Stocks;
use App\LineBot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LineBotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (count($request->events) > 0) {
            $replyToken = $request['events'][0]['replyToken'];

            // 22-30行 的邏輯應該要分開寫，主要是依照進來訊息的不同做不同的回應
            // 這裡要判斷進來的是什麼類型的資料
            // $userMessage = $request['events'][0]['message']['text'] ?? '';
            // $userMessage = $this->handleMessageType($request);
            // BOT要回覆的訊息
            $message = [
                [
                    "type" => "flex",
                    "altText" => "This is a Flex Message",
                    "contents" => [
                        "type" => "bubble",
                        "body" => [
                            "type" => "box",
                            "layout" => "vertical",
                            "contents" => [
                                [
                                    "type" => "text",
                                    "text" => "2609",
                                    "weight" => "bold",
                                    "size" => "3xl",
                                    "align" => "center"
                                ],
                                [
                                    "type" => "box",
                                    "layout" => "vertical",
                                    "margin" => "lg",
                                    "spacing" => "sm",
                                    "contents" => [
                                        [
                                            "type" => "box",
                                            "layout" => "baseline",
                                            "spacing" => "xs",
                                            "contents" => [
                                                [
                                                    "type" => "text",
                                                    "text" => "持有天數",
                                                    "color" => "#aaaaaa",
                                                    "size" => "sm",
                                                    "flex" => 2,
                                                    "offsetEnd" => "none"
                                                ],
                                                [
                                                    "type" => "text",
                                                    "text" => "這裡拉資料庫的天數跟NOW差距",
                                                    "wrap" => true,
                                                    "color" => "#0000ff",
                                                    "size" => "xxl",
                                                    "flex" => 5,
                                                    "align" => "end"
                                                ]
                                            ]
                                        ],
                                        [
                                            "type" => "box",
                                            "layout" => "baseline",
                                            "spacing" => "sm",
                                            "contents" => [
                                                [
                                                    "type" => "text",
                                                    "text" => "盈虧",
                                                    "color" => "#aaaaaa",
                                                    "size" => "sm",
                                                    "flex" => 2
                                                ],
                                                [
                                                    "type" => "text",
                                                    "text" => "計算成本跟現值減掉手續費跟交易稅的數字",
                                                    "wrap" => true,
                                                    "color" => "#666666",
                                                    "size" => "xxl",
                                                    "flex" => 5,
                                                    "align" => "end"
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                [
                                    "type" => "separator"
                                ],
                                [
                                    "type" => "text",
                                    "text" => "0050",
                                    "weight" => "bold",
                                    "size" => "3xl",
                                    "align" => "center"
                                ],
                                [
                                    "type" => "box",
                                    "layout" => "vertical",
                                    "margin" => "lg",
                                    "spacing" => "sm",
                                    "contents" => [
                                        [
                                            "type" => "box",
                                            "layout" => "baseline",
                                            "spacing" => "xs",
                                            "contents" => [
                                                [
                                                    "type" => "text",
                                                    "text" => "持有天數",
                                                    "color" => "#aaaaaa",
                                                    "size" => "sm",
                                                    "flex" => 2,
                                                    "offsetEnd" => "none"
                                                ],
                                                [
                                                    "type" => "text",
                                                    "text" => "這裡拉資料庫的天數跟NOW差距",
                                                    "wrap" => true,
                                                    "color" => "#0000ff",
                                                    "size" => "xxl",
                                                    "flex" => 5,
                                                    "align" => "end"
                                                ]
                                            ]
                                        ],
                                        [
                                            "type" => "box",
                                            "layout" => "baseline",
                                            "spacing" => "sm",
                                            "contents" => [
                                                [
                                                    "type" => "text",
                                                    "text" => "盈虧",
                                                    "color" => "#aaaaaa",
                                                    "size" => "sm",
                                                    "flex" => 2
                                                ],
                                                [
                                                    "type" => "text",
                                                    "text" => "計算成本跟現值減掉手續費跟交易稅的數字",
                                                    "wrap" => true,
                                                    "color" => "#666666",
                                                    "size" => "xxl",
                                                    "flex" => 5,
                                                    "align" => "end"
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                [
                                    "type" => "separator"
                                ],
                                [
                                    "type" => "text",
                                    "text" => "2887",
                                    "weight" => "bold",
                                    "size" => "3xl",
                                    "align" => "center"
                                ],
                                [
                                    "type" => "box",
                                    "layout" => "vertical",
                                    "margin" => "lg",
                                    "spacing" => "sm",
                                    "contents" => [
                                        [
                                            "type" => "box",
                                            "layout" => "baseline",
                                            "spacing" => "xs",
                                            "contents" => [
                                                [
                                                    "type" => "text",
                                                    "text" => "持有天數",
                                                    "color" => "#aaaaaa",
                                                    "size" => "sm",
                                                    "flex" => 2,
                                                    "offsetEnd" => "none"
                                                ],
                                                [
                                                    "type" => "text",
                                                    "text" => "這裡拉資料庫的天數跟NOW差距",
                                                    "wrap" => true,
                                                    "color" => "#0000ff",
                                                    "size" => "xxl",
                                                    "flex" => 5,
                                                    "align" => "end"
                                                ]
                                            ]
                                        ],
                                        [
                                            "type" => "box",
                                            "layout" => "baseline",
                                            "spacing" => "sm",
                                            "contents" => [
                                                [
                                                    "type" => "text",
                                                    "text" => "盈虧",
                                                    "color" => "#aaaaaa",
                                                    "size" => "sm",
                                                    "flex" => 2
                                                ],
                                                [
                                                    "type" => "text",
                                                    "text" => "計算成本跟現值減掉手續費跟交易稅的數字",
                                                    "wrap" => true,
                                                    "color" => "#666666",
                                                    "size" => "xxl",
                                                    "flex" => 5,
                                                    "align" => "end"
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            "backgroundColor" => "#ffffaa"
                        ]
                    ]
                ]
            ];

            // LINE的reply API
            $url = 'https://api.line.me/v2/bot/message/reply';
            // LINE 固定的header 格式
            $header = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('LINE_ACCESS_TOKEN'),
            ];
            // 整理成ARRAY丟回去
            $data = [
                'replyToken' => $replyToken,
                'messages' => $message,
            ];
            Http::withHeaders($header)->post($url, $data);
            // $res = Http::withHeaders($header)->post($url, $data);
            // error_log($res);
        }
        return response('success', 200);
    }

    public function handleMessage($request)
    {
        
        $return = '';
        return $return;
    }

    public function handleMessageType($request)
    {
        switch ($request['events'][0]['message']['type']) {
            case 'text':
                // 取得使用者對BOT輸入的文字
                $inputText = $request['events'][0]['message']['text'];
                // $message = 'text';
                $message = $this->handleMessageText($inputText);
                break;

            case 'sticker':
                $message = 'sticker';
                break;

            case 'image':
                $message = 'image';
                break;

            case 'video':
                $message = 'video';
                break;

            case 'audio':
                $message = 'audio';
                break;

            case 'location':
                $latitude = $request['events'][0]['message']['latitude'];
                $longitude = $request['events'][0]['message']['longitude'];
                $zoomInRate = 17;
                $message = "https://www.google.com/maps/search/food/@{$latitude},{$longitude},{$zoomInRate}z";
                break;

            case 'imagemap':
                $message = 'imagemap';
                break;

            case 'template':
                $message = 'template';
                break;

            case 'flex':
                $message = 'flex';
                break;

            default:
                $message = '';
                break;
        }
        return $message;
    }

    public function getStockPrice()
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

    public function handleMessageText($string)
    {
        // 在此METHOD處理文字訊息

        // 轉小寫
        $string = strtolower($string);
        // 判斷該文字在stocks資料庫中存在與否
        // !!!!!!!!!!!!!這個邏輯有同代碼多筆的問題存在!!!!待解決
        // 目前先這樣測試功能

        if ($string === 'stocks') {
            $allStocks = Stocks::get();
            $totalCost = 0;
            $tradeFeeRate = 0.001425;
            $tradeDiscount = 0.28;
            $replyContent = '';

            foreach ($allStocks as $stock) {
                // 未含交易手續費
                $sum = $stock->purchase_price * $stock->amount;
                // $sumAfterTax = round($sum * (1 + $tradeFeeRate * $tradeDiscount), 2);
                $sumAfterTax = floor($sum * (1 + $tradeFeeRate * $tradeDiscount));
                $totalCost += $sumAfterTax;
                // 單項明細
                $replyContent .= "代碼 : {$stock->stock_code}\n";
                $sumAfterTax = number_format($sumAfterTax);
                $replyContent .= "支出 : {$sumAfterTax}\n";
                $obtainDays = Carbon::parse($stock->purchase_date)->diffInDays(now());
                $replyContent .= "持有 : {$obtainDays} 天\n\n";
            }

            $totalCost = number_format($totalCost);
            $result = "{$replyContent}總支出 : {$totalCost}";
        } else {
            $stockData = Stocks::where('stock_code', '=', $string)->first();
            if ($stockData !== null) {
                $result = "購買價格 : {$stockData->purchase_price}\n購買日期 : {$stockData->purchase_date}\n數量 : {$stockData->amount}";
            } else {
                $result = '無資料';
            }
        }

        return $result;
    }
}
