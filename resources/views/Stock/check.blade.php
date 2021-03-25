@extends('components.template.manager')

@include('components.common.head')
@include('components.common.footer')
@include('components.common.js')

@include('components.header.header')

@section('content')


<div class = "container">
    <div class = "row">
        <div class = "col-md-10">
            <div class = "py-5">
                <div class="card">
                    <div class="card-header">
                        商品名
                    </div>
                    <div class="card-body">
                        {{ $stock["name"] }}　
                    </div>
                </div>
            </div>
            <div>
　　　　<a href="/">戻る</a>
　　 </div>
        </div>
    </div>
</div>


















@endsection
