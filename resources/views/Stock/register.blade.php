@extends('components.template.manager')

@include('components.common.head')
@include('components.common.footer')
@include('components.common.js')

@include('components.header.header')

@section('content')

<div class = "container mt-4">
    <div class = "row">
        <div class = "offset-md-2 col-md-8">
            <div class = "py-5">
                <div class="card">
                    <div class="card-header text-center">
                        在庫登録
                    </div>
                    <div class="card-body">
                        <form class="form" method="POST" action="/register" enctype="multipart/form-data">
                            @csrf
                            <div class="form mb-4">
                                <div class="col-md-12">
                                    <label for="lastName">商品名</label>
                                    <input type="text" class="form-control" name="name" placeholder="商品名" required>
                                    <div class="invalid-feedback">
                                        入力してください
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="firstName">金額 (単価)</label>
                                    <input type="number" class="form-control" name="price" placeholder="金額 (数字入力)" required>
                                    <div class="invalid-feedback">
                                        入力してください
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">登録</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <a href="/">戻る</a>
            </div>
        </div>
    </div>
</div>




   <!-- ここにかく -->
@endsection