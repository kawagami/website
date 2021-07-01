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
