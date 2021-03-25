@extends('components.template.manager')

@include('components.common.head')
@include('components.common.footer')
@include('components.common.js')

@include('components.header.header')

@section('content')






<div class = "container">
    <div class = "row">
        <div class = "register-link">
　　　　    <a href="/register">在庫登録</a>
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
                                        <th scope="col">在個数</th>
                                        <th scope="col">金額／1個</th>
                                        <th scope="col">登録日時</th>
                                    </tr>
                                </thead>
                                @foreach ($stock as $stocks)
                                <tbody>
                                    <tr scope="row">
                                        <td><a href="/check/{{ $stocks->id }}">{{ $stocks->id }}</a></td>
                                        <td>{{ $stocks->name }}</td>
                                        <td>{{ $stocks->num }}個</td>
                                        <td>{{ $stocks['price'] }}円</td>
                                        <td>{{ $stocks->created_at }}</td>
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





   <!-- ここにかく -->
@endsection