<?php

namespace App\Http\Controllers;

use App\Stocks;
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

            // BOT要回覆的訊息
            $message = $this->handleMessageType($request);

            // 電腦版無法跟quick replies互動
            // $message = [];
            $message[] =
                [
                    "type" => "text",
                    "text" => "請從下列中選擇關鍵詞",
                    "quickReply" => [
                        "items" => [
                            [
                                "type" => "action",
                                "imageUrl" => "https://pht.qoo-static.com/NuyOBNU1CGmbWlUxjDZOfUMZ43qjtUro8w2FhFU6YRwAoT7rh-VdsYhuPCV_lbI-7j8=w300",
                                "action" => [
                                    "type" => "message",
                                    "label" => "Stocks",
                                    "text" => "Stocks"
                                ]
                            ],
                            [
                                "type" => "action",
                                "imageUrl" => "https://pht.qoo-static.com/NuyOBNU1CGmbWlUxjDZOfUMZ43qjtUro8w2FhFU6YRwAoT7rh-VdsYhuPCV_lbI-7j8=w300",
                                "action" => [
                                    "type" => "message",
                                    "label" => "Percent",
                                    "text" => "Percent"
                                ]
                            ],
                            [
                                "type" => "action",
                                "action" => [
                                    "type" => "location",
                                    "label" => "Send location"
                                ]
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
            // Http::withHeaders($header)->post($url, $data);
            $res = Http::withHeaders($header)->post($url, $data);
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
                $contents = $this->handleMessageText($inputText);
                break;

            case 'sticker':
                $contents[] =
                    [
                        "type" => "text",
                        "text" => "sticker",
                        "weight" => "bold",
                        "size" => "3xl",
                        "align" => "center"
                    ];
                break;

            case 'image':
                $contents[] =
                    [
                        "type" => "text",
                        "text" => "image",
                        "weight" => "bold",
                        "size" => "3xl",
                        "align" => "center"
                    ];
                break;

            case 'video':
                $contents[] =
                    [
                        "type" => "text",
                        "text" => "video",
                        "weight" => "bold",
                        "size" => "3xl",
                        "align" => "center"
                    ];
                break;

            case 'audio':
                $contents[] =
                    [
                        "type" => "text",
                        "text" => "audio",
                        "weight" => "bold",
                        "size" => "3xl",
                        "align" => "center"
                    ];
                break;

            case 'location':
                $latitude = $request['events'][0]['message']['latitude'];
                $longitude = $request['events'][0]['message']['longitude'];
                $zoomInRate = 17;
                $message = "https://www.google.com/maps/search/food/@{$latitude},{$longitude},{$zoomInRate}z";
                $contents[] =
                    [
                        "type" => "button",
                        "action" => [
                            "type" => "uri",
                            "label" => "按鈕",
                            "uri" => $message
                        ],
                        "style" => "primary"
                    ];
                break;

            case 'imagemap':
                $contents[] =
                    [
                        "type" => "text",
                        "text" => "imagemap",
                        "weight" => "bold",
                        "size" => "3xl",
                        "align" => "center"
                    ];
                break;

            case 'template':
                $contents[] =
                    [
                        "type" => "text",
                        "text" => "template",
                        "weight" => "bold",
                        "size" => "3xl",
                        "align" => "center"
                    ];
                break;

            case 'flex':
                $contents[] =
                    [
                        "type" => "text",
                        "text" => "flex",
                        "weight" => "bold",
                        "size" => "3xl",
                        "align" => "center"
                    ];
                break;

            default:
                $contents[] =
                    [
                        "type" => "text",
                        "text" => "none",
                        "weight" => "bold",
                        "size" => "3xl",
                        "align" => "center"
                    ];
                break;
        }

        $retuenMessage = [
            [
                "type" => "flex",
                "altText" => "This is a Flex Message",
                "contents" => [
                    "type" => "bubble",
                    "body" => [
                        "type" => "box",
                        "layout" => "vertical",
                        "contents" => $contents,
                        "backgroundColor" => "#ffffaa"
                    ]
                ]
            ]
        ];

        return $retuenMessage;
    }

    public function getStockPrice($stockCode)
    {
        // Carbon::parse();
        $dateStart = Carbon::now()->subDays(7);
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
        $targetStock = "{$stockCode}";

        $apiUrl = "https://query1.finance.yahoo.com/v8/finance/chart/{$targetStock}.TW?period1={$timestampStart}&period2={$timestampEnd}&interval=1d&events=history&=hP2rOschxO0";
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

    public function handleMessageText($string)
    {
        // 在此METHOD處理文字訊息

        // 轉小寫
        $string = strtolower($string);
        // 判斷該文字在stocks資料庫中存在與否
        // !!!!!!!!!!!!!這個邏輯有同代碼多筆的問題存在!!!!待解決
        // 目前先這樣測試功能;

        $contents = [];
        $this->tradeFeeRate = 0.001425;
        $this->tradeTaxRate = 0.003;
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
        $allStocks = Stocks::where('user_id', 1)->get();

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

            $contents[] =
                [
                    "type" => "text",
                    "text" => "{$stock->stock_code}",
                    "weight" => "bold",
                    "size" => "3xl",
                    "align" => "center"
                ];
            $contents[] =
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
                                    "text" => "{$obtainDays}",
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
                                    "text" => "現時盈虧",
                                    "color" => "#aaaaaa",
                                    "size" => "sm",
                                    "flex" => 2
                                ],
                                [
                                    "type" => "text",
                                    "text" => "{$profit}",
                                    "wrap" => true,
                                    "color" => $profitColor,
                                    "size" => "xxl",
                                    "flex" => 5,
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

    private function handlePercent($contents)
    {
        $allStocks = Stocks::get();

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
                    "type" => "text",
                    "text" => "{$stock->stock_code}",
                    "weight" => "bold",
                    "size" => "3xl",
                    "align" => "center"
                ];
            $contents[] =
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
                                    "text" => "{$obtainDays}",
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
                                    "text" => "收益%數",
                                    "color" => "#aaaaaa",
                                    "size" => "sm",
                                    "flex" => 2
                                ],
                                [
                                    "type" => "text",
                                    "text" => "{$profitPercent} %",
                                    "wrap" => true,
                                    "color" => $profitColor,
                                    "size" => "xxl",
                                    "flex" => 5,
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
        $stockData = Stocks::where('stock_code', '=', $string)->first();
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
                    "type" => "text",
                    "text" => "{$stockData->stock_code}",
                    "weight" => "bold",
                    "size" => "3xl",
                    "align" => "center"
                ];
            $contents[] =
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
                                    "text" => "{$obtainDays}",
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
                                    "text" => "現時盈虧",
                                    "color" => "#aaaaaa",
                                    "size" => "sm",
                                    "flex" => 2
                                ],
                                [
                                    "type" => "text",
                                    "text" => "{$profit}",
                                    "wrap" => true,
                                    "color" => $profitColor,
                                    "size" => "xxl",
                                    "flex" => 5,
                                    "align" => "end"
                                ]
                            ]
                        ]
                    ]
                ];
        } else {
            $contents[] =
                [
                    "type" => "text",
                    "text" => "無資料",
                    "weight" => "bold",
                    "size" => "3xl",
                    "align" => "center"
                ];
        }

        return $contents;
    }
}
