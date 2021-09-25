<?php

namespace App\Http\Controllers;

use App\Stocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StockProcessRequest;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->id();
        $data = Stocks::where('user_id', $userId)->with('user')->get();
        return view('backend.stocks.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockProcessRequest $request)
    {
        $formInput = $request->validated();
        $formInput['user_id'] = auth()->id();
        $formDataAddUserId = $formInput;
        Stocks::create($formDataAddUserId);
        return redirect()->route('stocks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function show(Stocks $stocks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function edit(Stocks $stocks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stocks $stocks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stocks = Stocks::find($id);

        if ($stocks->user_id !== auth()->id()) {
            return 'No permission';
        }

        $stocks->delete();
        return 'success';
    }
}
