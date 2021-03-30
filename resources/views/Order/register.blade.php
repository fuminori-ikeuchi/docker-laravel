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
                        発注登録
                    </div>
                    <div class="card-body">


                    @if (Auth::User()->role !== 3 )
                    <form class="form" method="POST" action="/o_register" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form mb-6">
                            <div class="form-group col-md-4">
                                <label for="inputState">発注登録</label>
                                
                                <select id="inputState" class="form-control" name="name" value="order['name']" required>   
                                @foreach ($stock as $stocks)
                                    <option selected>{{ $stocks->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    入力してください
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                            <label for="firstName">個数</label>
                                <input type="number" class="form-control" name="o_num" placeholder="個数" value="order['o_num']" required>
                        </div>
                        <div class="invalid-feedback">
                                    入力してください
                                </div>
                                
                                
                    </div>
                    
                    <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary">登録</button>
            </div>
        </div>
 </form>
 <!-- owari -->
 @endif



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
　　　　<a href="/order">戻る</a>
　　 </div>
</div>




   <!-- ここにかく -->
@endsection