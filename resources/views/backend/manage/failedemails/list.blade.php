@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container">
    <h1>沒寄出去的email有 {{count($data)}}</h1>
</div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">connection</th>
                <th scope="col">queue</th>
                <th scope="col">payload</th>
                <th scope="col">exception</th>
                <th scope="col">failed_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $failedmail)
            <tr>
                <th scope="row">{{$failedmail->id}}</th>
                <td>{{$failedmail->connection}}</td>
                <td>{{$failedmail->queue}}</td>
                <td>{{$failedmail->payload}}</td>
                <td>{{$failedmail->exception}}</td>
                <td>{{$failedmail->failed_at}}</td>
                <td><button class="btn btn-danger stock-del" data-id="{{$failedmail->id}}">刪除</button></td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection

@section('js')
@endsection