<?php

namespace App\Http\Controllers;

// use App\Stocks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Abstracts\Stocks as AbsStocks;

class LineBotController extends AbsStocks
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (count($request->events) > 0) {

            // BOT要回覆的訊息
            $message = $this->handleMessageType($request);

            // 電腦版無法跟quick replies互動
            // $message = [];
            $message[] =
                [
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
                ];

            // 整理成ARRAY丟回去
            $data = [
                'replyToken' => $this->replyToken,
                'messages'   => $message,
            ];
            // error_log(json_encode($data));
            Http::withHeaders($this->header)->post($this->url, $data);
        }
        return response('success', 200);
    }

    public function handleMessageType($request)
    {
        switch ($this->inputType) {
            case 'text':
                $contents = $this->handleMessageText($this->inputText);
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
                $latitude   = $request['events'][0]['message']['latitude'];
                $longitude  = $request['events'][0]['message']['longitude'];
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

        $retuenMessage = [
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
            ]
        ];

        return $retuenMessage;
    }
}
