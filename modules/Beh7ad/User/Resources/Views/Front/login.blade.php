@extends('User::Front.master')
@section('title', 'صفحه ورود')
@section('content')
    <form method="POST" action="{{ route('login') }}" class="form">
        @csrf
        <a class="account-logo" href="{{url('/')}}">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            @if (session('status'))
                <p class="text-success">{{ session('status') }}</p>
            @endif
            <input type="text" class="txt-l txt" placeholder="ایمیل یا شماره موبایل" name="username"
                value="{{ old('username') }}" required autofocus autocomplete="username">
            @error('username')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="password"class="txt-l txt" placeholder="رمز عبور" name="password" required
                autocomplete="current-password">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            <button class="btn btn--login">ورود</button>
            <label class="ui-checkbox">
                مرا بخاطر داشته باش
                <input type="checkbox" name="remember">
                <span class="checkmark"></span>
            </label>
            <div class="recover-password">
                <a href="{{ route('password.request') }}">بازیابی رمز عبور</a>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{ route('register') }}">صفحه ثبت نام</a>
        </div>
    </form>
@endsection
