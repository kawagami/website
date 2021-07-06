@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container">
    <a href="{{route('stocks.create')}}"><button class="btn btn-success">新增</button></a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">股票代碼</th>
                <th scope="col">購買價格</th>
                <th scope="col">購買日期</th>
                <th scope="col">股數</th>
                <th scope="col">刪除</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->stock_code}}</td>
                <td>{{$item->purchase_price}}</td>
                <td>{{$item->purchase_date}}</td>
                <td>{{number_format($item->amount)}}</td>
                <td><button class="btn btn-danger stock-del" data-id="{{$item->id}}">刪除</button></td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection

@section('js')
<script src="{{asset('js/stockDel.js')}}"></script>
@endsection