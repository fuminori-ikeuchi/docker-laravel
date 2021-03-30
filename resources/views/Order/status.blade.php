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
                        {{ $order["name"] }}　
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class = "container">
    <div class = "row">
        <div class = "col-md-10">
            <div class = "py-5">
                <div class="card">
                    <div class="card-header">
                        発注登録
                    </div>
                    <div class="card-body">



                    <form class="form" method="POST" action="/status" enctype="multipart/form-data">
                        @csrf
                        @if ($order["status"] === "発注確認" && Auth::User()->role === 1)
                        <div class="form mb-6">
                            <div class="form-group col-md-4">
                                <label for="inputState"></label>
                                
                                <select id="inputState" class="form-control" name="status" value="{{ $order['status'] }}" required>   
                                    <option selected>発注状態</option>
                                    <option selected>発注確認</option>
                                </select>
                                <div class="invalid-feedback">
                                    入力してください
                                </div>
                            </div>
                            <input type="hidden" id="id" name="id" value="{{ $order['id'] }}">
                                
                            <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary">登録</button>
            </div>
        </div>
                        </div>
                        @elseif ($order["status"] === "発注状態" && Auth::User()->role === 3)
                        <div class="form mb-6">
                            <div class="form-group col-md-4">
                                <label for="inputState"></label>
                                
                                <select id="inputState" class="form-control" name="status" value="{{ $order['status'] }}" required>   
                                    <option selected>発注完了</option>
                                    <option selected>発注状態</option>
                                </select>
                                <div class="invalid-feedback">
                                    入力してください
                                </div>
                            </div>
                            <input type="hidden" id="id" name="id" value="{{ $order['id'] }}">
                                
                            <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary">登録</button>
            </div>
        </div>
                        </div>

                        @elseif ($order["status"] === "発注完了" && Auth::User()->role === 1)
                        <div class="form mb-6">
                            <div class="form-group col-md-4">
                                <label for="inputState"></label>
                                
                                <select id="inputState" class="form-control" name="status" value="{{ $order['status'] }}" required>   
                                    <option selected>発注受取済み</option>
                                    <option selected>発注完了</option>
                                </select>
                                <div class="invalid-feedback">
                                    入力してください
                                </div>
                            </div>
                            <input type="hidden" id="id" name="id" value="{{ $order['id'] }}">
                            <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary">登録</button>
            </div>
        </div>
                                
                        </div>
                        @elseif ($order["status"] === "発注受取済み")
                        <div class="form mb-6">
                            <div class="form-group col-md-4">
                                <label for="inputState"></label>
                                
                                <select id="inputState" class="form-control" name="status" value="{{ $order['status'] }}" required>   
                                    <option selected>発注受取済み</option>
                                </select>
                                <div class="invalid-feedback">
                                    入力してください
                                </div>
                            </div>
                            <input type="hidden" id="id" name="id" value="{{ $order['id'] }}">
                           
                        @endif
                    

 </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div>
　　　　<a href="/order">戻る</a>
　　 </div>

@endsection