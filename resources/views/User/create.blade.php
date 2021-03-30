@extends('components.template.manager')

@include('components.common.head')
@include('components.common.footer')
@include('components.common.js')

@include('components.header.header')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card my-5">
                <div class="card-body">
                    <div class="text-center my-3">
                        <p class="h3">アカウント新規登録</p>
                    </div>
                    @if ($errors->any())
                        <div class="my-3">
                            <div class="card-text text-left alert alert-danger">
                                <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <form method="POST" action="/create_user">
                        @csrf
                        <div class="form-group">
                            <label for="inputEmail">お名前</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputname" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">メールアドレス</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1">パスワード</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password" value="{{ old('password') }}" required autocomplete="current-password">
                        </div>
                        <div class="form-group row">
                            <label for="radio01" class="col-md-4 col-form-label text-md-right">役職</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="role" name="role" value=1>
                                    <label class="form-check-label">admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="role"  name="role" value=2 checked="checked">
                                    <label class="form-check-label">ヒラ</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="role"  name="role" value=3 >
                                    <label class="form-check-label">悪党</label>
                                </div>
                            </div>
                            </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">
                                新規作成する
                            </button>
                        </div>
                    </form>
                </div>
                <hr class="mx-5 mb-3">
                    <div class="text-center mb-3">
                        <a class="nav-link" href="/login">ログインはこちら</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
