<?php

namespace App\Http\Controllers\FunctionPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

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
        $randomBase = [
            ['a', rand(1, 335)],
            ['b', rand(1, 301)],
            ['c', rand(1, 470)],
            ['d', rand(1, 267)],
            ['e', rand(1, 188)],
            ['f', rand(1, 212)],
            ['g', rand(1, 172)],
            ['h', rand(1, 206)],
            ['i', rand(1, 217)],
            ['j', rand(1, 56)],
            ['k', rand(1, 51)],
            ['l', rand(1, 185)],
            ['m', rand(1, 297)],
            ['n', rand(1, 111)],
            ['o', rand(1, 120)],
            ['p', rand(1, 434)],
            ['q', rand(1, 29)],
            ['r', rand(1, 243)],
            ['s', rand(1, 541)],
            ['t', rand(1, 231)],
            ['u', rand(1, 119)],
            ['v', rand(1, 75)],
            ['w', rand(1, 107)],
            ['x', rand(1, 5)],
            ['y', rand(1, 18)],
            ['z', rand(1, 14)],
        ];

        $url = "https://www.etymonline.com/search?page={$randomBase[array_rand($randomBase)][1]}&q={$randomBase[array_rand($randomBase)][0]}";
        $client = new Client();
        $response = $client->request('GET', $url);

        $latestNewsString = (string) $response->getBody();

        $crawler = new Crawler($latestNewsString);

        // 單字ARRAY
        $vocabularies = $crawler->filter('div.word--C9UPa > div > a')->each(function (Crawler $node, $i) {
            return $node->text();
        });

        // 解釋ARRAY
        $explains = $crawler->filter('div.word--C9UPa > div > section')->each(function (Crawler $node, $i) {
            return $node->text();
        });

        // 10個單字的array : [object, object...]
        for ($i = 0; $i < count($vocabularies); $i++) {
            $result[] = [
                "vocabulary" => $vocabularies[$i],
                "explain" => $explains[$i],
            ];
        }

        return $result;
    }
}
