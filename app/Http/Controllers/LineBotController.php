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

            // 22-30行 的邏輯應該要分開寫，主要是依照進來訊息的不同做不同的回應
            // 這裡要判斷進來的是什麼類型的資料
            // $userMessage = $request['events'][0]['message']['text'] ?? '';
            $userMessage = $this->handleMessageType($request);
            // BOT要回覆的訊息
            $message = [
                [
                    "type" => "text",
                    "text" => $userMessage
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
        }
        return response('success', 200);
    }
    public function handleMessageType($request)
    {
        switch ($request['events'][0]['message']['type']) {
            case 'text':
                $message = 'text';
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
                $message = 'location';
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
}
