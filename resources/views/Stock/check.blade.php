@extends('components.template.manager')

@include('components.common.head')
@include('components.common.footer')
@include('components.common.js')

@include('components.header.header')

@section('content')


<div class = "container mt-4">
    <div class = "row">
        <div class = "offset-md-1 col-md-10">
            <div class = "py-5">
                <div class="card">
                    <div class="card-header">
                        商品詳細
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr scope="row">
                                    <td>{{ $stock->name }}</td>
                                    <td>{{ $stock['price'] }}円 (単価)</td>
                                    <td>{{ $stock->num }}個 (在庫数)</td>
                                </tr>
                            </tbody>
                        </table>
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
