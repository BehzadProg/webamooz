@extends('auth.master')

@section('title', 'reset-password')

@section('content')
<form method="POST" action="{{ route('password.store') }}" class="form">
    @csrf
    <a class="account-logo" href="{{url('/')}}">
        <img src="/img/weblogo.png" alt="">
    </a>
    <div class="form-content form-account">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="email" class="txt txt-l" placeholder="* ایمیل" name="email" value="{{ old('email', $request->email) }}" required
            autocomplete="email">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror

        <input type="password" class="txt txt-l" placeholder="* رمز عبور جدید" name="password" required
            autocomplete="new-password" autofocus>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror

        <input type="password" class="txt txt-l" placeholder="* تایید رمز عبور جدید" name="password_confirmation" required
            autocomplete="new-password">
        @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <span class="rules">رمز عبور باید حداقل 8 کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر
            الفبا مانند !@#$%^&*() باشد.</span>
        <br>
        <button class="btn continue-btn">بازنشانی رمز عبور</button>

    </div>
    <div class="form-footer">

    </div>
</form>
@endsection
