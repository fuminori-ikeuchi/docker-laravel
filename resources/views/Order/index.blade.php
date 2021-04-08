@extends('components.template.manager')

@include('components.common.head')
@include('components.common.footer')
@include('components.common.js')

@include('components.header.header')

@section('content')



<div class = "container">
    <div class = "text-right">
　　　　　[ user : {{ Auth::User()->name }} ]
    </div>
    <div class = "row">
        <div class = "register-link">
            <a href="/o_register">発注登録</a>
        </div>
        <div class = "col-md-12">
            <div class = "py-5">
                <div class="card">
                    <div class="card-body">
                        <div class = inner-containar>
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">名前</th>
                                        <th scope="col">発注個数</th>
                                        <th scope="col">発注金額</th>
                                        <th scope="col">発注日</th>
                                        <th scope="col">発注状況</th>
                                    </tr>
                                </thead>
                                @foreach ($order as $orders)
                                <tbody>
                                    <tr scope="row">
                                        <td><a href="/status/{{ $orders->id }}">{{ $orders->id }}</a></td>
                                        <td>{{ $orders->name }}</td>
                                        <td>{{ $orders->o_num }}個</td>
                                        <td>{{ $orders['o_price'] }}円</td>
                                        <td>{{ $orders->created_at }}</td>
                                        @if ($orders["status"] !== "発注受取済み")
                                        <td><span class = "text-danger">{{ $orders->status }}</span></td>
                                        @else
                                        <td>{{ $orders->status }}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection