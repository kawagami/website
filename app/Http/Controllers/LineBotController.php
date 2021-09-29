<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Abstracts\Stocks;

class LineBotController extends Stocks
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->returnMessage();
        return response('success', 200);
    }
}
