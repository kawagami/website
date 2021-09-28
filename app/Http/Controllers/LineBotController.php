<?php

namespace App\Http\Controllers;

// use App\Stocks;
// use Carbon\Carbon;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Abstracts\Stocks as AbsStocks;
use App\Http\Requests\LineBotRequest;

class LineBotController extends AbsStocks
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LineBotRequest $request)
    {
        Http::withHeaders($this->header)->post($this->url, [
            'replyToken' => $this->replyToken,                                 // 辨識用token
            'messages'   => $this->handleMessageType($request->validated()),   // BOT要回覆的訊息
        ]);
        return response('success', 200);
    }
}
