<?php

namespace App\Http\Controllers\Abstracts;

use App\Stocks as StocksModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\LineBotRequest;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

abstract class Stocks extends Controller
{
    protected $validatedRequest = null;      // 原始request 資料
    protected $inputType        = null;      // 訊息的類型
    protected $replyToken       = null;      // API 回覆用token
    protected $inputText        = null;      // 訊息的內文
    protected $url              = null;      // 回覆用URL
    protected $header           = null;      // 回覆用header
    protected $tradeFeeRate     = 0.001425;  // 股票買賣都要扣
    protected $tradeTaxRate     = 0.003;     // 股票賣出要扣
    protected $tradeDiscount    = 0.28;      // 卷商手續費折扣

    public function __construct(LineBotRequest $request)
    {
        $this->validatedRequest = $request->validated();

        $this->handelInput();
    }

    protected function returnMessage()
    {
        Http::withHeaders($this->header)->post($this->url, [
            'replyToken' => $this->replyToken,            // 辨識用token
            'messages'   => $this->handleMessageType(),   // BOT要回覆的訊息
        ]);
    }

    private function handelInput()
    {
        $this->inputType  = $this->validatedRequest['events'][0]['message']['type'];
        $this->replyToken = $this->validatedRequest['events'][0]['replyToken'];
        $this->url        = 'https://api.line.me/v2/bot/message/reply';
        $this->header     = [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . env('LINE_ACCESS_TOKEN'),
        ];
    }

    protected function handleMessageType()
    {
        switch ($this->inputType) {
            case 'text':
                $this->inputText = strtolower($this->validatedRequest['events'][0]['message']['text']);
                $contents = $this->handleMessageText();
                break;

            case 'sticker':
                $contents[] =
                    [
                        "type"   => "text",
                        "text"   => "sticker",
                        "weight" => "bold",
                        "size"   => "3xl",
                        "align"  => "center"
                    ];
                break;

            case 'image':
                $contents[] =
                    [
                        "type"   => "text",
                        "text"   => "image",
                        "weight" => "bold",
                        "size"   => "3xl",
                        "align"  => "center"
                    ];
                break;

            case 'video':
                $contents[] =
                    [
                        "type"   => "text",
                        "text"   => "video",
                        "weight" => "bold",
                        "size"   => "3xl",
                        "align"  => "center"
                    ];
                break;

            case 'audio':
                $contents[] =
                    [
                        "type"   => "text",
                        "text"   => "audio",
                        "weight" => "bold",
                        "size"   => "3xl",
                        "align"  => "center"
                    ];
                break;

            case 'location':
                $latitude   = $this->validatedRequest['events'][0]['message']['latitude'];
                $longitude  = $this->validatedRequest['events'][0]['message']['longitude'];
                $zoomInRate = 17;
                $message    = "https://www.google.com/maps/search/food/@{$latitude},{$longitude},{$zoomInRate}z";
                $contents[]           =
                    [
                        "type"   => "button",
                        "action" => [
                            "type"  => "uri",
                            "label" => "按鈕",
                            "uri"   => $message
                        ],
                        "style" => "primary"
                    ];
                break;

            case 'imagemap':
                $contents[] =
                    [
                        "type"   => "text",
                        "text"   => "imagemap",
                        "weight" => "bold",
                        "size"   => "3xl",
                        "align"  => "center"
                    ];
                break;

            case 'template':
                $contents[] =
                    [
                        "type"   => "text",
                        "text"   => "template",
                        "weight" => "bold",
                        "size"   => "3xl",
                        "align"  => "center"
                    ];
                break;

            case 'flex':
                $contents[] =
                    [
                        "type"   => "text",
                        "text"   => "flex",
                        "weight" => "bold",
                        "size"   => "3xl",
                        "align"  => "center"
                    ];
                break;

            default:
                $contents[] =
                    [
                        "type"   => "text",
                        "text"   => "none",
                        "weight" => "bold",
                        "size"   => "3xl",
                        "align"  => "center"
                    ];
                break;
        }

        $returnMessage = [
            [
                "type"     => "flex",
                "altText"  => "This is a Flex Message",
                "contents" => [
                    "type" => "bubble",
                    "body" => [
                        "type"            => "box",
                        "layout"          => "vertical",
                        "contents"        => $contents,
                        "backgroundColor" => "#ffffaa"
                    ]
                ]
            ],
            [ // quick replies 電腦版無法跟quick replies互動
                "type"       => "text",
                "text"       => "請從下列中選擇關鍵詞",
                "quickReply" => [
                    "items" => [
                        [
                            "type"     => "action",
                            "imageUrl" => "https://pht.qoo-static.com/NuyOBNU1CGmbWlUxjDZOfUMZ43qjtUro8w2FhFU6YRwAoT7rh-VdsYhuPCV_lbI-7j8=w300",
                            "action"   => [
                                "type"  => "message",
                                "label" => "Stocks",
                                "text"  => "Stocks"
                            ]
                        ],
                        [
                            "type"     => "action",
                            "imageUrl" => "https://pht.qoo-static.com/NuyOBNU1CGmbWlUxjDZOfUMZ43qjtUro8w2FhFU6YRwAoT7rh-VdsYhuPCV_lbI-7j8=w300",
                            "action"   => [
                                "type"  => "message",
                                "label" => "Percent",
                                "text"  => "Percent"
                            ]
                        ],
                        [
                            "type"   => "action",
                            "action" => [
                                "type"  => "location",
                                "label" => "Send location"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $returnMessage;
    }

    private function handleMessageText()
    {
        // 在此METHOD處理文字訊息

        // 判斷該文字在stocks資料庫中存在與否
        // !!!!!!!!!!!!!這個邏輯有同代碼多筆的問題存在!!!!待解決
        // 目前先這樣測試功能;

        switch ($this->inputText) {
            case 'stocks':
                $contents = $this->handleStocks();
                break;
            case 'percent':
                $contents = $this->handlePercent();
                break;
            default:
                $contents = $this->handleDefault($this->inputText);
                break;
        }

        return $contents;
    }

    private function handleStocks()
    {
        $contents = [];
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

    private function handlePercent()
    {
        $contents = [];
        $allStocks = StocksModel::get();

        foreach ($allStocks as $stock) {
            $sum                  = $stock->purchase_price * $stock->amount;                                                           // 未含交易手續費
            $sumAfterFee          = floor($sum * (1 + $this->tradeFeeRate * $this->tradeDiscount));                                    // 含交易手續費
            $nowStockPrice        = round($this->getStockPrice($stock->stock_code), 2);                                                // 取得現在股價
            $marketValue          = $stock->amount * $nowStockPrice;                                                                   // 計算現在市價
            $marketValueSoldPrice = floor($marketValue * (1 - ($this->tradeFeeRate * $this->tradeDiscount) - ($this->tradeTaxRate)));  // 含交易手續費&交易稅
            $profit               = number_format($marketValueSoldPrice - $sumAfterFee);                                               // 與購買時的差額
            $profitColor          = $profit >= 0 ? "#ff0000" : "#00ff00";                                                              // 賺:紅色 虧:綠色
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

    private function handleDefault($string)
    {
        $contents = [];
        $stockData = StocksModel::where('stock_code', '=', $string)->first();
        if ($stockData !== null) {
            $sum                  = $stockData->purchase_price * $stockData->amount;                                                   // 未含交易手續費
            $sumAfterFee          = floor($sum * (1 + $this->tradeFeeRate * $this->tradeDiscount));                                    // 含交易手續費
            $nowStockPrice        = round($this->getStockPrice($stockData->stock_code), 2);                                            // 取得現在股價
            $marketValue          = $stockData->amount * $nowStockPrice;                                                               // 計算現在市價
            $marketValueSoldPrice = floor($marketValue * (1 - ($this->tradeFeeRate * $this->tradeDiscount) - ($this->tradeTaxRate)));  // 含交易手續費&交易稅
            $profit               = number_format($marketValueSoldPrice - $sumAfterFee);                                               // 與購買時的差額
            $profitColor          = $profit >= 0 ? "#ff0000" : "#00ff00";                                                              //  賺:紅色 虧:綠色
            $obtainDays           = Carbon::parse($stockData->purchase_date)->diffInDays(now());                                       // 持有天數

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
