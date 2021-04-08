@extends('components.template.manager')

@include('components.common.head')
@include('components.common.footer')
@include('components.common.js')

@include('components.header.header')

@section('content')

<div class = "container">
    <div class = "row">
        <div class = "col-md-12">
            <div class = "py-5">
                <div class="card">
                    <div class="card-header">
                        在庫登録
                    </div>
                    <div class="card-body">



                    <form class="form" method="POST" action="/register" enctype="multipart/form-data">
                        @csrf

                    <div class="form mb-4">
                        <div class="col-md-6">
                            <label for="lastName">商品名</label>
                            <input type="text" class="form-control" name="name" placeholder="商品名" required>
                            <div class="invalid-feedback">
                                入力してください
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="firstName">金額／1個</label>
                            <input type="text" class="form-control" name="price" placeholder="金額（数字のみ）" required>
                            <div class="invalid-feedback">
                                入力してください
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary">登録</button>
            </div>
        </div>
 </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
　　　　<a href="/">戻る</a>
　　 </div>
</div>




   <!-- ここにかく -->
@endsection