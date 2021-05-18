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
                            <p class="h3">ログイン</p>
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
                        @if (session('flash_message'))
                            <div class="my-3">
                                <div class="card-text text-left alert alert-primary">
                                    <ul class="mb-0">
                                        {{ session('flash_message') }}
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <form method="POST" action="/login">
                            @csrf
                            <div class="form-group">
                                <label for="inputEmail">メールアドレス</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1">パスワード</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password" value="{{ old('password') }}" autocomplete="current-password">
                            </div>
                            <input id="is_active" type="hidden" name="is_active" value="{{ Config::get('constants.IS_ACTIVE.ON') }}">
                            <input id="role_id" type="hidden" name="role_id" value="{{ Config::get('constants.ROLES.USER') }}">
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">
                                    ログイン
                                </button>
                            </div>
                        </form>
                    </div>
                    <hr class="mx-5 mb-3">
                    <div class="text-center mb-3">
                        <a class="nav-link" href="/create_user">アカウントを新規作成する方はこちら</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





