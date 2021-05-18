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
                        商品名
                    </div>
                    <div class="card-body">
                        {{ $order["name"] }}　
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class = "container">
    <div class = "row">
        <div class = "offset-md-1 col-md-10">
            <div class = "py-5">
                <div class="card">
                    <div class="card-header">
                        発注状況
                    </div>
                    <div class="card-body">
                    <form class="form" method="POST" action="/status" enctype="multipart/form-data">
                        @csrf
                        <!-- 発注確認から発注状態にできるのは管理者のみ。Auth::User()->roleでログインユーザーのrole取得 -->
                        @if ($order["status"] === "発注確認" && Auth::User()->role === 1)
                        <div class="form mb-6">
                            <div class="form-group col-md-11">
                                <label for="inputState"></label>
                                <select id="inputState" class="form-control" name="status" value="{{ $order['status'] }}" required>
                                    <option selected>発注確認</option>
                                    <option>発注状態</option>
                                </select>
                            </div>
                            <!-- hiddenはnullable(false)だとformでエラーが出てしまう場合に使用する -->
                            <input type="hidden" id="id" name="id" value="{{ $order['id'] }}">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">登録</button>
                                </div>
                            </div>
                        </div>
                        <!-- 発注状態から発注完了は悪党のみ -->
                        @elseif ($order["status"] === "発注状態" && Auth::User()->role === 3)
                        <div class="form mb-6">
                            <div class="form-group col-md-11">
                                <label for="inputState"></label>
                                <select id="inputState" class="form-control" name="status" value="{{ $order['status'] }}" required>
                                    <option selected>発注状態</option>
                                    <option>発注済み</option>
                                </select>
                            </div>
                            <!-- hiddenはnullable(false)だとformでエラーが出てしまう場合に使用する -->
                            <input type="hidden" id="id" name="id" value="{{ $order['id'] }}">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">登録</button>
                                </div>
                            </div>
                        </div>
                        <!-- 発注完了から受取済みにできるのは管理者のみ -->
                        @elseif ($order["status"] === "発注済み" && Auth::User()->role === 1)
                        <div class="form mb-6">
                            <div class="form-group col-md-11">
                                <label for="inputState"></label>
                                <select id="inputState" class="form-control" name="status" value="{{ $order['status'] }}" required>
                                    <option selected>発注済み</option>
                                    <option>発注受取済み</option>
                                </select>
                            </div>
                            <!-- hiddenはnullable(false)だとformでエラーが出てしまう場合に使用する -->
                            <input type="hidden" id="id" name="id" value="{{ $order['id'] }}">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">登録</button>
                                </div>
                            </div>
                        </div>
                        @elseif ($order["status"] === "発注受取済み")
                        <div class="form mb-6">
                            <div class="form-group col-md-11">
                                <label for="inputState"></label>
                                <select id="inputState" class="form-control" name="status" value="{{ $order['status'] }}" required>
                                    <option selected>発注受取済み</option>
                                </select>
                            </div>
                            <!-- hiddenはnullable(false)だとformでエラーが出てしまう場合に使用する -->
                            <input type="hidden" id="id" name="id" value="{{ $order['id'] }}">
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div>
            <a href="/order">戻る</a>
        </div>
    </div>
</div>

@endsection