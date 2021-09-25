<?php

namespace App\Http\Controllers\Abstracts;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

abstract class Stocks extends Controller
{
    public $inputType;
    public $inputText;
    public $rawRequest;

    public function __construct()
    {
        $this->rawRequest = request()->all();

        $this->handelInput($this->rawRequest);
    }

    private function handelInput($rawRequest)
    {
        if ($rawRequest['events'][0]['message']['type'] == 'text') {
            $this->inputType = $rawRequest['events'][0]['message']['type'];
            $this->inputText = $rawRequest['events'][0]['message']['text'];
        }
    }
}
