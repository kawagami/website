<?php

namespace App\Http\Controllers;

use App\LineBot;
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
            // 這裡要判斷進來的是什麼類型的資料
            $userMessage = $request['events'][0]['message']['text'] ?? '';
            $message = [
                [
                    "type" => "text",
                    "text" => $userMessage
                ]
            ];
            $url = 'https://api.line.me/v2/bot/message/reply';
            $header = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('LINE_ACCESS_TOKEN'),
            ];
            $data = [
                'replyToken' => $replyToken,
                'messages' => $message,
            ];
            Http::withHeaders($header)->post($url, $data);
        }
        return response('success', 200);
    }
    public function handleMessageType($eventArray)
    {
        // $TextMessage;
        // $StickerMessage;
        // $ImageMessage;
        // $VideoMessage;
        // $AudioMessage;
        // $LocationMessage;
        // $ImagemapMessage;
        // $TemplateMessage;
        // $FlexMessage;
    }
}
