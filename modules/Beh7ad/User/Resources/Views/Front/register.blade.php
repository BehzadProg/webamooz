@extends('User::Front.master')
@section('title', 'صفحه ثبت نام')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="form">
        @csrf
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" class="txt" placeholder="* نام و نام خانوادگی" name="name" value="{{ old('name') }}"
                required autofocus autocomplete="username">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="email" class="txt txt-l" placeholder="* ایمیل" name="email" value="{{ old('email') }}" required
                autocomplete="email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="text" class="txt txt-l" placeholder="شماره موبایل" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="password" class="txt txt-l" placeholder="* رمز عبور" name="password" required
                autocomplete="new-password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="password" class="txt txt-l" placeholder="* تایید رمز عبور" name="password_confirmation" required
                autocomplete="new-password">
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <span class="rules">رمز عبور باید حداقل 8 کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر
                الفبا مانند !@#$%^&*() باشد.</span>
            <br>
            <button class="btn continue-btn">ثبت نام و ادامه</button>

        </div>
        <div class="form-footer">
            <a href="{{ route('login') }}">صفحه ورود</a>
        </div>
    </form>
@endsection
