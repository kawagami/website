<?php

namespace App\Http\Controllers;

use App\LineBot;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
            $message = $request->events[0];
            $replyToken = $message->replyToken;
            $userMessage = $message->message->text;

            $message = [
                [
                    "type" => "text",
                    "text" => $userMessage
                ],
                [
                    "type" => "text",
                    "text" => "hello"
                ]
            ];
        }
        return response('success', 200);
    }
    public function ReplyMessage($replyToken, $messages)
    {
        #請使用自己的token
        $accessToken = "jTsJqNhKOTb4k8LzIMsTzW8zh4BgEJuC1+i3cyPxlYc1nQuwyn/xdIBSG7wPBvxYAuA0cOrkFGBMEZdhY9P3RShKjIiCZMILYonP8IiWeo0pinIQuDpGqhL1z8PGy1t5bXEw41dEM6DVf0Ikss3h9gdB04t89/1O/w1cDnyilFU=";

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken
        ];

        $data = [
            "replyToken" => $replyToken,
            "messages" => $messages
        ];

        $url = 'https://api.line.me/v2/bot/message/reply';

        $client = new Client;
        $res = $client->request('POST', $url, [
            'headers' => $headers,
            'data' => $data
        ]);
        // $r = $requests . post($url, headers = $headers, $data = json . dumps($data));
        return $res;
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
     * @param  \App\LineBot  $lineBot
     * @return \Illuminate\Http\Response
     */
    public function show(LineBot $lineBot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LineBot  $lineBot
     * @return \Illuminate\Http\Response
     */
    public function edit(LineBot $lineBot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LineBot  $lineBot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LineBot $lineBot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LineBot  $lineBot
     * @return \Illuminate\Http\Response
     */
    public function destroy(LineBot $lineBot)
    {
        //
    }
}
