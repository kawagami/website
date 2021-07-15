<?php

namespace App\Http\Controllers\FunctionPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class VocabularyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getTenWords()
    {
        $url = "https://www.etymonline.com/search?page=200&q=a";
        $client = new Client();
        $response = $client->request('GET', $url);

        // echo (string) $response->getBody();

        // 10個單字的array : [object, object...]
        $result = [
            [
                "vocabulary" => "抓到的單字1",
                "explain" => "單字1解釋",
            ],
            [
                "vocabulary" => "抓到的單字2",
                "explain" => "單字2解釋",
            ],
            [
                "vocabulary" => "抓到的單字3",
                "explain" => "單字3解釋",
            ],
        ];
        // return $result;
        return (string) $response->getBody();
    }
}
