@extends('User::Front.master')

@section('title', 'فراموشی رمز عبور')

@section('content')
    <form method="POST" action="{{ route('password.email') }}" class="form">
        @csrf
        <a class="account-logo" href="{{url('/')}}">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            @if (session('status'))
                <p class="text-success">{{ session('status') }}</p>
            @endif
            <input type="email" class="txt-l txt" placeholder="ایمیل" name="email" value="{{ old('email') }}" required
                autofocus>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            <button type="submit" class="btn btn-recoverpass">بازیابی</button>
        </div>
        <div class="form-footer">
            <a href="{{ route('login') }}">صفحه ورود</a>
        </div>
    </form>
@endsection
