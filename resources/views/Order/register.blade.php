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
                        発注登録
                    </div>
                    <div class="card-body">
                        <!-- if文は上から一つひとつ確認しながら記述 -->
                        <!-- 発注できるのはヒラと管理者のみ -->
                        @if (Auth::User()->role !== 3 )
                        <form class="form" method="POST" action="/o_register" enctype="multipart/form-data">
                            @csrf
                            <div class="form mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputState">商品名</label>
                                    <select id="inputState" class="form-control" name="name" value="order['name']" required>
                                        @foreach ($stock as $stocks)
                                        <!-- 在庫で登録した名前を使っている -->
                                            <option>{{ $stocks->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        入力してください
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="firstName">個数</label>
                                    <input type="number" class="form-control" name="o_num" placeholder="個数" value="order['o_num']" required>
                                </div>
                                <div class="invalid-feedback">
                                    入力してください
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">登録</button>
                                </div>
                            </div>
                        </form>
                        @endif
                        <!-- if文ここまで -->
                    </div>
                </div>
            </div>
            <div>
                <a href="/order">戻る</a>
            </div>
        </div>
    </div>
</div>


@endsection