@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container">
    <h1>CREATE</h1>
    <form action="{{route('stocks.store')}}" method="POST" encType="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" htmlFor="stock_code">股票代碼</label>
            <input class="form-control" id="stock_code" name="stock_code" type="text" required />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" htmlFor="purchase_price">購買價格</label>
            <input class="form-control" id="purchase_price" name="purchase_price" type="number" step="0.01" required />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" htmlFor="purchase_date">購買日期</label>
            <input class="form-control" id="purchase_date" name="purchase_date" type="date" required />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" htmlFor="amount">股數</label>
            <input class="form-control" id="amount" name="amount" type="number" required />
        </div>
        <button class="btn btn-secondary">取消</button>
        <button class="btn btn-primary">新增</button>
    </form>
</div>
@endsection

@section('js')

@endsection